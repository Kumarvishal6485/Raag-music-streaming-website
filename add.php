<?php  
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){ 
      header("Location:login.php");
    }

    include 'db.php';
    $id = $_REQUEST['id'];
    $pid = $_REQUEST['pid'];
    $sql = "select id , songname from song ";
    $result = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
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
        #homepagebtn{
            position : relative;
            float : left;
            left : 20px;
            top : 10px;
        }
        #tl{
          position: absolute;
          margin-top : 60px;
        }

        #uploadbtn{
          position : relative;
          float : right;
          right : 20px;
          top : 10px;
        }
    </style>
</head>
<body>
<div class="cont">
    <a id="homepagebtn" href="playlists.php" class="btn btn-success">Back </a>
    <a id="uploadbtn" href="upload.php" class="btn btn-primary">Upload </a>
    <table class="table table-dark" id="tl">
  <tr>
    <td>S.no</td>
    <td>Song</td>
    <td>Action</td>
  </tr>
  <?php 
    $i = 0;
    $sno = 0;
    while($data = mysqli_fetch_assoc($result)){
        $i++;
      ?>
      <tr>
        <td><?php echo ++$sno;?></td>
        <td><?php echo $data['songname'];?></td>
        <td><a href="addtoplaylist.php?id=<?php echo $id;?>&pid=<?php echo $pid;?>&sid=<?php echo $data['id'];?>" class="btn btn-success">Add</a></td>
      </tr>
    <?php }
  ?>
  
</table>        
</div>
</body>
</html>