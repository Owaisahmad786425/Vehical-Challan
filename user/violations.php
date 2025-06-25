<?php include "../commonassets/header.php"; ?>
<?php
    // Existing connection to the database
    $conn = mysqli_connect("localhost", "root", "SQLroot@MySQL", "IRTLS");
    if (!$conn) {
        die("<script>alert('Connection Failed')</script>");
    }

    $username = $_COOKIE['uname'];

    // Get License Number of the user
    $query = "SELECT LicenseNo FROM CommonUsers WHERE UserID='$username'";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $LicenseNo = $row["LicenseNo"];
    } else {
        die("No user found.");
    }

    // Get Vehicle(s) owned by the user
    $vehicles = [];
    $query = "SELECT RegisterNo FROM OwnedBy WHERE LicenseNo='$LicenseNo'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $vehicles[] = $row["RegisterNo"];
    }

    // Display Driver Violations
    echo "<br><h2 style='text-align: left;'>Violations Committed by Driver</h2>";
    $query = "SELECT * FROM Violations WHERE ViolatorInfo='$LicenseNo'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Violation No</th><th>Date & Time</th><th>Offense</th><th>Fine</th><th>Location</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["ViolationNo"] . "</td>";
            echo "<td>" . $row["DateAndTime"] . "</td>";
            echo "<td>" . $row["Offenses"] . "</td>";
            echo "<td>" . $row["Fine"] . "</td>";
            echo "<td>" . $row["PlaceOfIncident"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align: left;'>No violations found for the driver.</p>";
    }

    // Display Vehicle Violations
    echo "<br><br><br><br><br><br><h2 style='text-align: left;'>Violations Committed by Vehicle(s)</h2>";
    if (!empty($vehicles)) {
        $vehicle_list = "'" . implode("','", $vehicles) . "'"; // Creating a list of owned vehicle registration numbers
        $query = "SELECT * FROM Violations WHERE RegisterNo IN ($vehicle_list)"; // Querying violations for vehicles
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Violation No</th><th>Vehicle No</th><th>Date & Time</th><th>Offense</th><th>Fine</th><th>Location</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["ViolationNo"] . "</td>";
                echo "<td>" . $row["RegisterNo"] . "</td>";
                echo "<td>" . $row["DateAndTime"] . "</td>";
                echo "<td>" . $row["Offenses"] . "</td>";
                echo "<td>" . $row["Fine"] . "</td>";
                echo "<td>" . $row["PlaceOfIncident"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='text-align: left;'>No violations found for the user's vehicles.</p>";
        }
    } else {
        echo "<p style='text-align: left;'>User does not own any registered vehicles.</p>";
    }
?>
<?php include "../commonassets/footer.php"; ?>
<style>
form {
    background: #fff;
    padding: 20px;
    padding-top: 16px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: 0 auto;
    width: 80%;
    max-width: 600px;
}

table {
    width: 90%;
    font-size: 18px;
    margin: 48px;
    border-collapse: collapse;
}
table td {
    padding: 10px;
    vertical-align: middle;
    text-align: left;
}
</style>
