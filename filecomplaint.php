<?php include "commonassets/header.php"; ?>
    <h1>File a Complaint</h1>
    <br>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <table>
        <tr>
            <td colspan="2">
                <h2>Fill out the below form to file a complaint against a vehicle</h2>
            </td>
        </tr>
        <tr>
            <td>Complainee Contact Number</td>
            <td><input type="number" name="contact"></td>
        </tr>
        <tr><td></td></tr>
        <tr>
            <td>Date of Incident</td>
            <td><input type="date" name="doi"></td>
        </tr>
        <tr><td></td></tr>
        <tr>
            <td style="vertical-align: top;">Location of Incident</td>
            <td><textarea name="loc"></textarea></td>
        </tr>
        <tr>
            <td>Register Number of the Vehicle</td>
            <td><input type="text" name="reg"></td>
        </tr>
        <tr><td></td></tr>
        <tr>
            <td style="vertical-align: top;">Description of Incident</td>
            <td><textarea name="desc"></textarea></td>
        </tr>
    </table>
    <input type="submit" value="File Complaint">
    </form>
<?php include "commonassets/footer.php"; ?>


<?php
    $contact = $_POST['contact'];
    $doi = $_POST['doi'];
    $loc = $_POST['loc'];
    $reg = $_POST['reg'];
    $desc = $_POST['desc'];

    $query = "INSERT INTO Complaints (ComplaineeContact, DateTime, Location, RegisterNo, Description, Status) VALUES($contact,'$doi','$loc','$reg','$desc','PENDING');";
    $conn = mysqli_connect("127.0.0.1","root","SQLroot@MySQL","IRTLS");
    mysqli_query($conn, $query);
    echo "Done";
?>
