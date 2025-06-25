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
    // Paid fines query (join Violations and FinesPaid)
    $queryPaidFines = "SELECT v.ViolationNo, v.DateAndTime, v.RegisterNo, v.Fine, f.DateTime AS PaymentDate, f.ReceiptNo
                       FROM Violations v
                       JOIN FinesPaid f ON v.ViolationNo = f.ViolationNo
                       WHERE v.RegisterNo IN ('$vehicleList')";
    $resultPaidFines = mysqli_query($conn, $queryPaidFines);

    // Unpaid violations query
    $queryUnpaidViolations = "SELECT * FROM Violations WHERE ViolationNo NOT IN (SELECT ViolationNo FROM FinesPaid)";
    $resultUnpaidViolations = mysqli_query($conn, $queryUnpaidViolations);
?>

<?php include "../../commonassets/header.php"; ?>
<h1>Traffic Violations</h1>

<button id="toggleFormButton">File New Violation</button>
<form method="POST" action="trafficviolations.php" id="violationForm" style="display: none;">
    <table>
        <tr>
            <td><label for="registerno">Registration Number:</label></td>
            <td><input type="text" name="registerno" required></td>
        </tr>
        <tr>
            <td><label for="violatorlno">Violator License Number:</label></td>
            <td><input type="text" name="violatorlno" required></td>
        </tr>
        <tr>
            <td><label for="offenses">Offenses:</label></td>
            <td><input type="text" name="offenses" required></td>
        </tr>
        <tr>
            <td><label for="fineamt">Fine Amount:</label></td>
            <td><input type="text" name="fineamt" required></td>
        </tr>
        <tr>
            <td><label for="location">Location of Incident:</label></td>
            <td><input type="text" name="location" required></td>
        </tr>
    </table>
    <br><br>
    <button type="submit">Add Violation</button>
</form>

<!-- Paid Fines Table -->
<div id="paidFines" class="info-box">
    <h2>Paid Fines</h2>
    <?php if (mysqli_num_rows($resultPaidFines) > 0): ?>
        <table border="1">
            <tr><th>Violation No</th><th>Date & Time</th><th>Registration No</th><th>Fine</th><th>Payment Date</th><th>Receipt No</th></tr>
            <?php while ($row = mysqli_fetch_assoc($resultPaidFines)): ?>
                <tr>
                    <td><?php echo $row['ViolationNo']; ?></td>
                    <td><?php echo $row['DateAndTime']; ?></td>
                    <td><?php echo $row['RegisterNo']; ?></td>
                    <td><?php echo $row['Fine']; ?></td>
                    <td><?php echo $row['PaymentDate']; ?></td>
                    <td><?php echo $row['ReceiptNo']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No paid fines found.</p>
    <?php endif; ?>
</div>

<!-- Unpaid Violations Table -->
<div id="unpaidViolations" class="info-box">
    <h2>Unpaid Violations</h2>
    <?php if (mysqli_num_rows($resultUnpaidViolations) > 0): ?>
        <table border="1">
            <tr><th>Violation No</th><th>Date & Time</th><th>Registration No</th><th>Violator License</th><th>Fine</th><th>Place of Incident</th></tr>
            <?php while ($row = mysqli_fetch_assoc($resultUnpaidViolations)): ?>
                <tr>
                    <td><?php echo $row['ViolationNo']; ?></td>
                    <td><?php echo $row['DateAndTime']; ?></td>
                    <td><?php echo $row['RegisterNo']; ?></td>
                    <td><?php echo $row['ViolatorInfo']; ?></td>
                    <td><?php echo $row['Fine']; ?></td>
                    <td><?php echo $row['PlaceOfIncident']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No unpaid violations found.</p>
    <?php endif; ?>
</div>

<?php include "../../commonassets/footer.php"; ?>

<style>
form {
    margin-top: 24px;
    margin-bottom: 20px;
}

label {
    font-size: 18px;
    font-weight: bold;
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
    max-width: 800px;
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

<script>
// JavaScript to toggle the visibility of the "File New Violation" form
document.getElementById("toggleFormButton").addEventListener("click", function() {
    var form = document.getElementById("violationForm");
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
        this.textContent = "Hide Form";
    } else {
        form.style.display = "none";
        this.textContent = "File New Violation";
    }
});
</script>
