<?php
include('./dbConnection.php');
session_start();
if (!isset($_SESSION['stuLogEmail'])) {
  echo "<script> location.href='loginorsignup.php'; </script>";
} else {
  $dates = date('d-m-y h:i:s');
  if (isset($_POST['ORDER_ID']) && isset($_POST['TXN_AMOUNT'])) {
    $order_id = $_POST['ORDER_ID'];
    $stu_email = $_SESSION['stuLogEmail'];
    $course_id = $_SESSION['course_id'];
    $status = "Success";
    $respmsg = "Done";
    $amount = $_POST['TXN_AMOUNT'];
    $date = $dates;
    $sql = "INSERT INTO courseorder(order_id, stu_email, course_id, status, respmsg, amount, paid, order_date) VALUES ('$order_id', '$stu_email', '$course_id', '$status', '$respmsg', '$amount', 'no', '$date')";
    if ($conn->query($sql) == TRUE) {
      $sql1 = "SELECT * FROM courseorder";
      $results = mysqli_query($conn, $sql1);
      if (mysqli_num_rows($results) > 0) {
        $check = mysqli_fetch_assoc($results);
        if ($check['amount'] == 0) {
          $free = "UPDATE courseorder SET paid = 'yes'";
          $freeSql = mysqli_query($conn, $free);
        }
      }
      echo "Redirecting to My Profile....";
      echo "<script> setTimeout(() => {
     window.location.href = './Student/myCourse.php';
   }, 1500); </script>";
    };
  } else {
    echo "<b>Transaction status is failure</b>" . "<br/>";
  }
}
