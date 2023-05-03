<?php 
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
        header("Location:login.php");
    }
    $email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favourites</title>
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
            <center><h1 id="nil_playlist">Sorry! <br> This feature is not available at present</h1></center>    

    </div>
</body>
</html>
