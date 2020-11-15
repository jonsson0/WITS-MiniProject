<?php
session_start();

require_once '/home/mir/forum/forum.php';

logout();
if (isset($_SESSION['pid'])) {
    $pid = $_SESSION['pid'];
    header("Location:Post.php?pid=$pid");
} else {
    header("Location: MainSite.php");
}
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