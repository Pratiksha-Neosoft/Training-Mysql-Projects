<?php
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container p-3">
    <div>
        <select id="cat" class="form-control">
            <option>Select Category</option>
            <?php
                $sel=mysqli_query($conn,"select * from category");
                while($arr=mysqli_fetch_assoc($sel)){  
            ?>
            <option value="<?=$arr['id']?>"><?=$arr['name']?></option>
            <?Php  }?>
        </select>
    </div><br>
    <div>
        <select id="subcat" class="form-control">
            <option>Select Sub Category</option>
        </select>
    </div>
    <div class="row p-2" id="product">

    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $(document).on("change","#cat",function(){
            catId=$(this).val();
            if(catId){
                $.ajax('ajax.php',{
                    type:"post",
                    data:{catid:catId},
                    success:function(data){
                        $("#subcat").html(data); 
                    }
                })
            }
        })
        $(document).on("change","#subcat",function(){
            subId=$(this).val();
            if(subId){
                $.ajax('ajax.php',{
                    type:"post",
                    data:{subid:subId},
                    success:function(data){
                        $("#product").html(data);
                    }

                })
            }

        })
    })
</script>
</body>
</html>