<?php
session_start();
require_once '/home/mir/forum/forum.php';
require_once 'TopNavBar.php';

$oldTitle = $_SESSION['oldTitle'];
$oldContent = $_SESSION['oldContent'];
$pid = $_SESSION['pid'];
echo "This is the post you are editing: ";
echo "<br>";
echo "Title: ";
echo $oldTitle;
echo "<br>";
echo "Content: ";
echo $oldContent;
echo "<br>";
echo "<br>";


echo "<form method='get' action='EditPost.php?'>";
echo "<table>";
echo "<tr> <td>New title: <input name='newTitle' placeholder=$oldTitle required> </td> </tr> <br>";
echo "<tr> <td>New Content: <br>";
echo "<textarea name='newContent' placeholder=$oldContent required></textarea> </td> </tr> <br>";
echo "<button type='submit'>Done Editing</button>";
echo "</table>";
echo "</form>";

$newTitle = $_GET['newTitle'];
$newContent = $_GET['newContent'];
if (isset($newTitle) && isset($newContent)) {

    modify_post($pid, $newTitle, $newContent);
    header("Location:Post.php?pid=$pid");

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Stylesheet.css">

    <title>EditPost</title>
</head>
<body>

</body>
</html>