<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>
</head>
<body>
    <div class="text-center">
        <a href="?page=addpost" class="btn btn-success btn-lg">ADD POST</a><hr width="80%" class="mx-auto">
    </div>
    <div class="row ">
        <?php 
        include("conn.php");
        $sel=mysqli_query($conn,"select * from posts order by created_at desc");
        if(mysqli_num_rows($sel)>0){
            while($arr=mysqli_fetch_assoc($sel)){
                echo"<div class='col-lg-4  my-2'>
                <div class='card'>
                <div class='card-header'>$arr[username]</div>
                <div class='card-body'>
                <h5 class='card-title'>$arr[title]</h5>
                <img src='$arr[post]' class='card-img' height=250 >
                <p class='card-text'>
                $arr[description]
                </p>
                <a href='comment.php?cmt=$arr[id]'>see all comments...</a>
                </div>
                </div>
                </div>";
            }
        }
        ?>        
    </div>
</body>
</html>