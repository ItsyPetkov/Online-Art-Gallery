<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="stylesheet" type="text/css" href="details.css"/>
    <title>Painting Details</title>
</head>
<body>
    <div class="header">
        <h1>Painting Details</h1>
        <p><b>These are the paintings full details:</b></p>
    </div>
    <div class="print">
        <?php
        /**
         * Created by IntelliJ IDEA.
         * User: Hristo Petkov
         * Date: 10/16/2018
         * Time: 6:20 PM
         */

            session_start();

            //These variables are only used to set up the right dimensions of the picture.
            $height = $_SESSION['height'];
            $width = $_SESSION['width'];

            echo "Painting ID: ".$_SESSION['id']."</br>";
            echo "Painting title: ".$_SESSION['name']."</br>";
            echo "Date of Completion: ".$_SESSION['date']."</br>";
            echo "Painting Price: ".$_SESSION['price']."</br>";
            echo "Painting Dimensions: ".$_SESSION['size']."</br>";
            echo "Painting Description: ".$_SESSION['description']."</br>";
            echo "<img src='pictureDisplay.php' height='$height' width='$width'>";
            echo "</br>";

            if(isset($_POST['back'])){
                header("Location: listart.php");
            }

            if(isset($_POST['order'])){
                header("Location: order.php");
            }
        ?>
    </div>
    <div>
        <form method="post" action="details.php">
            <div class="back"><input type="submit" name="back" value="Back"><br><br></div>
            <div class="order"><input type="submit" name="order" value="Order"></div>
        </form>
    </div>
</body>
</html>
