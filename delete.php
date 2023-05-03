<?php 
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
        header("Location:login.php");
    }
    include_once 'db.php';
    $id = $_GET['id'];
    $sql = "Delete from playlist where id = '$id'";
    $result = mysqli_query($conn,$sql);
    if($result){
        header("Location:playlists.php");
    }
?>