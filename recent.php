<?php 
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
        header("Location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My playlists</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;200&family=Sono&display=swap"
        rel="stylesheet">
    <style>
        h1 {
            font-family: 'Fira Sans', sans-serif;
            font-family: 'Sono', sans-serif;
            color: whitesmoke;
        }

        #nil_recent {
            width: max-content;
            transform: translateY(300%);
        }

        .cont {
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.749);
        }
    </style>
</head>

<body>
    <div class="cont">

        <center>
            <h1>Recently played</h1>
        </center>
        <table class="table table-dark">
            <tr>
                <th>S.no</th>
                <th>Song</th>
                <th>Action</th>
            </tr>
            <?php 
                include 'db.php';
                //create $email = $_SESSION['email'];
                //this query to be used after applying session 
                //$sql = "Select child.playlist_no , child.song , child.music , child.image from playlist as parent inner join songs as child on parent.id = child.id where email = '$email' order by child.lastplayed desc";
                $email = $_SESSION['email'];
                $sql = "Select  parent.song_id , child.songname , child.music , child.image from songs as parent inner join song as child on parent.song_id = child.id where parent.email = '$email' order by parent.lastplayed desc";
                $result = mysqli_query($conn,$sql);
                $i = 0;
                while($data = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo ++$i;?></td>
                <td><?php echo $data['songname'];?></td>
                <td><a href="play.php?sid=<?php echo $data['song_id'];?>&sname=<?php echo $data['songname'];?>" class="btn btn-success">Play Now</a></td>
            </tr>
            <?php } ?>
        </table>
        <?php 
            if($i == 0){ ?>
        <center>
            <h1 id="nil_recent">No history found</h1>
        </center>
        <?php }?>
    </div>
</body>

</html>