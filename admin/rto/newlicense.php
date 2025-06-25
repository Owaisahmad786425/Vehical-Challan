<?php
$successMessage = "";
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $licenseNo = $_POST["licenseNo"];
    $name = $_POST["name"];
    $authorizedVehicleClasses = $_POST["authorizedVehicleClasses"];
    $dateOfIssue = $_POST["dateOfIssue"];
    $dateOfBirth = $_POST["dateOfBirth"];
    $permanentAddress = $_POST["permanentAddress"];
    $presentAddress = $_POST["presentAddress"];
    $swd = $_POST["swd"];
    $bloodGroup = $_POST["bloodGroup"];

    // Database Connection
    $conn = mysqli_connect("127.0.0.1","root","SQLroot@MySQL","IRTLS");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO DriverInfo (LicenseNo, Name, AuthorizedVehicleClasses, DateOfIssue, DateOfBirth, PermanentAddress, PresentAddress, SWD, BloodGroup) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssissssss", $licenseNo, $name, $authorizedVehicleClasses, $dateOfIssue, $dateOfBirth, $permanentAddress, $presentAddress, $swd, $bloodGroup);

        if (mysqli_stmt_execute($stmt)) {
            $successMessage = "Driver added successfully!";
        } else {
            $errorMessage = "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        $errorMessage = "Error preparing statement: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<?php include "../../commonassets/header.php"; ?>
    <h1 style="padding-top: 16px;">Add New Driver</h1>
    <h2 style="padding-top: 12px; padding-left: 32px;">Enter driver details to register them in the system.</h2>

    <?php if (!empty($successMessage)) echo "<h3 class='success' style='padding-left: 32px;'>$successMessage</h3>"; ?>
    <?php if (!empty($errorMessage)) echo "<h3 class='error' style='padding-left: 32px;'>$errorMessage</h3>"; ?>

    <form method="POST" action="newlicense.php">
        <table>
            <tr>
                <td><label for="licenseNo">License Number:</label></td>
                <td><input type="text" id="licenseNo" name="licenseNo" required></td>
            </tr>
            <tr>
                <td><label for="name">Full Name:</label></td>
                <td><input type="text" id="name" name="name" required></td>
            </tr>
            <tr>
                <td><label for="authorizedVehicleClasses">Authorized Vehicle Classes:</label></td>
                <td><input type="number" id="authorizedVehicleClasses" name="authorizedVehicleClasses" required></td>
            </tr>
            <tr>
                <td><label for="dateOfIssue">Date of Issue:</label></td>
                <td><input type="date" id="dateOfIssue" name="dateOfIssue" required></td>
            </tr>
            <tr>
                <td><label for="dateOfBirth">Date of Birth:</label></td>
                <td><input type="date" id="dateOfBirth" name="dateOfBirth" required></td>
            </tr>
            <tr>
                <td><label for="permanentAddress">Permanent Address:</label></td>
                <td><textarea id="permanentAddress" name="permanentAddress" required></textarea></td>
            </tr>
            <tr>
                <td><label for="presentAddress">Present Address:</label></td>
                <td><textarea id="presentAddress" name="presentAddress" required></textarea></td>
            </tr>
            <tr>
                <td><label for="swd">Son/Wife/Daughter of:</label></td>
                <td><input type="text" id="swd" name="swd" required></td>
            </tr>
            <tr>
                <td><label for="bloodGroup">Blood Group:</label></td>
                <td><select id="bloodGroup" name="bloodGroup" required>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select></td>
            </tr>
        </table>
        <br><br>
        <button type="submit">Add Driver</button>
    </form>
<?php include "../../commonassets/footer.php"; ?>
