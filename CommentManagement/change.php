<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['user'])){
    header("location:index.php");
}
$err = "";
include('conn.php');
if (isset($_POST['change'])) {
  $old = sha1($_POST['old']);
  $new = sha1($_POST['new']);
  $conf_new = sha1($_POST['conf_new']);
  if (!empty($old) && !empty($new) && !empty($conf_new)) {
    if ($new == $conf_new) {
      if ($old == $_SESSION['user']['password']) {
        $id= $_SESSION['user']['id'];
        $query = mysqli_query($conn,"UPDATE `users` SET `password`='$new' WHERE `id`=$id");
        if($query)
        {
          $_SESSION['user']['password']=$new;
          echo "
            <script>window.alert('changed password');window.location.href='dashboard.php';</script>
          ";
        }else{
          $err= "Unable to change  the password please try again !";
        }
      } else {
        $err = "Old password does not match. Please enter correcet password !";
      }
    } else {
      $err = "New password and confirm password does not same !";
    }
  } else {
    $err = "Please fill all fields !";
  }
}

?>

<div class="container">
  <div class="row bg-light">
    <h2>Change password</h2>
  </div>
</div>
<?php

if ($err) {
  echo "
    <div class='alert alert-danger'>
    $err
    </div>
    ";
}
?>

<div class="container mt-5">
        <form action="" method="POST" style="width: 300px;">
          <div class="form-group p-1">
            <label for="">Old Password</label>
            <input type="password" name="old" id="" class="form-control">
          </div>
          <div class="form-group p-1">
            <label for="">New Password</label>
            <input type="password" name="new" id="" class="form-control">
          </div>
          <div class="form-group p-1">
            <label for="">Confirm New Password</label>
            <input type="password" name="conf_new" id="" class="form-control">
          </div>
          <div class="form-group p-3">
            <button class="btn btn-success form-control w-50" name="change">Change</button>
          </div>
        </form>
</div>
