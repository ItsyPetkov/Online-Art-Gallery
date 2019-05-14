<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="stylesheet" type="text/css" href="viewUserOrders.css"/>
    <title>Your Current Orders</title>
</head>
<body>
    <h1>Your Current Orders:</h1>
    <div>
        <?php
        /**
         * Created by IntelliJ IDEA.
         * User: Hristo Petkov
         * Date: 10/25/2018
         * Time: 1:44 AM
         */

            session_start();

            $email = $_SESSION['email'];

            //Connect to Database
            $serverName = "devweb2018.cis.strath.ac.uk";
            $userName = "ypb16168";
            $password = "Ja7ohph2sahh";
            $dbname = $userName;
            $conn = new mysqli($serverName, $userName, $password, $dbname);
            if($conn->connect_error){
                die("Fialed to connect to database");
            }

            $sql = "SELECT * FROM `ypb16168`.`currentOrders` WHERE `email` = '$email'";
            $result = $conn->query($sql);

            echo "<form method='post' action='viewUserOrders.php'><table><tr><th>ID</th><th>Painting Name</th><th>Date of Completion</th><th>Price</th><th>Size</th><th>Status</th></tr>";
            if($result->num_rows > 0){
                $status = "Still Drying...";
                while($row = $result->fetch_assoc()){
                    echo "<tr>\n";
                    echo "<td>".$row['id']."</td>\n";
                    echo "<td>".$row['name']."</td>\n";
                    echo "<td>".$row['dateOfCompletion']."</td>\n";
                    echo "<td>".$row['price']."</td>\n";
                    echo "<td>".$row['size']."</td>\n";
                    echo "<td>".$status."</td>\n";
                    echo "</tr>\n";
                }
            }else{
                die("No matches");
            }

            echo "</table></form>\n";
            $conn->close();

            if(isset($_POST['back'])){
                header("Location: mainPage.php");
            }
        ?>
    </div>
    <div class="backButton">
        <form method="post" action="viewUserOrders.php"><br>
            <input type="submit" name="back" value="Back to Main Page"/>
        </form>
    </div>
</body>
</html>
