<?php
// Database connection
$conn = mysqli_connect("127.0.0.1", "root", "SQLroot@MySQL", "IRTLS");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare and bind
$query = "INSERT INTO Administrator (UserID, Password, Name, AuthorityType) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    // Hash password for security
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss",
        $_POST['username'],
        $hashedPassword,
        $_POST['fullname'],
        $_POST['authority_type']
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "Registration successful! <a href='../../admin/admin_login.php'>Login here</a>";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
