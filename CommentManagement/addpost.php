<?php
error_reporting(0);
if(isset($_POST['submit'])){
    include("conn.php");
    $err="";
    $success="";
    $file=$_FILES['newpost'];
    $fn=$file['name'];
    $title=$_POST['title'];
    $describe=$_POST['describe'];
    $temp=$file['tmp_name'];
    $exts=['png','jpg','jpeg'];
    if(!empty($title)){
    if($temp){
        $path=pathinfo($fn,PATHINFO_EXTENSION);
        if(in_array($path,$exts)){
        $new=$_SESSION['user']['username'].rand().".$path";
        $dest="upload/$new";
        if(move_uploaded_file($temp,$dest)){
            $user=$_SESSION['user']['username'];
            $query=mysqli_query($conn,"insert into posts(username,title,description,post) values('$user','$title','$describe','$dest')");
            if($query)
            $success="New post added!!";
            else
            $err="Something went wrong!!";
        }
        }else{
            $err="Only PNG,JPEG and JPG files are allowed! ";
        }
    }else{
        $err="Please select image to post";
    }
    }else{
        $err="Please enter title";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add post</title>
</head>
<body>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <?php
            if(!empty($err)){
                echo "<div class='alert alert-danger'>$err</div>";
            }else if(!empty($success)){
                echo "<div class='alert alert-success'>$success</div>";
            }
            ?>
            <div class="card">
            <h2 class="card-header">ADD NEW POST</h2>
            <form method="POST" enctype="multipart/form-data" class="card-body">
                <div class="form-group">
                    <label>Title:</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label>Description:</label>
                    <textarea name="describe" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Select Post:</label>
                    <input type="file" class="form-control" name="newpost">
                </div>
                <input type="submit" name="submit" class="btn btn-primary m-3">
            </form>
            </div>
        </div>
    </div>
</body>
</html>