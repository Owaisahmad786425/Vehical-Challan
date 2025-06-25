<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = mysqli_connect("127.0.0.1","root","SQLroot@MySQL","IRTLS");
    if ($conn){
        echo "<script>alert('Connected Successfully')</script>";
    } else{
        echo "<script>alert('Connection Failed')</script>";
    }
    $query = "SELECT * FROM CommonUsers WHERE UserID='$username' ";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result)>0) {
        // Fetching the password...
        $query = "SELECT * FROM CommonUsers WHERE UserID='$username';";
        $passresult = mysqli_query($conn, $query);
        if (mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row["Password"];
        }
        if (password_verify($password, $hashedPassword)) {
            setcookie("uname", $username, time()+3600, "/");
            header("Location: ../user/dashboard.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Incorrect Password";
            header("Location: ../user_login.php");
            exit();
        }

    } else {
        $_SESSION['login_error'] = "User not found";
        header("Location: ../user_login.php");
        exit();
    }
}
?>
