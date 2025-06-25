<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="/irlts/commonassets/style.css">
</head>
<body>
<header>
    <div class="container">
        <h1>Integrated Road Transport and Licensing System</h1>
        <nav>
            <ul>
                <li><a href="/irlts/home.php">Home</a></li>
                <li><a href="/irlts/about_us.php">About</a></li>
                <li><a href="/irlts/contact_us.php">Contact</a></li>
                <?php
                    if (!($_COOKIE['uname'])){
                        echo '<li><a href="/irlts/user_login.php">User Login</a></li>';
                    }
                    else{
                        echo '<li><a href="/irlts/actions/user_logout.php">Logout</a></li>';
                    }
                ?>
            </ul>
        </nav>
    </div>
</header>
