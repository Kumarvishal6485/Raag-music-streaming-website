<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;200&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .container {
            background-image: url(background.avif);
            background-size: contain;
            height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .signupbox {

            background-color: white;
            display: flex;
            flex-direction: column;
            height: 430px;
            width: 350px;
            border-radius: 20px;
        }

        .top {
            margin-top: 20px;
            margin-bottom: 8px;
            text-align: center;
            font-family: 'Fira Sans', sans-serif;
            border-bottom: 2px solid grey;
            height: 76px;

        }

        input[type="email"],
        input[type="password"] {
            font-family: 'Fira Sans', sans-serif;
            width: 95%;
            height: 40px;
            border: none;
            outline: none;
            border-bottom: 2px solid silver;
            color: black;
            font-size: 15px;
            letter-spacing: 2px;
            font-weight: bold;
            
        }

        input {
            margin: 8px 8px 8px 8px;

        }

        input[type="submit"] {
            cursor : pointer;
            width: 95%;
            height: 40px;
            color: white;
            border: none;
            outline: none;
            background-color: rgba(55, 55, 244, 0.651);
            border-radius: 12px;
            font-size: 15px;
        }

        span {
            margin-left: 10px;

        }

        h1 {
            font-size: 50px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="signupbox">
            <div class="top">
                <h1>Signup</h1>
            </div>
            <div class="inputbox">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                    <input type="email" placeholder="Email" name="email" id ="email"required>
                    <input type="password" placeholder="Password" maxlength="12" id="pass"name="password" required>
                    <input type="password" placeholder="Confirm Password" maxlength="12" name="cpassword" required>
                    <input type="submit" value="Signup" name="submit">
                </form>
                <br>
                <span>Already a Member ? </span> <a href="login.php">Login</a>
            </div>
        </div>
    </div>
</body>

</html>
<?php 
    include 'db.php';
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = sha1($_POST['password'],true);
        $cpassword = sha1($_POST['cpassword'],true);
        if($password == $cpassword ){
            $sql = "Select count(email) as previous from signup where email = '$email'";
            $user_exist = mysqli_query($conn,$sql);
            while($data = mysqli_fetch_assoc($user_exist)){
                if($data['previous'] == 0){
                    $sql = "insert into signup(email,password)values('$email','$password')";
                    $result = mysqli_query($conn,$sql);
                    if($result):
                        session_start();
                        $username = substr($email,0,strrpos($email,'@'));
                        setcookie('username',$username,time()+3600 * 24,'/');
                        $_SESSION['email'] = $email;
                        $_SESSION['loggedin'] = 'yes';
                        header("Location:index.php");
                    endif;
                }
                else{
                    header("Location:login.php");       
                }
            }
        }
    }
?>