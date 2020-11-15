<?php
session_start();
require_once '/home/mir/forum/forum.php';


$pid = $_SESSION['PIDOfPost'];
add_like($pid);
echo "Post Has Been Liked";
header("Location:Post.php?pid=$pid");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Like a Post</title>
</head>
<body>

</body>
</html>