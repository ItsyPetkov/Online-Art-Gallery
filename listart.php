<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="stylesheet" type="text/css" href="listart.css"/>
    <title>Order Details</title>
</head>
<body>
    <div class="header">
        <h1>Listing of Painting</h1>
        <p>Please select a painting to buy by clicking 'Order' or to view the painting details by clicking 'More'.</p>
        <p>Please click on the buttons below in order to get access to the paintings.</p>
    </div>
    <div>
        <?php
        /**
         * Created by IntelliJ IDEA.
         * User: Hristo Petkov
         * Date: 10/12/2018
         * Time: 1:32 AM
         */

        session_start();

        $serverName = "devweb2018.cis.strath.ac.uk";
        $userName = "ypb16168";
        $password = "Ja7ohph2sahh";
        $dbname = $userName;
        $conn = new mysqli($serverName, $userName, $password, $dbname);
        if($conn->connect_error){
            die("Fialed to connect to database");
        }

        $sql = "SELECT * FROM  `ypb16168`.`paintingDetails`";
        $result = $conn->query($sql);

        $pageResults = 12;
        $rows = $result->num_rows;
        $Pages = $rows/$pageResults;
        $totalPages = ceil($Pages);

        echo "<br>";
        for($page = 1; $page <= $totalPages; $page++){

            echo "<div class='pageButtons'>";
            echo "<form method='get' action='listart.php'>";
            echo "<input type='submit' name='$page' value='$page'>";
            echo "</form>";
            echo "</div>";

            if(isset($_GET[$page])){

                $page1 = ($page*$pageResults)-$pageResults;
                $sql2 = "SELECT * FROM `ypb16168`.`paintingDetails` LIMIT $page1, $pageResults";
                $result2 = $conn->query($sql2);

                echo "<form method='post' action='listart.php?$page=$page'><table><tr><th>Title</th><th>Size</th><th>Price</th></tr>\n";
                while($rowz = $result2->fetch_assoc()){

                    $id = $rowz["id"];
                    $name = $rowz["name"];
                    $date = $rowz["date"];
                    $price = $rowz["price"];
                    $height = $rowz["height"];
                    $width = $rowz["width"];
                    $size = $height." x ".$width."mm";
                    $description = $rowz['text'];
                    $str = str_replace(' ','',$name);

                    echo "<tr>\n";
                    echo "<td>".$rowz["name"]."</td>\n";
                    echo "<td>".$size."</td>\n";
                    echo "<td>".$rowz["price"]."</td>\n";
                    echo "<td><input type='submit' value='More' name='$str'/></td>\n";
                    echo "<td><input type='submit' value='Order' name='$id'/></td>\n";
                    echo "</tr>\n";

                    if(isset($_POST[$id])){

                        $_SESSION['id'] = $id;
                        $_SESSION['name'] = $name;
                        $_SESSION['date'] = $date;
                        $_SESSION['price'] = $price;
                        $_SESSION['size'] = $height." x ".$width."mm";

                        header("Location: order.php");die("should not be here");
                    }
                    if(isset($_POST[$str])){

                        $_SESSION['id'] = $id;
                        $_SESSION['name'] = $name;
                        $_SESSION['date'] = $date;
                        $_SESSION['price'] = $price;
                        $_SESSION['size'] = $height." x ".$width."mm";
                        $_SESSION['height'] = $height;
                        $_SESSION['width'] = $width;
                        $_SESSION['description'] = $description;

                        header("Location: details.php");
                    }
                }
            }
        }

        echo "</table></form>\n";
        $conn->close();
        ?>
    </div>
</body>
</html>




