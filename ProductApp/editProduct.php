<?php
include('connection.php');
$id=$_GET['edit'];
$err="";
$sel=mysqli_query($conn,"select * from products where id=$id");
$arr=mysqli_fetch_assoc($sel);
if(isset($_POST['sub'])){
    $name=$_POST['name'];
    $image=$_FILES['image'];
    $price=$_POST['price'];
    $description=$_POST['description'];
    if(empty($name)||empty($image['tmp_name'])||empty($price)){
        $err="Please enter all required(*) fields";
    }else if($price<=0 || $price>=1000000){
        $err="Please enter valid price";
    }else{
       $temp=$image['tmp_name'];
       $fname=$image['name'];
       $arr=["png","jpg","jpge"];
       $ext=pathinfo($fname,PATHINFO_EXTENSION);
       $newfile=$name.rand().".$ext";
       $dest="Images/";
       if(in_array($ext,$arr)){
        if(move_uploaded_file($temp,$dest.$newfile)){
            $que=mysqli_query($conn,"update products set image='$dest$newfile',name='$name',price='$price',description='$description' where id='$id'");
            if($que){
                header("location:index.php");
            }
        }
       }else{
           $err="Only JPG,JPGE and PNG files are allowed!";
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
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <?php
    if($err){
        echo"<div class='alert alert-danger w-50 mx-auto'>$err</div>";
    }
    ?>
    <div class="card m-4 w-50 mx-auto">
    <h2 class="text-center card-header">Edit Product</h2>
    <div class="card-body">
    
    <form method="post" enctype="multipart/form-data">
    Name<span class="text-danger">*</span>:<input type="text" name="name" class="form-control" value="<?=$arr['name']?>"><br>
    Image<span class="text-danger">*</span>:<input type="file" name="image" class="form-control"><br>
    Price<span class="text-danger">*</span>:<input type="number" name="price" class="form-control" value="<?=$arr['price']?>"><br>
    Description<span class="text-danger">*</span>:<textarea name="description" class="form-control" style="resize:none" rows="7"><?=$arr['description']?></textarea><br>
    <input type="submit" name="sub" value="Update" class="form-control btn btn-success">
    </form>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</body>
</html>