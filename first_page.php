<?php
session_start();




include('./conection.php');
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

<body>




  <div class="container">
    <div class="row mt-5">
      <div class="col-sm-3">

      </div>
      <div class="col-sm-6">
        <form action="" method="post">
          <label for="staticEmail" class="col-form-label">Enter Your Full Name</label>

          <input class="form-control" type="text" placeholder="Enter Your Full Name..." aria-label="default input example" name="name">
          <input type="submit" value="Save" name="submit" class="btn btn-success mt-2 text-end">
          <!-- <button type="button" class="btn btn-success">Success</button> -->




        </form>




      </div>

    </div>
  </div>













  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

  <?php

  if (isset($_REQUEST['submit'])) {
    $name = $_POST['name'];
    if (empty($name)) {
      echo '<script type ="text/JavaScript">';
      echo 'alert("Please fill the textbox !!!!")';
      echo '</script>';
    } else {


      $sql2 = "SELECT name FROM messages WHERE name='$name'";
      $result = $conn->query($sql2);
      if ($result->num_rows > 0) {
        $_SESSION["name"] = $name;
        $sql = "UPDATE messages SET active=1 WHERE name='$name'";

        if (mysqli_query($conn, $sql)) {
          //echo "Record updated successfully";
          echo '<script type ="text/JavaScript">';
          echo 'location.replace("index.php")';
          echo '</script>';
        } else {
          echo "Error updating record: " . mysqli_error($conn);
        }
      } else {
        echo '<script type ="text/JavaScript">';
        echo 'alert("Name is Not match in database, Please Enter  correct name.")';
        echo '</script>';
      }



      // echo $name;
    }
  }




  ?>



</body>

</html>