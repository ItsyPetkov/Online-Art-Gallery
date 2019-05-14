<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hristo Petkov
 * Date: 10/23/2018
 * Time: 1:38 AM
 */

    session_start();

    $id = $_SESSION['id'];


    //connect to the database
    $host = "devweb2018.cis.strath.ac.uk";
    $user = "ypb16168";
    $pass = "Ja7ohph2sahh";
    $conn = new mysqli($host, $user, $pass, $user);//second $user is db name
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);//FIXME only show error during debugging

    /*** The sql statement ***/
    $sql = "SELECT image FROM `ypb16168`.`paintingDetails` WHERE id = $id";
    $result = $conn->query($sql);
    if (!$result){
        die("Query failed ".$conn->error); //FIXME remove once working.
    }

    /*** Process results - we can only have 0 or 1 result from the select **/
    $row = $result->fetch_assoc();
    if ($row){
        $data = $row["image"];
        //output MIME-TYPE header - must have no outputs before this
        header("Content-type: image/jpeg");
        // output the image
        echo $data;
    } else {
        die("Select failed - no matching rows");//FIXME only show error during debugging
    }

    //Disconnect
    $conn->close();
?>