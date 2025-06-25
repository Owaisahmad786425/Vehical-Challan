<?php
// Database connection
$conn = mysqli_connect("127.0.0.1", "root", "SQLroot@MySQL", "IRTLS");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$registerNo = $_POST['register_no'];
$testingCenterCode = $_POST['testcode']; // Change this to fetch dynamically if needed
$dateTime = date("Y-m-d H:i:s");
$feeCharged = $_POST['fees']; // Set dynamically if needed
$result = $_POST['result'];
$validUpto = date("Y-m-d", strtotime("+1 year"));

// Collect values and convert to JSON
$k_values = json_encode(array_filter([
    $_POST['k_value1'], $_POST['k_value2'], $_POST['k_value3']
], fn($value) => $value !== ""));

$idle_rpm = json_encode(array_filter([
    $_POST['idle_rpm1'], $_POST['idle_rpm2'], $_POST['idle_rpm3']
], fn($value) => $value !== ""));

$max_rpm = json_encode(array_filter([
    $_POST['max_rpm1'], $_POST['max_rpm2'], $_POST['max_rpm3']
], fn($value) => $value !== ""));

$oil_temp = json_encode(array_filter([
    $_POST['oil_temp1'], $_POST['oil_temp2'], $_POST['oil_temp3']
], fn($value) => $value !== ""));

// Insert Query
$query = "INSERT INTO PollutionCertificate
    (RegisterNo, TestingCenterCode, DateTime, FeeCharged, Result, ValidUpto, K_VALUE, IDLE_RPM, MAX_RPM, OIL_TEMP) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sisissssss",
        $registerNo, $testingCenterCode, $dateTime, $feeCharged, $result, $validUpto, 
        $k_values, $idle_rpm, $max_rpm, $oil_temp
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "Pollution Certificate Generated Successfully!";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
