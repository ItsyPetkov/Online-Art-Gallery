<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="stylesheet" type="text/css" href="newPass.css"/>
    <title>Reset Password</title>
</head>
<body>
    <div class="welcome">
        <p> Welcome to Cara's Website</p>
    </div>
    <div class="form">
        <div class="header">
            <h1>Reset Password Details</h1>
            <p>To reset your password please fill in the following...</p>
        </div>
        <form method="post" action="newPass.php">
            <div class = "email">
                <input type="text" name="email" placeholder="Enter your email here." value="<?php if(isset($_POST['change'])){echo $_POST['email'];} ?>" required/><br><br>
            </div>
            <div class="password">
                <input type="password" name="password"  placeholder="Enter new password here." value="<?php if(isset($_POST['change'])){echo $_POST['password'];} ?>" required/><br><br>
            </div>
            <div class="button">
                <input type="submit" name="change" value="Change Password"/>
            </div>
        </form>
    </div>
    <div>
        <?php
        /**
         * Created by IntelliJ IDEA.
         * User: Hristo Petkov
         * Date: 10/25/2018
         * Time: 6:03 PM
         */

            if(isset($_POST['change'])){
                $email = $_POST['email'];
                $newpassword = $_POST['password'];

                //Connect to the Database
                $serverName = "devweb2018.cis.strath.ac.uk";
                $userName = "ypb16168";
                $password = "Ja7ohph2sahh";
                $dbname = $userName;
                $conn = new mysqli($serverName, $userName, $password, $dbname);
                if($conn->connect_error){
                    die("Failed to connect to database");
                }

                $sql = "SELECT * FROM `ypb16168`.`users` WHERE `email` = '$email'";
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $result = $conn->query($sql);

                    if(mysqli_num_rows($result) == 1){
                        $encryptedPassword = md5($newpassword);
                        $sql2 = "UPDATE `ypb16168`.`users` SET `password` = '$encryptedPassword' WHERE `email` = '$email'";
                        $result2 = $conn->query($sql2);
                        if($result2){
                            echo "Password reset successful</br>";
                            echo "To go back to the Login page please click <a href='login.php'> here </a>";
                        }else{
                            echo "Password reset failed, please try again!";
                        }
                    }else{
                        echo "Unknown email, please try again.";
                    }
                }else{
                    echo "Invalid email please try again";
                }

            }
        ?>
    </div>
</body>
</html>
