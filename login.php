<?php
session_start();
require_once '/home/mir/forum/forum.php';
require_once 'TopNavBar.php';

$uid = $_GET['uid'];
$password = $_GET['password'];

if (isset($_GET['submit'])) {
    if (login($uid, $password)) {
        echo "du er nu logget på";
        $_SESSION['uid'] = $uid;
        if (isset($_SESSION['pid'])) {
            $pid = $_SESSION['pid'];
            header("Location:Post.php?pid=$pid");
        } else {
            header("Location: MainSite.php");
        }
    } else {
        echo "login fejlede";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Stylesheet.css">

    <title>Login</title>
</head>
<body>
<h1>Login</h1>
<form action="login.php" method="GET">
    <table>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="uid" required/></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password" required/></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Login"></td>
        </tr>
    </table>
</form>

<br>
<div>
    You dont have an account yet? <a href="signup.php">Click here to make an account</a>
</div>
</body>
</html>
