<?php
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){ 
      header("Location:login.php");
    }

    include 'db.php';
    $id = $_REQUEST['id'];
    $pid = $_REQUEST['pid'];
    $sid = $_REQUEST['sid'];
    $email = $_SESSION['email'];
    $present_query = "Select count(id) as present from songs where song_id = '$sid' and email = '$email'";
    $present_result = mysqli_query($conn,$present_query);
    $present = mysqli_fetch_assoc($present_result);
    if($present['present'] == 0){
      $sql = "insert into songs(id,playlist_no,song_id,email) values('$id','$pid','$sid','$email')";
      $result = mysqli_query($conn,$sql);
        header("Location:add.php?id=$id&pid=$pid");
    }
    header("Location:add.php?id=$id&pid=$pid");

?>