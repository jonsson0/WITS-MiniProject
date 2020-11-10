<?php


require_once '/home/mir/forum/forum.php';

$uid= $_GET['uid'];
$password= $_GET['password'];
$name= $_GET['name'];
if (isset($_GET['submit'])) {
  if (add_user($uid, $password, $name)) {
    echo "det virker";
  }

  else {
    echo "uid findes i forvejen, prøv med et andet uid";
  }
}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign Up</title>
  </head>
  <body>
    <h1>Sign up</h1>
    <form action="signup.php" method="get">
     <table>
     <tr><td>Username:</td> <td><input type="text" name="uid" required/></td></tr>
     <tr><td>Password:</td> <td><input type="password" name="password" required/></td></tr>
     <tr><td>First name:</td> <td><input type="text" name="name"required/></td></tr>
     <tr><td></td> <td><input type="submit" name="submit" value="Tilmeld dig"></td></tr>
     </table>
    </form>
  </body>
</html>
