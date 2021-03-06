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
    $user = get_user_by_uid($uid);
    $nameOfUser = $user['name'];
    echo "<h1>Welcome $nameOfUser to our forum - made by Mads Jönsson og Sebastian Sundberg</h1>";
    echo "<h3>Here is a list of all the posts on our forum <br> Click the title to go to the specific post</h3>";

} else {
    echo "<h1>Welcome to our forum - made by Mads Jönsson og Sebastian Sundberg</h1> <br>";
    echo "<h3>Go to the login page to login or sign up</h3>";
}
?>
<?php
unset($_SESSION['pid']);
// get all the posts and save in a var
$arrayOfPIDs = get_posts();

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
        $dateOfPost = $post['date'];

        // getting the name of the poster by using the UID
        $user = get_user_by_uid($posterUID);
        $nameOfUser = $user['name'];

        // counting the UIDs that have likes the post
        $numberOfLikes = count_likes_by_pid($PID);

        // counting number of comments:
        $arrayOfComments = get_posts_by_parent_pid($PID);
        $numberOfComments = count($arrayOfComments);

        // only show a post if they have a title and content
        if (!empty($postTitle) && !empty($postContent)) {
            // echoes the header part of a post

            echo " <div class='Post'>";

            echo "<thead id='WhatIsWhat'>";

            if ($whatIsWhatInTable == false) {
                echo "<tr> <th>Title:</th> <th>Posted by:</th> <th>Posted on:</th> <th>Content:</th> <th>Number of likes:</th> <th>Number of Comments:</th> </tr>";
                $whatIsWhatInTable = true;
            }
            echo "</thead>";

            echo "<tbody>";
            // echoes the head of the body of the post
            echo "<tr><div class='PostHead'> <td class='PostTitle' ><a href='Post.php?pid=$PID'>$postTitle</a></td> <td class='Poster'>$nameOfUser</td> <td class='Date'>$dateOfPost</td></div>";

            // echoes the body of the body of the post
            echo "<div class='PostBody'> <td class='PostContent'>$postContent</td> </div>";

            // echoes the footer of the body of the post
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