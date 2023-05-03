<?php
    include_once 'db.php';
    session_start();
    if(!isset($_SESSION['email'])){
        header('Location:login.php');
    }
    $sid = $_GET['sid'];
    $email = $_SESSION['email'];
    $sql = "insert into favourites (song_id,email) values ('$sid','$email')";
    $result = mysqli_query($conn,$sql);
    header('Location:index.php');
?>