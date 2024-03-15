<?php
$conn = new mysqli('localhost', 'root', '', 'myMusic');

if (isset($_GET['id'])) {
    $uid = $_GET['id'];
    $quary = "SELECT * FROM `music` WHERE user_id = '$uid'";
} else {
    $quary = "select * from  music  LIMIT 10";
}
$musics = $conn->query($quary);


if(isset($_SESSION['email'])){
    $session = $_SESSION['email'];
}else{
    $session = null;
}



session_start();
$email =  $session ;

$query = "select * from user where email = '$email'";

$myProfiles = $conn->query($query);

foreach ($myProfiles as $myProfile) {
    $my_id =  $myProfile['id'];



$follow = "select * from follow where following = '$my_id'";
$followings = $conn->query($follow);

}

if (isset($_POST['playlist_btn'])) {

    $playlist_name = $_POST['playlist_name'];

    if (empty($_POST['playlist_name'])) {

        echo '<span style="position: absolute;top:100px;left:100px;background:red;color:white;
">please inter any word in the playlist fiald</span>';
    } else {
        $select = "select * from playlist_name where playlist_name = '$playlist_name' and user_id = $my_id";
        $chekd = $conn->query($select);
        foreach ($chekd as $cheked) {
        }
        if ($cheked) {
            echo '<span style="position: absolute;top:100px;left:100px;background:red;color:white;
">this play list already have it please changed</span';
        } else {
            $query = "INSERT INTO `playlist_name` ( `playlist_name`, `user_id`) VALUES ( '$playlist_name', '$my_id');";
            $test = $conn->query($query);
            header("location:/");
            $conn->close();
        }
    }
}


if (isset($_POST['add_playlist'])) {

    $music_id =  $_POST['music_id'];
    $playlist_id =  $_POST['playlist_id'];


    $query = "INSERT INTO `playlist` ( `playlist_id`, `music_id`) VALUES ( '$playlist_id', '$music_id')";
    if ($conn->query($query)) {
        header("location:/");
    } else {
        echo 'unknown error';
        die();
    }
}


?>
<!DOCTYPE html>
<html onload="darkMode();">


<head>
    <meta charset="UTF-8">
    <title> EreBate </title>
</head>
<link rel="stylesheet" href="../style.css">

<body>