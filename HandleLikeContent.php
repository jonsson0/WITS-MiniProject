<?php
session_start();

require_once '/home/mir/forum/forum.php';

$nothing = '';
$pid = $_SESSION['PIDOfPost'];

if (isset($_GET['like'])) {
    add_like($pid);
    echo "Post Has Been Liked";
    file_put_contents("SetterFile.txt", $nothing);
    $arrayOfUIDsWhoHaveLiked = get_likes_by_pid($pid);
    $numberOfLikes = count($arrayOfUIDsWhoHaveLiked);
    file_put_contents("SetterFile.txt", $numberOfLikes);
} else if (isset($_GET['unlike'])) {
    delete_like($pid);
    echo "Like from post has been removed";
    file_put_contents("SetterFile.txt", $nothing);
    $arrayOfUIDsWhoHaveLiked = get_likes_by_pid($pid);
    $numberOfLikes = count($arrayOfUIDsWhoHaveLiked);
    file_put_contents("SetterFile.txt", $numberOfLikes);
}
?>