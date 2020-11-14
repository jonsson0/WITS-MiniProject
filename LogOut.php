<?php
session_start();

require_once '/home/mir/forum/forum.php';

$pid = $_GET['pid'];

$_SESSION['PIDOfPost'] = $_GET['pid'];

$pidOfPost = $_SESSION['pid'];

header("Location:Post.php?pid=$pidOfPost");

logout();

header("Location:Post.php?pid=");

//header("Location:MainSite.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
</head>
<body>

</body>
</html>