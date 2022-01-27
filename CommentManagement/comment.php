<?php
include "conn.php";
echo "<a href='dashboard.php'><button class='btn btn-primary m-2'>BACK</button></a>";
$id=$_GET['cmt'];
$sel=mysqli_query($conn,"select * from posts where id='$id'");
$src=mysqli_fetch_assoc($sel);
echo "<h3 class='text-center'>$src[title]</h3><img src='$src[post]' class='rounded mx-auto mt-2 d-block' width=300 height=280><p class='text-center'>$src[description]</p>";
if(isset($_POST['submit'])){
session_start();
$name=$_SESSION['user']['username'];
$com=$_POST['com'];
if(!empty($com)){
$sel=mysqli_query($conn,"insert into allcomments(username,comment,post_id) values('$name','$com','$id')");
}else echo"<div class='container alert alert-danger'>Please enter your comment.</div>";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>comments</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <form method="post" class="mt-3">
            <div class="form-group">
                <input type="text" class="form-control" name="com" placeholder="add your comment...">
            </div>
            <button name="submit" class="btn btn-success w-100">Comment</button>
        </form>
    </div>
    <br>
</body>
</html>
<?php
if(isset($_GET['cmt'])){
$id=$_GET['cmt'];
$sel=mysqli_query($conn,"select * from allcomments where post_id='$id' order by created_at desc");
if(mysqli_num_rows($sel)>0){
    while($arr=mysqli_fetch_assoc($sel)){
?>
<div class='container'>
    <div class="p-2 bg-light"><h5> <?=$arr['username']?><span style="font-size:14px;" class="float-right"><?=$arr['created_at']?></span></div>
    <p class="p-2"><?=$arr['comment']?></p>
    
   
</div>
<?php
    }
}
else echo"<div class='container alert alert-danger'>No comment found!</div>";
}
?>
