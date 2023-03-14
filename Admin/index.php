<?php
include('../dbConnection.php');
if (!isset($_SESSION)) {
  session_start();
}
// setting header type to json, We'll be outputting a Json data


// Admin Login Verification
if ($_POST) {
  if (!isset($_SESSION['is_admin_login'])) {

    $adminLogEmail = $_POST['adminLogEmail'];
    $adminLogPass = $_POST['adminLogPass'];
    $sql = "SELECT admin_email, admin_pass FROM admin WHERE admin_email='" . $adminLogEmail . "' AND admin_pass='" . $adminLogPass . "'";
    $result = $conn->query($sql);
    $row = $result->num_rows;

    if ($row === 1) {
      $_SESSION['is_admin_login'] = true;
      $_SESSION['adminLogEmail'] = $adminLogEmail;
      echo "<script>location.href='adminDashboard.php';</script>";
    } else if ($row === 0) {
    }
  }
}
?>
<?php include("../mainInclude/header.php") ?>
<form action="" method="post">
  <input class="form-control" type="text" name="adminLogEmail">
  <input class="form-control" type="password" name="adminLogPass">
  <input type="submit" value="Login">
</form>
</body>

</html>