<?php include "../commonassets/header.php"; ?>
    <h1>Admin Registration</h1>
    <br>

    <form action="../actions/admin/adminregistrationhandler.php" method="POST">
        <table>
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="fullname" required></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" required></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
            <tr>
                <td>Authority Type:</td>
                <td><select name="authority_type">
                    <option value="RTO">RTO</option>
                    <option value="Pollution">Pollution Centre</option>
                    <option value="Insurer">Insurer</option>
                </select></td>
            </tr>
        </table>
        <input type="submit" value="Register">
    </form>
<?php include "../commonassets/footer.php"; ?>
<style>
form {
    background: #fff;
    padding: 20px;
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
</style>
