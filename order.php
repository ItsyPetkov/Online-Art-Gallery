<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="stylesheet" type="text/css" href="order.css"/>
    <title>Order Details</title>
</head>
<body>
    <div>
        <?php
        /**
         * Created by IntelliJ IDEA.
         * User: Hristo Petkov
         * Date: 10/13/2018
         * Time: 1:34 AM
         */

          session_start();

          echo "<h1>Order Details:</h1>";
          echo "Painting ID: ".$_SESSION['id'];
          echo "<br>";
          echo "Painting Name: ".$_SESSION['name'];

          $serverName = "devweb2018.cis.strath.ac.uk";
          $userName = "ypb16168";
          $password = "Ja7ohph2sahh";
          $dbname = $userName;
          $conn = new mysqli($serverName, $userName, $password, $dbname);
          if($conn->connect_error){
              die("Failed to connect to database");
          }

          $name = $_SESSION['name'];
          $date = $_SESSION['date'];
          $price = $_SESSION['price'];
          $size = $_SESSION['size'];
          $username = $_POST['username'];
          $phone = $_POST['phone'];
          $email = $_POST['email'];
          $PA = $_POST['PA'];


          $sql = "INSERT INTO `ypb16168`.`currentOrders` (`id`, `name`, `dateOfCompletion`, `price`, `size`, `username`, `phone`, `email`, `postal-Address`) VALUES ( NULL, '$name', '$date', '$price', '$size', '$username', '$phone', '$email', '$PA');";

          if(isset($_POST['Submit'])){
              if(preg_match("/^([a-zA-Z' ]+)$/", $username)){
                    if(filter_var($phone, FILTER_SANITIZE_NUMBER_INT)){
                        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                            $result = $conn->query($sql);
                        }else{
                            echo "Invalid Email, please try again";
                        }
                    }
                    else{
                        echo "Invalid phone number, please try again";
                    }
              }else{
                  echo "Invalid name, please try again.";
              }

          }
        ?>
    </div>
    <form method="post" action="order.php">
        <br>
        <b>Before you complete your order please fill in the following...</b><br><br>
        Name: <input type="text" name="username" value="<?php if(isset($_POST['Submit'])){echo $_POST['username'];} ?>" required/><br><br>
        Phone-number: <input type="text" name="phone" value="<?php if(isset($_POST['Submit'])){echo $_POST['phone'];} ?>" required/><br><br>
        Email: <input type="text" name="email" value="<?php if(isset($_POST['Submit'])){echo $_POST['email'];} ?>" required/><br><br>
        Postal-Address: <input type="text" name="PA" value="<?php if(isset($_POST['Submit'])){echo $_POST['PA'];} ?>" required/><br><br>
        <input type="submit" name="Submit" value="Complete Order">
    </form>
</body>
</html>
<?php

    if(isset($_POST['Submit'])){
        echo "Order completed successfully";
    }
?>
