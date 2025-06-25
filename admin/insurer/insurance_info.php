<?php include "../../commonassets/header.php"; ?>
    <div class="content">
    <h1>Insurance Information</h1>
    <br>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="upperbox">
    <div class="basicdetails">
      <h2> Basic Details</h2>
    <table>
        <tr>
            <td>Vehicle Registration Number</td>
            <td><input type="text" name="RegisterNo"></td>
        </tr>
        <tr>
            <td>Registration Authority</td>
            <td><input type="text" name="RegistrationAuthority"></td>
        </tr>
        <tr>
            <td>Customer ID</td>
            <td><input type="number" name="CustomerID"></td>
        </tr>
    </table>
    </div>
    <br>
  <div class="policydetails">
   <h2>Policy Details</h2>
    <table>
        <tr>
            <td>Policy Issuer</td>
            <td><input type="text" name="PolicyIssuer"></td>
        </tr>
        <tr>
            <td>Financier Name</td>
            <td><input type="text" name="FinancierName"></td>
        </tr>
        <tr>
            <td>Package Name</td>
            <td><input type="text" name="PackageName"></td>
        </tr>
        <tr>
            <td>Insured Declared Value</td>
            <td><input type="number" name="InsureDeclared"></td>
        </tr>
        <tr>
            <td>Premium To Be Paid (Total)</td>
            <td><input type="number" name="PremiumTBP"></td>
        </tr>
        <tr>
            <td>Start Date of Policy</td>
            <td><input type="date" name="IssueDate"></td>
        </tr>
        <tr>
            <td>End Date of Policy</td>
            <td><input type="date" name="EndDate"></td>
        </tr>
        <tr>
            <td>Receipt Number</td>
            <td><input type="number" name="ReceiptNo"></td>
        </tr>
        <tr>
            <td>Policy Number</td>
            <td><input type="number" name="PolicyNo"></td>
        </tr>
    </table>
</div>
    </div>
   <div class="lowerbox">
    <h2>Contact Information</h2>
    <div class="lefttbox">
    <br>
    <h3>Policy Issuing Office</h3>
    <table>
        <tr>
            <td style="vertical-align: top;">Address</td>
            <td><textarea name="PIO_Addr"></textarea></td>
        </tr>
        <tr>
            <td>Contact Number</td>
            <td><input type="number" name="PIO_No"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="email" name="PIO_Email"></td>
        </tr>
    </table>
</div>
 <div class="rightbox">
    <br>
    <h3>Claim Contact</h3>
    <table>
        <tr>
            <td style="vertical-align: top;">Address</td>
            <td><textarea name="CCName"></textarea></td>
        </tr>
        <tr>
            <td>Contact Number</td>
            <td><input type="number" name="CCNo"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="email" name="CCEmail"></td>
        </tr>
    </table>
</div>
</div>
    <input type="submit" value="Create Insurance Record">

    </form>
    </div>

<?php include "../../commonassets/footer.php"; ?>

<?php
// Connect to MySQL
$conn = mysqli_connect("127.0.0.1", "root", "SQLroot@MySQL", "IRTLS");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare SQL query (fixed columns and placeholders)
$query = "INSERT INTO InsuranceDetails
(PolicyNo, PolicyIssuer, CustomerID, ReceiptNo, ClaimContact, RegistrationAuthority, FinancierName, RegisterNo, PremiumTBP, InsureDeclared, IssueDate, EndDate, PackageName)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare the statement
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    // Concatenate necessary values before binding
    $policyIssuer = $_POST['PIO_Addr'] . " " . $_POST['PIO_Email'] . " " . $_POST['PIO_No']; // Policy Issuer
    $claimContact = $_POST['CCName'] . " " . $_POST['CCEmail'] . " " . $_POST['CCNo']; // Claim Contact

    // Bind parameters to prevent SQL injection
    mysqli_stmt_bind_param($stmt, "ssssssssddsss",
        $_POST['PolicyNo'],          // i (integer)
        $policyIssuer,               // s (string)
        $_POST['CustomerID'],        // i (integer)
        $_POST['ReceiptNo'],         // s (string)
        $claimContact,               // s (string)
        $_POST['RegistrationAuthority'], // s (string)
        $_POST['FinancierName'],     // s (string)
        $_POST['RegisterNo'],        // s (string)
        $_POST['PremiumTBP'],        // d (double)
        $_POST['InsureDeclared'],    // d (double)
        $_POST['IssueDate'],         // s (string)
        $_POST['EndDate'],           // s (string)
        $_POST['PackageName']        // s (string)
    );

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        echo "Done";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
