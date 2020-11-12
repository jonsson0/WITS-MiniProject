<?php

$file = file_get_contents("Likes.txt");

if (isset($_GET['likes'])) {
    $file = file_get_contents('likes.txt');
}
file_put_contents("Likes.txt", $file);
echo $file;
?>
