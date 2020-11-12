<?php
session_start();
require_once '/home/mir/forum/forum.php';
require_once 'TopNavBar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post</title>
</head>
<body>
<?php
$PID = $_GET['pid'];
$post = get_post_by_pid($PID);
$postTitle = $post['title'];
$postContent = $post['content'];
$posterUID = $post['uid'];
// getting the name of the poster by using the UID
$user = get_user_by_uid($posterUID);
$nameOfUser = $user['name'];
$dateOfPost = $post['date'];


echo "Title: $postTitle";
echo "<br>";
echo "Content: $postContent";
echo "<br>";
echo "Written by: $nameOfUser";
echo "<br>";
echo "Written on the $dateOfPost";
echo "<br>";
?>

<?php
echo "<div class='TableOfPosts'>";
echo "<table>";

echo "Comments on this post: ";
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
    $numberOfLikes = count_likes_by_pid($PID);

    // counting number of comments:
    $arrayOfComments = get_posts_by_parent_pid($PID);
    $numberOfComments = count($arrayOfComments);

    if (isset($postTitle)) {
        // echoes the header part of a post
        echo " <div class='Post'> <div class='PostHeader'> <tr> <td class='PostTitle' ><a href='Post.php?PID=$commentPID'>$postTitle</a></td> <td class='Poster'>Posted by: $nameOfUser</td> <td class='Date'>Posted on: $dateOfPost</td> </div>";

        // echoes the body part of a post
        echo "<div class='PostBody'> <td class='PostContent'>Content: $postContent</td> </div>";

        // echoes the footer part of a post
        echo "<div class='PostFooter'><td class='Likes'>Number of likes: $numberOfLikes</td> <td class='Comments'>Number of Comments: $numberOfComments</td></tr> </div> </div>";
    }
}
echo "</table>";
echo "</div>";
?>

</body>
</html>