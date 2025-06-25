<?php
// Database connection
$conn = mysqli_connect("127.0.0.1", "root", "SQLroot@MySQL", "IRTLS");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$complaintNo = $_POST['complaintID'];
$status = $_POST['status']; // Change this to fetch dynamically if needed

// Insert Query
$query = "UPDATE Complaints
    SET Status = ? 
    WHERE ComplaintID = ?";

$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "si",
        $status, $complaintNo
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "Success!";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
