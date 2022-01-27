<?php
error_reporting(0);
$err="";
include('connection.php');
if(isset($_POST['sub'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $course=$_POST['course'];
    $msg=$_POST['msg'];
    if(empty($name)||empty($email)||empty($msg)||empty($course)){
        $err="Please enter all required(*) fields";
    }else if(strlen($msg)<=0 || strlen($msg)>=10){
        $err="Message must be contain at least 10 character!";
    }else{
            $ins=mysqli_query($conn,"insert into enquiry(name,email,msg) values('$name','$email','$msg')");
            if($ins){
                header("location:index.php");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquiry</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <?php
    if($err){
        echo"<div class='alert alert-danger w-50 mx-auto'>$err</div>";
    }
    ?>
    <div class="card m-2 w-50 mx-auto">
    <h2 class="text-center card-header">Enquiry Form</h2>
    <div class="card-body">
    
    <form method="post" enctype="multipart/form-data">
    Name<span class="text-danger">*</span>:<input type="text" name="name" class="form-control" value="<?=$name?>"><br>
    Email<span class="text-danger">*</span>:<input type="email" name="email" class="form-control" value="<?=$email?>"><br>
    Course<span class="text-danger">*</span>:<select name="course" class="form-control" value="<?=$course?>">
    <option>Select Course</option>
    <?php
    $sel=mysqli_query($conn,"select * from course");
    while($arr=mysqli_fetch_assoc($sel))
    echo "<option value='$arr[title]'>$arr[title]</option>";
    ?>
    </select><br>
    Message<span class="text-danger">*</span>:<textarea name="msg" class="form-control"><?=$msg?></textarea><br>
    <input type="submit" name="sub" value="SEND" class="form-control w-25 float-right btn btn-info">
    </form>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</body>
</html>