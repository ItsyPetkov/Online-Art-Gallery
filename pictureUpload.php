<!DOCTYPE html>
<html lang="en">
<head>
    <title>File Upload To Database</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<h2>Add pictures to the Database</h2>
<form enctype="multipart/form-data" action="pictureUpload.php" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="99999999" />
    <div>Select an image: <input name="userfile" type="file" required/></div><br>
    <div>Picture name: <input type="text" name="pictureName" value="<?php if(isset($_POST['Submit'])){echo $_POST['pictureName'];} ?>" required/><br><br></div>
    <div>Date of Completion: <input type="date" name="DoC" value="<?php if(isset($_POST['Submit'])){echo $_POST['DoC'];} ?>" required/><br><br></div>
    <div>Dimensions(Height x Width): <input type="text" name="height" value="<?php if(isset($_POST['Submit'])){echo $_POST['height'];} ?>" required/> x <input type="text" name="width" value="<?php if(isset($_POST['Submit'])){echo $_POST['width'];} ?>" required/><br><br></div>
    <div>Price: <input type="text" name="price" value="<?php if(isset($_POST['Submit'])){echo $_POST['price'];} ?>" required/><br><br></div>
    Description:<br>
        <textarea name="description" rows="4" cols="50" placeholder="Enter description here." required/></textarea><br><br></div>
    <div><input type="submit" name="Submit" value="Upload Picture" /></div>
    <div>
        <?php

        function upload(){
            /* Could do with adding more checks that the file is a valid image */

            /*** check if a file was uploaded ***/
            if(is_uploaded_file($_FILES['userfile']['tmp_name']) && getimagesize($_FILES['userfile']['tmp_name']) != false) {
                /***  get the image info. ***/
                $info = getimagesize($_FILES['userfile']['tmp_name']);
                $type = $info['mime'];
                $imgfp = file_get_contents($_FILES['userfile']['tmp_name']);
                $dims = $info[3];
                $name = $_FILES['userfile']['name'];
                $maxsize = 99999999;

                echo "<p>Image of name '$name', type $type, dimensions $dims and size ".$_FILES['userfile']['size']."B uploaded successfully</p>"; //FIXME Debug info

                /***  check the file is less than the maximum file size ***/
                if ($_FILES['userfile']['size'] < $maxsize) {
                    //connect to the database
                    $host = "devweb2018.cis.strath.ac.uk";
                    $user = "ypb16168";
                    $pass = "Ja7ohph2sahh";
                    $conn = new mysqli($host, $user, $pass, $user);//second $user is db name
                    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);//FIXME only show error during debugging

                    $pictureName = $_POST['pictureName'];
                    $doc = $_POST['DoC'];
                    $height = $_POST['height'];
                    $width = $_POST['width'];
                    $price = $_POST['price'];
                    $description = $_POST['description'];
                    //create the sql query and run it

                    if(preg_match("/^([a-zA-Z' ]+)$/", $pictureName)){
                        if($height > 0 && $width > 0){
                            if($price > 0){
                                $stmt = $conn->prepare("INSERT INTO `ypb16168`.`paintingDetails` (`id`,`name`,`date`,`height`,`width`,`price`,`text`,`image`) VALUES (NULL,'$pictureName','$doc','$height','$width','$price','$description',?)");// table has autoincrement id and a single longblob column called image
                            }else{
                                echo "Invalid price, please try again";
                            }
                        }else{
                            echo "Invalid Dimensions, please try again";
                        }
                    }else{
                        echo "Invalid picture name, please try again";
                    }



                    if ( ! $stmt->bind_param('b', $imgfp) )   {die("Failed to bind parameter");}//FIXME only show error during debugging
                    if ( ! $stmt->send_long_data(0, $imgfp) )     {die("Failed to send long data");}//FIXME only show error during debugging
                    if ( ! $stmt->execute() )                              {die("Failed to execute query ".$stmt->error);}//FIXME only show error during debugging

                    printf("%d Row inserted with ID %d.\n", $stmt->affected_rows, $conn->insert_id);
                    $stmt->close();

                }
            }
        }

        if(isset($_POST['Submit'])){
            if(!isset($_FILES['userfile'])) {
                echo '<p>Please select a file</p>';
            } else {
                upload();
                echo '<p>Thank you for submitting</p>';
            }
        }
        ?>
    </div>
</form>
</body>
</html>
