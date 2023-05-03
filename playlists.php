<?php 
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
        header("Location:login.php");
    }
    $email = $_SESSION['email'];
    include 'db.php';
    $sql = "Select * from playlist where email = '$email'";
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
    <a id="homepagebtn" href="index.php" class="btn btn-success">Back </a>
    <form action = "<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
  <div class="form-group">
    <input id="createbtn" type="text" name ="playlist_name" class="form-control" id="exampleInputPassword1" placeholder="Playlist Name">
  </div>
  <button id="createbtnn" type="submit" name="create" class="btn btn-success">Create</button>
</form>
    <center><h1>My playlists</h1></center>
    <table class="table table-dark">
        <tr>
            <th>S.no</th>
            <th>Playlist Name</th>
            <th>Action</th>
        </tr>
        <?php
        $i=0;
        while($fetch = mysqli_fetch_assoc($result))
        { 
            $i++;
        ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $fetch['playlist_name']?></td>
                <td><a href="add.php?id=<?php echo $fetch['id'];?>&pid=<?php echo $fetch['playlist_id'];?>" class="btn btn-primary">Add</a><a href="delete.php?id=<?php echo $fetch['id'];?>" class="btn btn-danger" style="margin-left : 5px;">Remove</a><a href="play.php?id=<?php echo $fetch['id'];?>&pid=<?php echo $fetch['playlist_id'];?>" class="btn btn-success" style="margin-left : 5px;">Play All</a><a href="allsongs.php?id=<?php echo $fetch['id'];?>&pid=<?php echo $fetch['playlist_id'];?>" class="btn btn-success" style="margin-left : 5px;">View songs</a></td>
            </tr>
        <?php } ?>
    </table>
    <?php 
            if($i == 0){ ?>
            <center><h1 id="nil_playlist">No playlist Exists</h1></center>    

    <?php }?>
    </div>
</body>
</html>
<?php 
    if(isset($_POST['create'])){
        $email = $_SESSION['email'];
    $playlist_name = $_POST['playlist_name'];
    $sql = "select count(id) as  result from playlist where email = '$email'";
    $result = mysqli_query($conn,$sql);
    $pid = 0;
    while($fetch = mysqli_fetch_assoc($result)){
        $pid = $fetch['result'];
    }
    $pid++;
    $sql = "insert into playlist(email,playlist_name,playlist_id) values('$email','$playlist_name',$pid)";
    $result = mysqli_query($conn,$sql);
    if($result){
        header("Location:playlists.php");
    }
    }
?>
