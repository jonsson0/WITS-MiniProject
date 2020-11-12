<?php
session_start();

require_once 'TopNavBar.html';
require_once '/home/mir/forum/forum.php';
$loggedIn = $_SESSION['loggedIn'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MainSite</title>
</head>
<body>
<?php
if ($loggedIn == true) {
    echo $_SESSION['loggedIn'];
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

                echo "<tr class='Post'> <td class='PostTitle'>$postTitle</td> <td class='PostContent'>This is post number $postPID: $postContent</td> <td class='Poster'>Posted by: $nameOfUser</td> <td class='Date'>Posted on: $dateOfPost</td> </tr>";
            }
        }
        ?>

    </table>
</div>
</body>
</html>