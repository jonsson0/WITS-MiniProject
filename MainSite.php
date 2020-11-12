<?php
session_start();

require_once 'TopNavBar.php';
require_once '/home/mir/forum/forum.php';
$uid = $_SESSION['uid'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Stylesheet.css">

    <title>MainSite</title>
</head>
<body>
<?php
if (isset($uid)) {
    echo $uid;
    echo "<br>";
    echo "we are logged in baby";

} else {
    echo "Go to the login page to login";
}
?>
<br>
<div class="TableOfPosts">
    <table>
        <?php
        // get all the posts and save in a var
        $arrayOfPosts = get_posts();
        // get the number of elements in the array (number of posts and replys in total)
        $numberOfPosts = count($arrayOfPosts);

        // running through all the posts
        for ($i = 1; $i < $numberOfPosts; $i++) {
            // save number i post in a var
            $post = get_post_by_pid($i);


            // if its a Main post (!= reply)
            if ($post['parent_pid'] == 0) {
                // saved the main posts pid, title, content, uid
                // and echoes out a new tr with td which is the text of the main post
                $postPID = $post['pid'];
                $postTitle = $post['title'];
                $postContent = $post['content'];
                $posterUID = $post['uid'];
                // getting the name of the poster by using the UID
                $user = get_user_by_uid($posterUID);
                $nameOfUser = $user['name'];
                $dateOfPost = $post['date'];

                // echoes the header part of a post
                echo "<div class='Post'> <div class='PostHeader'> <tr> <td class='PostTitle'>$postTitle</td> <td class='Poster'>Posted by: $nameOfUser</td> <td class='Date'>Posted on: $dateOfPost</td> </div>";

                // echoes the body part of a post
                echo "<div class='PostBody'> <td class='PostContent'>This is post number $postPID: $postContent</td> </div>";

                // echoes the footer part of a post
                echo "<div class='PostFooter'><td class='NumberOfLikes'>INSET NUMBER OF LIKES</td> <td><button class='LikeButton' onclick='likePost()'>Like</td> <td class='NumberOfLikes'>INSERT NUMBER OF LIKES</td> </tr> </div> </div>";

            }
        }
        ?>



    </table>
</div>
<script>
    function likePost() {

    }

</script>
</body>
</html>