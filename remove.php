<?php 
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
        header("Location:login.php");
    }
    include_once 'db.php';
    $id = $_GET['id'];
    $pid = $_GET['pid'];
    $sid = $_GET['sid'];
    $sql = "Delete from songs where id = '$id' and playlist_no = '$pid' and song_id = '$sid'";
    $result = mysqli_query($conn,$sql);
    if($result){
        header("Location:allsongs.php?id=$id&pid=$pid");
    }
?>