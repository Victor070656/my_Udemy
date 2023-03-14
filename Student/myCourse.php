<?php
if (!isset($_SESSION)) {
  session_start();
}
define('TITLE', 'My Course');
define('PAGE', 'mycourse');
include('./stuInclude/header.php');
include_once('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
  $stuLogEmail = $_SESSION['stuLogEmail'];
} else {
  echo "<script> location.href='../index.php'; </script>";
}


?>

<div class="col-sm-9 mx-auto mt-5 ml-2">
  <div class="row">
    <div class="col-sm-10 mx-auto shadow border rounded py-3">
      <h4 class="text-center font-weight-bolder">My Course</h4>
      <?php
      if (isset($stuLogEmail)) {
        $sql = "SELECT co.order_id, co.amount, co.paid, c.course_id, c.course_name, c.course_duration, c.course_desc, c.course_img, c.course_author, c.course_original_price, c.course_price FROM courseorder AS co JOIN course AS c ON c.course_id = co.course_id WHERE co.stu_email = '$stuLogEmail'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

          while ($row = $result->fetch_assoc()) {

      ?>
            <div class="bg-light mb-3">
              <h5 class="card-header"><?php echo $row['course_name']; ?></h5>
              <div class="row">

                <div class="col-sm-3">
                  <img src="<?php echo $row['course_img']; ?>" class="card-img-top
                mt-4" alt="pic">
                </div>
                <div class="col-sm-6 mb-3">
                  <div class="card-body">
                    <p class="card-title"><?php echo $row['course_desc']; ?></p>
                    <small class="card-text">Duration: <?php echo $row['course_duration']; ?></small><br />
                    <small class="card-text">Instructor: <?php echo $row['course_author']; ?></small><br />
                    <small class="card-text">Order ID: <?php echo $row['order_id']; ?></small><br />
                    <p class="card-text d-inline">Price: <small><del>&#8358 <?php echo $row['course_original_price'] ?> </del></small> <span class="font-weight-bolder ">&#8358 <?php echo $row['course_price'] ?> <span></p>

                    <?php if ($row['paid'] == "yes") { ?>
                      <a href="watchcourse.php?course_id=<?php echo $row['course_id'] ?>" class="btn btn-primary mt-5">Watch Course</a>
                    <?php } else { ?>
                      <a href="../confirm.php?vid=<?= $row['order_id']; ?>" class="btn btn-primary mt-5">Confirm Payment</a>
                    <?php } ?>
                  </div>
                </div>

              </div>

            </div>
      <?php
          }
        }
      }

      ?>
      <hr />
    </div>
  </div>
</div>

</div> <!-- Close Row Div from header file -->
<?php
include('./stuInclude/footer.php');
?>