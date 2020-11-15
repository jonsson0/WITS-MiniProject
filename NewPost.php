<?php
session_start();
require_once '/home/mir/forum/forum.php';
require_once 'TopNavBar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Stylesheet.css">
    <title>New Post</title>
</head>
<body>
<h1>Create a new post</h1>
<div id='PostForm'>
    <form method="get">
        <table>
            <tr>

                <td>Title: <input type='text' id='TitleOfPost' placeholder='Title' name='title' required></td>
            </tr>
            <tr>
                <td>Content: <br><textarea id='ContentOfPost' name='content' placeholder='Type here' required></textarea></td>
            </tr>
            <tr>
                <td>
                    <input type='submit' value='Submit your post'>
                </td>
            </tr>
        </table>
    </form>
</div>
<?php
if (isset($_SESSION['uid'])) {
    if (isset($_GET['title']) && isset($_GET['content'])) {
        $title = $_GET['title'];
        $content = $_GET['content'];
        $newPostID = add_post(0, $title, $content);
        header("Location:Post.php?pid=$newPostID");
    }

}
?>

</body>
</html>