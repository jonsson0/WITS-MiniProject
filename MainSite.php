<?php
session_start();
require_once '/home/mir/forum/forum.php';
require_once 'TopNavBar.php';

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
<?php
unset($_SESSION['pid']);
// get all the posts and save in a var
$arrayOfPIDs = get_posts();
// get the number of elements in the array (number of posts and replys in total)

// reversing the array so we get the newest posts first
$reversedArrayOfPIDs = array_reverse($arrayOfPIDs);
// for each of the elements in the array we do stuff with it

$whatIsWhatInTable = false;

echo "<div class='TableOfPosts'>";
echo " <table id='TableOfMainPosts'>";
foreach ($reversedArrayOfPIDs as $PID) {
    // save each element in a var
    $post = get_post_by_pid($PID);


    // if its a Main post (!= reply)
    if ($post['parent_pid'] == 0) {
        // saved the main posts pid, title, content, uid
        // and echoes out a new tr with td which is the text of the main post
        $PID = $post['pid'];
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

            echo " <div class='Post'>";

            echo "<thead id='WhatIsWhat'>";

            if ($whatIsWhatInTable == false) {
                echo "<tr> <th>Title:</th> <th>Posted by:</th> <th>Posted on:</th> <th>Content:</th> <th>Number of likes:</th> <th>Number of Comments:</th> </tr>";
                $whatIsWhatInTable = true;
            }
            echo "</thead>";

            echo "<tbody>";
            echo "<tr> <td class='PostTitle' ><a href='Post.php?pid=$PID'>$postTitle</a></td> <td class='Poster'>$nameOfUser</td> <td class='Date'>$dateOfPost</td>";

            // echoes the body part of a post
            echo "<div class='PostBody'> <td class='PostContent'>$postContent</td> </div>";

            // echoes the footer part of a post
            echo "<div class='PostFooter'><td class='Likes'>$numberOfLikes</td> <td class='Comments'>$numberOfComments</td></tr> </div> </div>";
            echo "<tbody>";
        }
    }
}
echo "</table>";
echo "</div>";
?>
</body>
</html>