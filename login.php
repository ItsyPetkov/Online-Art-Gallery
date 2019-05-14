<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="stylesheet" type="text/css" href="login.css"/>
    <title>Log in Authentication Page</title>
</head>
<body>
    <div class="welcome">
        <p> Welcome to Cara's Website</p>
    </div>
    <div class="form">
        <div class="header">
            <h1>Login Details</h1>
            <p>In order to login to your account, please fill in the following</p>
        </div>

        <form method="post" action="login.php">
            <div class = "email">
                Email: <input type="text" name="email" placeholder="Please enter an email." value="<?php if(isset($_POST['LogIn'])){echo $_POST['email'];} ?>" required/><br><br>
            </div>
            <div class = "password">
                Password: <input type="password" name="password" placeholder="Please enter a password" value="<?php if(isset($_POST['LogIn'])){echo $_POST['password'];} ?>" required/><br><br>
            </div>
            <div class = "button">
                <input type="submit" name="LogIn" value="LogIn"/>
            </div>
            <p>
                Don't have an account? <a href="register.php">Register Now</a>
            </p>
            <p>
                Forgotten Password? <a href="newPass.php">Reset Password</a>
            </p>
            <div>
                <?php
                /**
                 * Created by IntelliJ IDEA.
                 * User: Hristo Petkov
                 * Date: 10/23/2018
                 * Time: 6:10 PM
                 */

                session_start();

                if(isset($_POST['LogIn'])){

                    //Connect to the Database
                    $serverName = "devweb2018.cis.strath.ac.uk";
                    $userName = "ypb16168";
                    $password = "Ja7ohph2sahh";
                    $dbname = $userName;
                    $conn = new mysqli($serverName, $userName, $password, $dbname);
                    if($conn->connect_error){
                        die("Fialed to connect to database");
                    }

                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $encryptedPassword = md5($password);

                    $sql = "SELECT * FROM `ypb16168`.`users` WHERE `email` = '$email' AND `password` = '$encryptedPassword'";
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $result = $conn->query($sql);

                        if(mysqli_num_rows($result) == 1){
                            $_SESSION['email'] = $email;
                            header("Location: mainPage.php");
                        }else{
                            echo "Wrong email or password.";
                        }
                    }else{
                        echo "Invalid email! Please enter a valid email";
                    }
                }
                ?>
            </div>
        </form>
    </div>
</body>
</html>
