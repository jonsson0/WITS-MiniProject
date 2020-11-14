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

    <title>Post</title>
</head>
<body>
<?php
$pid = $_GET['pid'];

$_SESSION['pid'] = $pid;

$PID = $_GET['pid'];
$post = get_post_by_pid($PID);
$postTitle = $post['title'];
$postContent = $post['content'];
$posterUID = $post['uid'];
// getting the name of the poster by using the UID
$user = get_user_by_uid($posterUID);
$nameOfUser = $user['name'];

$dateOfPost = $post['date'];

$numberOfLikes = count_likes_by_pid($PID);

$UIDsWhoHaveLiked = get_likes_by_pid($_GET['pid']);


echo "Title: $postTitle";
echo "<br>";
echo "Content: $postContent";
echo "<br>";
echo "Written by: $nameOfUser";
echo "<br>";
echo "Written on the $dateOfPost";
echo "<br>";
echo "Number of Likes: $numberOfLikes";
echo "<br>";
echo "<br>";

if (isset($_SESSION['uid'])) {

    // if its your post you can;
    // edit post:
    if ($posterUID == $_SESSION['uid']) {
        $_SESSION['oldTitle'] = $postTitle;
        $_SESSION['oldContent'] = $postContent;
        echo "<form method='post' action='EditPost.php'> <button type='submit'>Edit Post</button>";
        echo "<br>";
        echo "</form>";


        // delete post:
        echo "<form method='post'> <tr> <td><button name='deleteButton' type='submit'>Delete Post</button></td> </tr>";
        if (isset($_POST['deleteButton'])) {
            delete_post($_SESSION['pid']);
            header("Location:MainSite.php");
        }
        echo "</form>";
    }
    // add or remove likes:
    echo "You can like or remove your like here:";
    $_SESSION['PIDOfPost'] = $PID;
    echo "<br>";
    echo "<a href='LikeAPost.php'>LIKE</a>";

    foreach ($UIDsWhoHaveLiked as $UID) {
        if ($UID == $_SESSION['uid']) {
            echo " You have liked already";
        }
    }
    echo "<br>";
    echo "<a href='DeleteLike.php'>Remove Like</a>";
    echo "<br>";

    // add comment:
    echo "Comment on post: <br>";
    echo "<form method='post'>";
    echo "<tr><td><input name='commentTitle' required placeholder='Your title on comment'></td></tr> <br>";
    echo "<tr><td><textarea name='commentContent' required placeholder='Content of your comment'></textarea></td></tr> <br>";
    echo "<tr><td><button type='submit' name='addCommentButton'>Add your comment</button></td></tr>";
    echo "</form>";
    $commentTitle = $_POST['commentTitle'];
    $commentContent = $_POST['commentContent'];
    if (isset($_POST['addCommentButton'])) {
        add_post($_GET['pid'], $commentTitle, $commentContent);
    }
}

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "Comments on this post: ";

echo "<div class='TableOfPosts'>";
echo "<table>";

$whatIsWhatInTable = false;

foreach (get_posts_by_parent_pid($PID) as $commentPID) {
    $post = get_post_by_pid($commentPID);

    $postTitle = $post['title'];
    $postContent = $post['content'];
    $posterUID = $post['uid'];
    // getting the name of the poster by using the UID
    $user = get_user_by_uid($posterUID);
    $nameOfUser = $user['name'];
    $dateOfPost = $post['date'];


    // counting the UIDs that have likes the post
    $numberOfLikes = count_likes_by_pid($commentPID);

    // counting number of comments:
    $arrayOfComments = get_posts_by_parent_pid($commentPID);
    $numberOfComments = count($arrayOfComments);

    if (isset($postTitle)) {


        // echoes the header part of a post
        echo " <div class='Post'> <div class='PostHeader'>";

        if ($whatIsWhatInTable == false) {
            echo "<tr> <th>Title:</th> <th>Posted by:</th> <th>Posted on:</th> <th>Content:</th> <th>Number of likes:</th> <th>Number of Comments:</th> </tr>";
            $whatIsWhatInTable = true;
        }

        echo "<tr> <td class='PostTitle' ><a href='Post.php?pid=$commentPID'>$postTitle</a></td> <td class='Poster'>$nameOfUser</td> <td class='Date'>$dateOfPost</td> </div>";

        // echoes the body part of a post
        echo "<div class='PostBody'> <td class='PostContent'>$postContent</td> </div>";

        // echoes the footer part of a post
        echo "<div class='PostFooter'><td class='Likes'>$numberOfLikes</td> <td class='Comments'>$numberOfComments</td></tr> </div> </div>";
    }
}
echo "</table>";
echo "</div>";
?>

</body>
</html>