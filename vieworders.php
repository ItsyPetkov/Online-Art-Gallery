<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>View Orders</title>
</head>
<body>
    <div>
        <?php
        /**
         * Created by IntelliJ IDEA.
         * User: Hristo Petkov
         * Date: 10/16/2018
         * Time: 2:01 AM
         */

        $serverName = "devweb2018.cis.strath.ac.uk";
        $userName = "ypb16168";
        $password = "Ja7ohph2sahh";
        $dbname = $userName;
        $conn = new mysqli($serverName, $userName, $password, $dbname);
        if($conn->connect_error){
            die("Fialed to connect to database");
        }

        $sql = "SELECT * FROM  `ypb16168`.`currentOrders`";
        $result = $conn->query($sql);

        echo "<form method='post' action='vieworders.php'><table><tr><th>ID</th><th>Painting Name</th><th>Date of Completion</th><th>Price</th><th>Size</th><th>Username</th><th>Phone</th><th>Email</th><th>Postal Address</th></tr>\n";
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "<tr>\n";
                echo "<td>".$row['id']."</td>\n";
                echo "<td>".$row['name']."</td>\n";
                echo "<td>".$row['dateOfCompletion']."</td>\n";
                echo "<td>".$row['price']."</td>\n";
                echo "<td>".$row['size']."</td>\n";
                echo "<td>".$row['username']."</td>\n";
                echo "<td>".$row['phone']."</td>\n";
                echo "<td>".$row['email']."</td>\n";
                echo "<td>".$row['postal-Address']."</td>\n";
                echo "</tr>\n";
            }
        }

        ?>
    </div>
</body>
</html>
