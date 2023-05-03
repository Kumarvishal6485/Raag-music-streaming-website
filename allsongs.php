<?php 
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
        header("Location:login.php");
    }
    include_once 'db.php';
    $id = $_REQUEST['id'];
    $pid = $_REQUEST['pid'];
    $email = $_SESSION['email'];
    $sql = "Select parent.song_id , child.songname from songs as parent inner join song as child on parent.song_id = child.id where parent.email = '$email' and parent.playlist_no = '$pid' and parent.id = '$id'";
    $result = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My playlists</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;200&family=Sono&display=swap" rel="stylesheet">
    <style>
        h1{
            font-family: 'Fira Sans', sans-serif;
            font-family: 'Sono', sans-serif;
            color : whitesmoke;
            display:inline-block;
            width : max-content;
        }
        #nil_playlist {
            transform : translateY(300%);
        }
        .cont{
            width : 100vw;
            height : 100vh;
            background-color: rgba(0, 0, 0, 0.749);
        }
        #createbtn{
            position : absolute;
            float : right;
            right : 20px;
            top : 10px;
            width:250px;
            margin-right : 80px;
        }
        
        #createbtnn{
            position : absolute;
            float : right;
            right : 20px;
            top : 10px;
        }
        #homepagebtn{
            position : absolute;
            float : left;
            left : 20px;
            top : 10px;
        }
    </style>
</head>
<body>
    <div class="cont">
    <a id="homepagebtn" href="playlists.php" class="btn btn-success">Back </a>
    <center><h1>My playlist</h1></center>
    <table class="table table-dark">
        <tr>
            <th>S.no</th>
            <th>Song</th>
            <th>Action</th>
        </tr>
        <?php
        $i=0;
        if($result){
            if(mysqli_num_rows($result) > 0){
                while($fetch = mysqli_fetch_assoc($result))
                { 
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $fetch['songname'];?></td>
                        <td><a href="remove.php?id=<?php echo $id;?>&pid=<?php echo $pid;
                        ?>&sid=<?php echo $fetch['song_id'];?>" class="btn btn-danger">Remove</a></td>
                    </tr>
                <?php } 
                }
                ?>
            </table>
            <?php 
                    if($i == 0){ ?>
                    <center><h1 id="nil_playlist">No Song Exists</h1></center>    
            <?php }
        }?>
    </div>
</body>
</html>