<?php
session_start();

require_once '/home/mir/forum/forum.php';
if (isset($_GET["login"])) {

    if(login(($_GET["uid"]),($_GET["password"]))){
        header("Location: hemmelig.php");
        echo $_SESSION["uid"];
    }
    else {
        echo "denne kombi af uid og password findes ikke - Prøv igen";

    }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>login</title>
</head>
<body>
<form class="" action="" method="GET">
    <input type="text" name="uid" placeholder="uid" /required>
    <input type="password" name="password" placeholder="password" /required>
    <input type="submit" name="login" value="login">

</form>

</body>
</html>
