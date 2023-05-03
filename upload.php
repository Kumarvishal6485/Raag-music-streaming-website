<?php 
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
        header("Location:login.php");
    }
    include_once 'db.php';
    if(isset($_POST['submit'])){
        $song = $_POST['song'];
        $musicname = $_FILES['music']['name'];
        $musiclocation = $_FILES['music']['tmp_name'];
        $imagename = $_FILES['image']['name'];
        $imagelocation = $_FILES['image']['tmp_name'];
        move_uploaded_file($musiclocation,'music/'.$musicname);
        move_uploaded_file($imagelocation,'images/'.$imagename);
        $sql = "insert into song(songname,music,image)values('$song','$musicname','$imagename')";
        $result = mysqli_query($conn,$sql);
        if($result){
            header("Location:index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<body>
<form action = "upload.php" method="POST" enctype="multipart/form-data">    
  <div class="form-group">
  <div class="form-group">
    <label for="exampleInputPassword1">Song Name</label>
    <input type="text" name ="song" class="form-control" id="exampleInputPassword1" placeholder="Song Name">
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">Music</label>
    <input type="file" name ="music" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Image</label>
    <input type="file" name ="image" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>