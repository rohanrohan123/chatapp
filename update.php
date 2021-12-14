<?php
session_start();
include('conection.php');
$name=$_SESSION["name"];


$data=stripslashes(file_get_contents("php://input"));
$mydata=json_decode($data,true);
$sql = "UPDATE messages SET active=0 WHERE name='$name'";

        if (mysqli_query($conn, $sql)) {
          //echo "Record updated successfully";
        //   echo '<script type ="text/JavaScript">';  
        // echo 'location.replace("index.php")';  
        // echo '</script>';  
          echo "";

        } else {
          echo "Error updating record: " . mysqli_error($conn);
        }

?>