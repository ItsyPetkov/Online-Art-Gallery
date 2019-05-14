<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="stylesheet" type="text/css" href="mainPage.css"/>
    <title>User Main Page</title>
</head>
<body>
    <div>
        <?php
        /**
         * Created by IntelliJ IDEA.
         * User: Hristo Petkov
         * Date: 10/24/2018
         * Time: 2:52 AM
         */

        if(isset($_POST['LogOut'])){
            header("Location: login.php");
        }

        if(isset($_POST['listart'])){
            header("Location: listart.php");
        }

        if(isset($_POST['viewOrders'])){
            header("Location: viewUserOrders.php");
        }

        ?>
    </div>
    <div class="content">
        <form method="post" action="mainPage.php">
            <h1>Welcome Customer</h1><br>
            <div class="buttons">
                <p><b>To view all the available pictures for purchase click this button</b></p> <input type="submit" name="listart" value="View Art Collection"/><br><br>
                <p><b>To view your current orders click this button</b></p> <input type="submit" name="viewOrders" value="View your Orders"/><br><br><br>
            </div>
            <div class="submit">
                <input type="submit" name="LogOut" value="Logout"/>
            </div>
        </form>
    </div>
</body>
</html>
