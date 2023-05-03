<?php 
    session_start();
    include_once 'db.php';
    if(isset($_SESSION['email'])){
        $sql = "select * from song ";
    }
    else{
        $sql = "select * from song limit 8";
    }
    $result = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raag</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <style>
        p{
            display : inline-block;
        }
        .addtofav{
            position : absolute;
            right : 20px;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="left">
            <nav class="leftnav">
                <li class="leftt"><a href="#nav" id="home" onclick="home()">Home</a></li><br><br><br>
                <hr id="hr">
                <li class="leftt"><a id="fav" href="#favv" onclick="favourite()">Favourites</a></li><br><br><br>
                <hr id="hr1">
                <li class="leftt"><a id="play" href="#pla" onclick="playlist()">Playlist</a></li><br><br><br>
                <hr id="hr2">
                <li class="leftt"><a id="rec" href="#recc" onclick="recent()">Recent</a></li><br><br><br>
                <hr id="hr3">
                <li class="leftt"><a id="str" href="#strr" onclick="stream()">Stream</a></li>
            </nav>
        </div>
        <div class="right">
            <header>
                <nav class="navbar" id="nav">
                    <li class="rightt"><input id="search" type="search" placeholder="Search"></li>
                    <?php    
                        if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){?>
                            <li class='rightt'><a href='login.php'>Login</a></li>
                        <li class='rightt'><button class='button' id='signup' value='signup'><a id='sbtn'
                                    href='signup.php' target='_parent'>Signup</a></button></li>    
                        <?php } 
                        if(isset($_SESSION['loggedin'])){ ?>
                            <li class='rightt' style="color:white; text-shadow: white 0.5px 0.5px ;"> <?php echo $_COOKIE['username']; ?></li>
                            <li class='rightt'><a href='logout.php'>Logout</a></li>
                        <?php }
                    ?>
                </nav>
            </header>
            
            <div id="result"></div>
            <div class="favourite_zone">
                <span class="fav" id="favv">Favourites</span>
                <a href="favourite.php" id="favourite_zone" class="more">View All</a>
            </div>
            <div class="favourites" id="favourites">
            <?php
                if(isset($_SESSION['email'])){
                    $email = $_SESSION['email'];
                    $sql = "Select child.artist , child.songname , child.music , child.image , child.id from songs as parent right join song as child on parent.song_id = child.id where parent.email = '$email' limit 8";
                        $data = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($data) > 0 && mysqli_num_rows($data) == 8){
                            while($songs = mysqli_fetch_assoc($data)){
                            ?>
                            <div class="favsongs">
                                <img src="<?php echo $songs['image'];?>" alt="song" width="230px" height="200px"
                                style="border-radius: 20px; margin: 10px 0px 0px 8px; ">
                                <a href='play.php?sid=<?php echo $songs['id']?>' target='_parent'>
                                <img src='play.png' alt='playbutton' height='80px' width='80px'
                                style='border-radius: 100px; position: absolute; right: 20px; bottom: 20%; /*visibility:hidden;*/'>
                                </a>
                                <h4 class='song_name'><?php echo $songs['songname'];?></h4>
                                <span><p class='artist'><?php echo $songs['artist'];?></p></span>
                                <a class="addtofav" href="addtofav.php?sid=<?php echo $songs['id'];?>">❤️</a>
                            </div>
                        <?php
                            }
                        }
                        else{
                            goto elsefavblock;
                        }
                }
                else{
                    elsefavblock:
                    $sql = "select * from song limit 8";
                    $result = mysqli_query($conn,$sql);
                    while($data = mysqli_fetch_assoc($result)){
                        ?>
                        <div class="favsongs">
                            <img src="<?php echo $data['image'];?>" alt="song" width="230px" height="200px"
                            style="border-radius: 20px; margin: 10px 0px 0px 8px; ">
                            <a href='play.php?sid=<?php echo $data['id']?>' target='_parent'>
                            <img src='play.png' alt='playbutton' height='80px' width='80px'
                            style='border-radius: 100px; position: absolute; right: 20px; bottom: 20%; /*visibility:hidden;*/'>
                            </a>
                            <h4 class='song_name'><?php echo $data['songname']?></h4>
                            <span><p class='artist'><?php echo $data['artist'];?></p></span>
                            <a class="addtofav" href="addtofav.php?sid=<?php echo $data['id'];?>">❤️</a>
                            </div>
                    <?php 
                    }
                }
                ?>
            </div>

            
            <div class="playlist_zone" >
                <span class="fav" id="pla">Playlist</span>
                <a href="playlists.php" id="playlist_zone" class="more">My playlists</a>
            </div>
            <div class="playlist" id="playlist">
                <?php
                if(isset($_SESSION['email'])){
                    $email = $_SESSION['email'];
                    $sql = "Select child.artist , child.songname , child.music , child.image , child.id from songs as parent right join song as child on parent.song_id = child.id where parent.email = '$email' limit 8";
                        $data = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($data) > 0 && mysqli_num_rows($data) == 8){
                            while($songs = mysqli_fetch_assoc($data)){
                            ?>
                            <div class="playlistsongs">
                                <img src="<?php echo $songs['image'];?>" alt="song" width="230px" height="200px"
                                style="border-radius: 20px; margin: 10px 0px 0px 8px; ">
                                <a href='play.php?sid=<?php echo $songs['id']?>' target='_parent'>
                                <img src='play.png' alt='playbutton' height='80px' width='80px'
                                style='border-radius: 100px; position: absolute; right: 20px; bottom: 20%; /*visibility:hidden;*/'>
                                </a>
                                <h4 class='song_name'><?php echo $songs['songname']?></h4>
                                <span><p class='artist'><?php echo $songs['artist'];?></p></span>
                                <a class="addtofav" href="addtofav.php?sid=<?php echo $songs['id'];?>">❤️</a>
                            </div>
                        <?php
                            }
                        }
                        else{
                            goto elseplaylistblock;
                        }
                }
                else{
                    elseplaylistblock:
                    $sql = "select * from song limit 8";
                    $result = mysqli_query($conn,$sql);
                    while($data = mysqli_fetch_assoc($result)){
                        ?>
                        <div class="playlistsongs">
                            <img src="<?php echo $data['image'];?>" alt="song" width="230px" height="200px"
                            style="border-radius: 20px; margin: 10px 0px 0px 8px; ">
                            <a href='play.php?sid=<?php echo $data['id']?>' target='_parent'>
                            <img src='play.png' alt='playbutton' height='80px' width='80px'
                            style='border-radius: 100px; position: absolute; right: 20px; bottom: 20%; /*visibility:hidden;*/'>
                            </a>
                            <h4 class='song_name'><?php echo $data['songname']?></h4>
                            <span><p class='artist'><?php echo $data['artist'];?></p></span>
                            <a class="addtofav" href="addtofav.php?sid=<?php echo $data['id'];?>">❤️</a>
                            </div>
                    <?php 
                    }
                }
                ?>
            </div>
            <div class="recent_zone">
                <span class="fav" id="recc">Recently Played</span>
                <a href="recent.php" id="recent_zone" class="more">Recent</a>
            </div>
            <div class="recent" id="recent">
                <?php 
                    if(isset($_SESSION['email'])){
                        $email = $_SESSION['email'];
                        $sql = "Select child.artist , child.songname , child.music , child.image , child.id from songs as parent right join song as child on parent.song_id = child.id where parent.email = '$email' order by lastplayed desc limit 8";
                        $data = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($data) > 0 && mysqli_num_rows($data) == 8){
                            while($songs = mysqli_fetch_assoc($data)){
                            ?>
                            <div class="recentsongs">
                                <img src="<?php echo $songs['image'];?>" alt="song" width="230px" height="200px"
                                style="border-radius: 20px; margin: 10px 0px 0px 8px; ">
                                <a href='play.php?sid=<?php echo $songs['id']?>' target='_parent'>
                                <img src='play.png' alt='playbutton' height='80px' width='80px'
                                style='border-radius: 100px; position: absolute; right: 20px; bottom: 20%; /*visibility:hidden;*/'>
                                </a>
                                <h4 class='song_name'><?php echo $songs['songname']?></h4>
                                <span><p class='artist'><?php echo $songs['artist'];?></p></span>
                                <a class="addtofav" href="addtofav.php?sid=<?php echo $songs['id'];?>">❤️</a>
                            </div>
                        <?php
                            }
                        }
                        else{
                            goto elserecentblock;
                        }
                    }
                    else{
                        elserecentblock:
                            $sql = "select * from song limit 8";
                        $result = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_assoc($result)){
                            ?>
                            <div class="recentsongs">
                                <img src="<?php echo $data['image'];?>" alt="song" width="230px" height="200px"
                                style="border-radius: 20px; margin: 10px 0px 0px 8px; ">
                                <a href='play.php?sid=<?php echo $data['id']?>' target='_parent'>
                                <img src='play.png' alt='playbutton' height='80px' width='80px'
                                style='border-radius: 100px; position: absolute; right: 20px; bottom: 20%; /*visibility:hidden;*/'>
                                </a>
                                <h4 class='song_name'><?php echo $data['songname']?></h4>
                                <span><p class='artist'><?php echo $data['artist'];?></p></span>
                                <a class="addtofav" href="addtofav.php?sid=<?php echo $data['id'];?>">❤️</a>
                                </div>
                        <?php 
                        }
                    }
                ?>
            </div>
            <div class="stream_zone">
                <span class="fav" id="strr">Streaming Now</span>
                <a href="stream.php" id="stream_zone" class="more">More</a>
            </div>
            <div class="stream" id="stream">
                <div class="streaming">
                    <img src="song1.jpg" alt="song" width="230px" height="200px"
                        style="border-radius: 20px; margin: 10px 0px 0px 8px; ">
                    <img src="play.png" alt="playbutton" height="80px" width="80px"
                        style="border-radius: 100px; position: absolute; right: 20px; bottom: 20%; /* visibility: hidden;*/">
                </div>
                <div class="streaming">
                    <img src="song2.jpg" alt="song" width="230px" height="200px"
                        style="border-radius: 20px; margin: 10px 0px 0px 8px; ">
                    <img src="play.png" alt="playbutton" height="80px" width="80px"
                        style="border-radius: 100px; position: absolute; right: 20px; bottom: 20%; /*visibility: hidden;*/">
                </div>
                <div class="streaming">
                    <img src="song3.jpg" alt="song" width="230px" height="200px"
                        style="border-radius: 20px; margin: 10px 0px 0px 8px; ">
                    <img src="play.png" alt="playbutton" height="80px" width="80px"
                        style="border-radius: 100px; position: absolute; right: 20px; bottom: 20%; /*visibility: hidden;*/">
                </div>
                <div class="streaming">
                    <img src="song4.jpg" alt="song" width="230px" height="200px"
                        style="border-radius: 20px; margin: 10px 0px 0px 8px; ">
                    <img src="play.png" alt="playbutton" height="80px" width="80px"
                        style="border-radius: 100px; position: absolute; right: 20px; bottom: 20%; /* visibility: hidden;*/">
                </div>
                <div class="streaming">
                    <img src="song5.jpg" alt="song" width="230px" height="200px"
                        style="border-radius: 20px; margin: 10px 0px 0px 8px; ">
                    <img src="play.png" alt="playbutton" height="80px" width="80px"
                        style="border-radius: 100px; position: absolute; right: 20px; bottom: 20%; /* visibility: hidden;*/">
                </div>
                <div class="streaming">
                    <img src="song6.jpg" alt="song" width="230px" height="200px"
                        style="border-radius: 20px; margin: 10px 0px 0px 8px; ">
                    <img src="play.png" alt="playbutton" height="80px" width="80px"
                        style="border-radius: 100px; position: absolute; right: 20px; bottom: 20%; /* visibility: hidden;*/">
                </div>
                <div class="streaming">
                    <img src="song7.jpg" alt="song" width="230px" height="200px"
                        style="border-radius: 20px; margin: 10px 0px 0px 8px; ">
                    <img src="play.png" alt="playbutton" height="80px" width="80px"
                        style="border-radius: 100px; position: absolute; right: 20px; bottom: 20%; /* visibility: hidden;*/">
                </div>
                <div class="streaming">
                    <img src="song8.jpg" alt="song" width="230px" height="200px"
                        style="border-radius: 20px; margin: 10px 0px 0px 8px; ">
                    <img src="play.png" alt="playbutton" height="80px" width="80px"
                        style="border-radius: 100px; position: absolute; right: 20px; bottom: 20%; /* visibility: hidden;*/">
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="player"> -->
        <!-- hello  -->
    <!-- </div> -->
    
    <script src="index.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#search').keyup(function(){
                var input = $(this).val();
                console.log(input);
                if(input != ""){
                    $.ajax({
                        url : "search.php",
                        method : "POST",
                        data : {input : input},
                        success:function(data){
                            $("#result").html(data);
                        }
                    });
                }
                else{
                    $("#result").css("display","none");
                }
            })
        })
    </script>
</body>
</html>