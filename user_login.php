<?php
session_start();
$error = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : '';
unset($_SESSION['login_error']); // Clear the error after displaying
?>

<?php include "commonassets/header.php"; ?>
    <h1>User Login</h1>
    <br>
    <form action="actions/userloginhandler.php" method="POST">
     <?php if (!empty($error)): ?>
        <p style="color: red; text-align: center;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <table>
        <tr>
            <td colspan="2">
                <h2>Enter your credentials to log in</h2>
            </td>
        </tr>
        <tr>
            <td>Username</td>
            <td><input type="text" name="username" required></td>
        </tr>
        <tr><td></td></tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" required></td>
        </tr>
        <tr><td></td></tr>
        <tr>
            <td colspan="2" class="center">
                <input type="submit" value="Login">
            </td>
        </tr>
        <tr>
            <td colspan="2" class="center">
                <a href="forgot_password.php">Forgot Password?</a> |
                <a href="user/user_registration.php">Register</a>
            </td>
        </tr>
    </table>
    </form>
<?php include "commonassets/footer.php"; ?>

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

input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1rem;
}

input:focus {
    border-color: #007bff;
    outline: none;
}

input[type="submit"] {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 4px;
    font-size: 1rem;
    cursor: pointer;
    width: 100%;
    height: 56px;
    font-size: 20px;
}
input[type="submit"]:hover {
    background-color: #0056b3;
}

.center {
    text-align: center;
}

a {
    color: #003366;
    text-decoration: none;
    font-size: 16px;
}

a:hover {
    text-decoration: underline;
}
</style>
