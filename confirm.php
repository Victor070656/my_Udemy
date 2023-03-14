<?php
include('./dbConnection.php');
session_start();
if (isset($_GET['vid'])) {
  $vid = $_GET['vid'];
}
if (!isset($_SESSION['stuLogEmail'])) {
  echo "<script> location.href='loginorsignup.php'; </script>";
} else {
  $stuEmail = $_SESSION['stuLogEmail'];
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" type="text/css" href="./css/style.css" />

    <title>Checkout</title>
  </head>

  <body>
    <div class="container mt-5">
      <div class="row">
        <div class="col-sm-6 offset-sm-3 shadow py-4">
          <h3 class="mb-5">Proof of Payment</h3>
          <form method="post" enctype="multipart/form-data">
            <div class="form-group row">
              <label for="proof" class="col-sm-4 col-form-label">File</label>
              <div class="col-sm-8">
                <input type="file" id="proof" name="proof" class="form-control" />
              </div>
            </div>
            <div class="p-3">
              <?php
              $sql1 = "SELECT * FROM bank_tb";
              $results = mysqli_query($conn, $sql1);
              if (mysqli_num_rows($results) > 0) {
                $acct = mysqli_fetch_assoc($results);
              }
              ?>
              <span>
                <b>Account Name: </b><?= $acct['uname']; ?>
              </span> <br />
              <span>
                <b>Account Number: </b><?= $acct['acctnum']; ?>
              </span><br />
              <span>
                <b>Bank Name: </b><?= $acct['bank']; ?>
              </span>
            </div>
            <div class="text-center">
              <input value="Check out" name="imgUp" type="submit" class="btn btn-primary" onclick="">
              <a href="./courses.php" class="btn btn-secondary">Cancel</a>
            </div>
          </form>
          <small class="form-text text-muted">Note: Make Payment into the above account and send the proof for confirmation</small>
        </div>
      </div>
    </div>

    <?php

    if (isset($_POST['imgUp'])) {
      $img = $_FILES['proof']['name'];
      $img_tmp = $_FILES['proof']['tmp_name'];
      $target_dir = "./image/proof/" . $img;

      $upload = "UPDATE courseorder SET proof = '$img' WHERE order_id = '$vid'";
      $usql = mysqli_query($conn, $upload);
      move_uploaded_file($img_tmp, $target_dir);
      if ($usql) {
        echo "<script>alert('Uploaded successfully. The course will be available once payment is confirmed'); location.href='./Student/myCourse.php';</script>";
      }
    }

    ?>

    <!-- Jquery and Boostrap JavaScript -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- Font Awesome JS -->
    <script type="text/javascript" src="js/all.min.js"></script>

    <!-- Custom JavaScript -->
    <script type="text/javascript" src="js/custom.js"></script>

  </body>

  </html>
<?php } ?>