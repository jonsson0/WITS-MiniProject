<?php
session_start();
require_once '/home/mir/forum/forum.php';
require_once 'TopNavBar.html';
$uid= $_GET['uid'];
$password= $_GET['password'];

if (isset($_GET['submit'])) {
  if (login($uid, $password)) {
    echo "du er nu logget på";
  } else {
    echo "login fejlede";
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <h1>Login</h1>
    <form action="login.php" method="get">
     <table>
     <tr><td>Username:</td> <td><input type="text" name="uid" required/></td></tr>
     <tr><td>Password:</td> <td><input type="password" name="password" required/></td></tr>
     <tr><td></td> <td><input type="submit" name="submit" value="Login"></td></tr>
     </table>
    </form>
  </body>
</html>
