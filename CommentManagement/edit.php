<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['user'])){
    header("location:index.php");
}
include('conn.php');
$err="";
$id=$_SESSION['user']['id'];
$sel=mysqli_query($conn,"select * from users where id=$id");
$arr=mysqli_fetch_assoc($sel);
if(isset($_POST['sub'])){
    $email=$_POST['email'];
    $uname=$_POST['uname'];
    $name=$_POST['name'];
    $age=$_POST['age'];
    $city=$_POST['city'];
    $profile = $_FILES['profile'];
    if (!empty($email) && !empty($uname) && !empty($name) && !empty($age) && !empty($city) && !empty($profile['tmp_name'])) {
            $fname = $profile['name'];
            $extn = pathinfo($fname, PATHINFO_EXTENSION);
            $nameExt = "attatch-" . rand() . '-' . time() . ".$extn";
            $dest = "upload/$nameExt";
            if (move_uploaded_file($profile['tmp_name'], $dest)) {
                $query=mysqli_query($conn,"update users set email='$email',username='$uname',name='$name',age='$age',city='$city',profile='$dest' where id='$id'");
                if ($query) {
                    header("location:dashboard.php");
                } else {
                    $err ="Something Went Wrong!";
                }
            } else {
                $err = "Please select the profile picture !";
            }
        } else {
            $err = "All fields are required. please check all fields !";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="mx-auto card">
    <h2 class="text-center card-header ">Edit Details</h2>
    <?php

if ($err) {
    echo "
        <div class='alert alert-danger'>
        $err
        </div>
        ";
}
?>
    <form method="post" enctype="multipart/form-data" class="w-50 mx-auto p-2 ">
    Email:<input type="email" name="email" class="form-control" value="<?php echo $arr['email'];?>"><br>
    Username:<input type="text" name="uname" class="form-control" value="<?php echo $arr['username'];?>"><br>
    Name:<input type="text" name="name" class="form-control" value="<?php echo $arr['name'];?>"><br>
    Age:<input type="int" name="age" class="form-control" value="<?php echo $arr['age'];?>"><br>
    City:<input type="text" name="city" class="form-control" value="<?php echo $arr['city'];?>"><br>
    Profile photo:<input type="file" name="profile" class="form-control" value="<?php echo $arr['profile'];?>"><br>
    <input type="submit" name="sub" value="Edit" class="btn btn-success">
    </form>
    </div>
</body>
</html>