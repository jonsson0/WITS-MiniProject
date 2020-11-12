<?php
session_start();
require_once '/home/mir/forum/forum.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Stylesheet.css">
</head>
<body>
<?php
echo "<div class='topNav'>";
// echoes main site "button"
echo "<a id='HomeButton' href='MainSite.php'>Home</a>";
// if not logged in echo login "button"
if (!isset($_SESSION['uid'])) {
    echo "<a id='LoginButton' href='login.php'>Login</a>";
}
// if logged in echo new post
if (isset($_SESSION['uid'])) {
    echo "<a id='NewPost' href='NewPost.php'>new Post</a>";
    echo "<a id='LogOut' href='LogOut.php'>Log Out</a>";
}
echo "</div>";
?>
</body>
</html>
