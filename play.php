<?php  
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
        header("Location:login.php");
    }
    include 'db.php';
    
    $email = $_SESSION['email'];
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $pid = $_GET['pid'];
        $sql = "Select child.music,child.image from songs as parent inner join song as child on parent.song_id = child.id  where parent.id = '$id' and parent.playlist_no = '$pid' and parent.email = '$email'";
    }
    elseif(isset($_GET['sid'])){
        $sid = $_GET['sid'];
        $sql = "Select music , image from song where id = '$sid'";
    }
    $result = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        audio{
            display : block;
            width : 100vw;
        }
        img{
            display : block;
            height : 92vh;
            width : 100vw;
        }
        #nil_playlist {
            color:white;
            transform : translateY(500%);
        }
        .cont{
            width : 100vw;
            height : 100vh;
            background-color: rgba(0, 0, 0, 0.749);
        }
    </style>
</head>
<body>
    <?php 
    if(mysqli_num_rows($result) > 0)
        {
            while($fetch = mysqli_fetch_object($result)) 
            {?>
                <img height="500px" width="500px"src="<?php echo $fetch->image;?>">
                <audio controls="controls" >
                <source src ="<?php echo 'music/'.$fetch->music;?>" type="audio/mp3"></source>
                </audio>
            <?php }
        } 
    else{ ?>
    <div class="cont">
        <center><h1 id="nil_playlist">Nothing to Play</h1></center>
    </div>
    <?php }?>
</body>
</html>