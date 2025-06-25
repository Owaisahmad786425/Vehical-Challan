<?php include "../commonassets/header.php"; ?>
    <br><br>
    <div id="table_view">
    <?php
        $conn = mysqli_connect("localhost","root","SQLroot@MySQL","IRTLS");
        $username = $_COOKIE['uname'];

        $query = "SELECT * FROM CommonUsers WHERE UserID='$username'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);
            $LicenseNo = $row["LicenseNo"];
        }

        $query = "SELECT * FROM DriverInfo WHERE LicenseNo='$LicenseNo'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result); // Fetch single row

            echo "<table>";
            echo "<tr><td><b>License No</b></td><td>" . $row["LicenseNo"] . "</td></tr>";
            echo "<tr><td><b>Name</b></td><td>" . $row["Name"] . "</td></tr>";
            echo "<tr><td><b>Authorized Vehicle Classes</b></td><td>" . $row["AuthorizedVehicleClasses"] . "</td></tr>";
            echo "<tr><td><b>Date of Issue</b></td><td>" . $row["DateOfIssue"] . "</td></tr>";
            echo "<tr><td><b>Date of Birth</b></td><td>" . $row["DateOfBirth"] . "</td></tr>";
            echo "<tr><td><b>Permanent Address</b></td><td>" . $row["PermanentAddress"] . "</td></tr>";
            echo "<tr><td><b>Present Address</b></td><td>" . $row["PresentAddress"] . "</td></tr>";
            echo "<tr><td><b>Son/Wife/Daughter Of</b></td><td>" . $row["SWD"] . "</td></tr>";
            echo "<tr><td><b>Blood Group</b></td><td>" . $row["BloodGroup"] . "</td></tr>";
            echo "</table>";
        } else {
            echo "No records found for License No: " . htmlspecialchars($LicenseNo);
        }
    ?>
</div>
<?php include "../commonassets/footer.php"; ?>
<style>
    #table_view {
    background: #fff;
    margin-top: 96px;
    margin: 64px;
    padding: 20px;
    padding-top: 16px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: 0 auto;
    width: 80%;
    max-width: 800px;
}
table {
    width: 100%;
    font-size: 18px;
    margin-bottom: 20px;
    border-collapse: collapse;
}
table td {
    padding: 10px;
    vertical-align: middle;
    text-align: left;
}

textarea {
    width: 100%;
    height: 96px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1rem;
    resize: none;
}

table input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1rem;
}
table input:focus {
    border-color: #007bff;
    outline: none;
}

table select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1rem;
}
table select:focus {
    border-color: #007bff;
    outline: none;
}
</style>
