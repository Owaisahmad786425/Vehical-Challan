<?php
    $conn = mysqli_connect("localhost","root","SQLroot@MySQL","IRTLS");
    $username = $_COOKIE['uname'];
// -------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registerno = $_POST["registerno"];
    $violatorlno = $_POST["violatorlno"];
    $offenses = $_POST["offenses"];
    $fineamt = $_POST["fineamt"];
    $location = $_POST["location"];
    $dtime = date('Y-m-d H:i:s');
    echo $violatorlno;

    $query = "SELECT * FROM OwnedBy WHERE RegisterNo='$registerno'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        $ownerinfo = $row['LicenseNo'];
    }

    $sql = "INSERT INTO Violations (DateAndTime, RegisterNo, OwnerInfo, ViolatorInfo, Offenses, Fine, PlaceOfIncident)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssis", $dtime, $registerno, $ownerinfo, $violatorlno, $offenses, $fineamt, $location);

        if (mysqli_stmt_execute($stmt)) {
            $successMessage = "Violation added successfully!";
        } else {
            $errorMessage = "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        $errorMessage = "Error preparing statement: " . mysqli_error($conn);
    }
}

// -------------------------------------------------------------
    $queryPendingComplaints = "SELECT *
                       FROM Complaints
                       WHERE Status = 'PENDING'";
    $resultPendingComplaints = mysqli_query($conn, $queryPendingComplaints);

    // Unpaid violations query
    $queryUnderInvestigation = "SELECT * FROM Complaints WHERE Status = 'UNDER INVESTIGATION'";
    $resultUnderInvestigation = mysqli_query($conn, $queryUnderInvestigation);

    $queryResolved = "SELECT * FROM Complaints WHERE Status = 'RESOLVED'";
    $resultResolved = mysqli_query($conn, $queryResolved);
?>

<?php include "../../commonassets/header.php"; ?>
<h1>Registered Complaints</h1>

<!-- Pending Complaints Table -->
<div id="pendingComplaints" class="info-box">
    <h2>Pending Action</h2>
    <h3>Click on any complaints to move it to Under Investigation</h3>
    <?php if (mysqli_num_rows($resultPendingComplaints) > 0): ?>
        <table border="1">
            <tr><th>Complaint ID</th><th>Date & Time</th><th>Registration No</th><th>Description</th><th>Location</th><th>Complainee Contact</th></tr>
            <?php while ($row = mysqli_fetch_assoc($resultPendingComplaints)): ?>
                <tr onclick="ComplaintsAction(<?php echo $row['ComplaintID']?>, 'UNDER INVESTIGATION')">
                    <td><?php echo $row['ComplaintID']; ?></td>
                    <td><?php echo $row['DateTime']; ?></td>
                    <td><?php echo $row['RegisterNo']; ?></td>
                    <td><?php echo $row['Description']; ?></td>
                    <td><?php echo $row['Location']; ?></td>
                    <td><?php echo $row['ComplaineeContact']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No pending complaints found.</p>
    <?php endif; ?>
</div>

<!-- Under Investigation Table -->
<div id="underInvestigation" class="info-box">
    <h2>Under Investigation</h2>
    <h3>Click on any complaints to mark it as resolved</h3>
    <?php if (mysqli_num_rows($resultUnderInvestigation) > 0): ?>
        <table border="1">
            <tr><th>Complaint ID</th><th>Date & Time</th><th>Registration No</th><th>Description</th><th>Location</th><th>Complainee Contact</th></tr>
            <?php while ($row = mysqli_fetch_assoc($resultUnderInvestigation)): ?>
                <tr onclick="ComplaintsAction(<?php echo $row['ComplaintID']?>, 'RESOLVED')">
                    <td><?php echo $row['ComplaintID']; ?></td>
                    <td><?php echo $row['DateTime']; ?></td>
                    <td><?php echo $row['RegisterNo']; ?></td>
                    <td><?php echo $row['Description']; ?></td>
                    <td><?php echo $row['Location']; ?></td>
                    <td><?php echo $row['ComplaineeContact']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No complaints under investigation found.</p>
    <?php endif; ?>
</div>

<!-- Completed Table -->
<button id="resolvedComplaintsbtn">Show Resolved Complaints</button>
<div id="resolvedComplaints" class="info-box">
    <h2>Resolved</h2>
    <?php if (mysqli_num_rows($resultResolved) > 0): ?>
        <table border="1">
            <tr><th>Complaint ID</th><th>Date & Time</th><th>Registration No</th><th>Description</th><th>Location</th><th>Complainee Contact</th></tr>
            <?php while ($row = mysqli_fetch_assoc($resultResolved)): ?>
                <tr>
                    <td><?php echo $row['ComplaintID']; ?></td>
                    <td><?php echo $row['DateTime']; ?></td>
                    <td><?php echo $row['RegisterNo']; ?></td>
                    <td><?php echo $row['Description']; ?></td>
                    <td><?php echo $row['Location']; ?></td>
                    <td><?php echo $row['ComplaineeContact']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No resolved complaints.</p>
    <?php endif; ?>
</div>
<script>
    document.getElementById("resolvedComplaintsbtn").addEventListener("click", function() {
    var form = document.getElementById("resolvedComplaints");
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
        this.textContent = "Hide Resolved Complaints";
    } else {
        form.style.display = "none";
        this.textContent = "Show Resolved Complaints";
    }
});
    function ComplaintsAction(ComplaintID, status) {
        var myret = confirm("Do you want to set the selected complaint as '" + status + "'?\nComplaint Number: " + ComplaintID);
        if (myret === true) {
            let formData = new FormData();
            formData.append('complaintID', ComplaintID);
            formData.append('status', status);
            fetch("/irlts/actions/admin/complaintmgmt.php", {
              method: "POST",
              body: formData
            });
        }
        location.reload(true);
        return false;
    }
</script>

<?php include "../../commonassets/footer.php"; ?>

<style>
h3 {
    font-size: 16px;
    margin: 8px;
}
form {
    margin-top: 24px;
    margin-bottom: 20px;
}

label {
    font-size: 18px;
    font-weight: bold;
}

#resolvedComplaints{
    display: none;
}

#resolvedComplaintsbtn{
    margin-top: 36px;
    margin-left: 9%;
    margin-bottom: 16px;
}

select {
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.info-box {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: left;
    max-width: 80%;
    margin: auto;
    margin-top: 32px;
    display: block;
}

button {
    padding: 10px 15px;
    font-size: 16px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

#toggleFormButton{
    margin-left: 23%;
    margin-top: 24px;
}
</style>
