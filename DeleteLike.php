<?php
session_start();
require_once '/home/mir/forum/forum.php';

$pid = $_SESSION['PIDOfPost'];

delete_like($pid);
echo "Like from post has been removed";

header("Location:Post.php?pid=$pid");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete post</title>
</head>
<body>

</body>
</html>