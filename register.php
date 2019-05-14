<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="stylesheet" type="text/css" href="register.css"/>
    <title>Registration Page</title>
</head>
<body>
    <div class="welcome">
        <p> Welcome to Cara's Website</p>
    </div>
    <div class="form">
        <div class="header">
            <h1>Registration Details</h1>
            <p>In order to create an account, please fill in the following</p>
        </div>
        <form method="post" action="register.php">
            <div class = "email">
                Email: <input type="text" name="email" placeholder="Please enter an email." value="<?php if(isset($_POST['Register'])){echo $_POST['email'];} ?>" required/><br><br>
            </div class = "password">
            <div class = "password">
                Password: <input type="password" name="password" placeholder="Please enter a password" value="<?php if(isset($_POST['Register'])){echo $_POST['password'];} ?>" required/><br><br>
            </div>
            <div class="button">
                <input type="submit" name="Register" value="Register"/>
            </div>
            <p>
                Already registered? <a href="login.php">Login here</a>
            </p>
        </form>
    </div>
    <div>
        <?php
        /**
         * Created by IntelliJ IDEA.
         * User: Hristo Petkov
         * Date: 10/23/2018
         * Time: 6:10 PM
         */

        session_start();

        if(isset($_POST['Register'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $encryptedPassword = md5($password);

            //Connect to the Database
            $serverName = "devweb2018.cis.strath.ac.uk";
            $userName = "ypb16168";
            $password = "Ja7ohph2sahh";
            $dbname = $userName;
            $conn = new mysqli($serverName, $userName, $password, $dbname);
            if($conn->connect_error){
                die("Fialed to connect to database");
            }

            $sql = "SELECT * FROM `ypb16168`.`users` WHERE `email` = '$email'";
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $result = $conn->query($sql);
                if(mysqli_num_rows($result) == 1){
                    echo "User already exists";
                }else{
                    $sql2 = "INSERT INTO `ypb16168`.`users` (`id`,`email`,`password`) VALUES (NULL, '$email', '$encryptedPassword');";
                    $result2 = $conn->query($sql2);
                    $_SESSION['email'] = $email;
                    header("Location: mainPage.php");
                }
            }else{
                echo "Invalid email! Please enter a valid email";
            }
        }
        ?>
    </div>
</body>
</html>
