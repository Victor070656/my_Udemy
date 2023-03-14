<?php
include('../dbConnection.php');
session_start();
if (isset($_GET['orderid'])) {
  $orderid = $_GET['orderid'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

  <!-- Font Awesome CSS -->
  <link rel="stylesheet" type="text/css" href="../css/all.min.css">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

  <!-- Custom Style CSS -->
  <link rel="stylesheet" type="text/css" href="../css/style.css" />

  <title>Checkout</title>
</head>

<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-sm-6 offset-sm-3 shadow py-4">
        <h3 class="mb-5">Payment Status</h3>
        <form method="post" enctype="multipart/form-data">
          <?php
          $select = "SELECT * FROM courseorder WHERE order_id = '$orderid'";
          $results = mysqli_query($conn, $select);
          if (mysqli_num_rows($results) > 0) {
            $pay = mysqli_fetch_assoc($results);
          }
          ?>
          <div class="form-group">
            <input class="form-control" type="text" value="<?= $pay['paid']; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="my-select">Status</label>
            <select id="my-select" class="form-control" name="status">
              <option>yes</option>
              <option>no</option>
            </select>
          </div>


          <div class="text-center">
            <input value="Check out" name="stat" type="submit" class="btn btn-primary" onclick="">
            <a href="./courses.php" class="btn btn-secondary">Cancel</a>
          </div>
        </form>

      </div>
    </div>
  </div>

  <?php

  if (isset($_POST['stat'])) {
    $status = $_POST['status'];

    $upload = "UPDATE courseorder SET paid = '$status' WHERE order_id = '$orderid'";
    $usql = mysqli_query($conn, $upload);
    if ($usql) {
      echo "<script>alert('Updated successfully!'); location.href='./sellReport.php';</script>";
    }
  }

  ?>

  <!-- Jquery and Boostrap JavaScript -->
  <script type="text/javascript" src="../js/jquery.min.js"></script>
  <script type="text/javascript" src="../js/popper.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>

  <!-- Font Awesome JS -->
  <script type="text/javascript" src="../js/all.min.js"></script>

  <!-- Custom JavaScript -->
  <script type="text/javascript" src="../js/custom.js"></script>

</body>

</html>