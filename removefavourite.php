<?php
    include_once 'db.php';
    session_start();
    if(!isset($_SESSION['email'])){
        header("Location:login.php");
    }
    $email = $_SESSION['email'];
    $id = $_GET['sid'];
    $sql = "Delete from favourites where song_id = '$id' and email = '$email'";
    $result = mysqli_query($conn,$sql);
    header("Location:favourite.php");
?>