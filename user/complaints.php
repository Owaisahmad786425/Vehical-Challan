<?php include "../commonassets/header.php"; ?>
    <h1>Complaints Against Your Vehicles</h1>
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

        $query = "SELECT RegisterNo FROM OwnedBy WHERE LicenseNo='$LicenseNo'";
        $result = mysqli_query($conn, $query);
        $vehicles = array_column(mysqli_fetch_all($result, MYSQLI_ASSOC), "RegisterNo");

        // Convert the array of vehicle RegisterNos into a comma-separated string
        $vehicleList = implode("','", array_map(function($vehicle) use ($conn) {
            return mysqli_real_escape_string($conn, $vehicle);
            }, $vehicles));

        // Add single quotes around the vehicle IDs for SQL syntax and add the IN clause
        $query = "SELECT * FROM Complaints WHERE RegisterNo IN ('$vehicleList')";
        $result = mysqli_query($conn, $query);




        // Display Complaints Against User's Vehicles
        if (!empty($vehicles)) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Complaint ID</th><th>Vehicle No</th><th>Date & Time</th><th>Location</th><th>Description</th><th>Status</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["ComplaintID"] . "</td>";
                    echo "<td>" . $row["RegisterNo"] . "</td>";
                    echo "<td>" . $row["DateTime"] . "</td>";
                    echo "<td>" . $row["Location"] . "</td>";
                    echo "<td>" . $row["Description"] . "</td>";
                    echo "<td>" . $row["Status"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No complaints found against your vehicles.</p>";
            }
        } else {
            echo "<p>You do not own any registered vehicles.</p>";
        }
    ?>
</div>
<?php include "../commonassets/footer.php"; ?>


<style>
    #table_view {
    background: #fff;
    margin-top: 96px;
    margin: 32px;
    padding: 64px;
    padding-top: 16px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: 0 auto;
    width: 90%;
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
