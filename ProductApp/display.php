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
<h2 class="text-white text-center p-2 bg-secondary">All Products</h2>
<div class="container">
<a href="addProduct.php" class="btn btn-primary float-right m-4">Add Product</a>
<table class="table table-bordered table-hover">
        <tr>
            <th>Sr.no.</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <?php
        include('connection.php');
        $sel=mysqli_query($conn,"select * from products");
        if(mysqli_num_rows($sel)>0){
            $sn=1;
            while($arr=mysqli_fetch_assoc($sel)){
        ?>
        <tr id="tar">
            <td><?php echo $sn;?></td>
            <td><?php echo $arr['name'];?></td>
            <td><img src="<?php echo $arr['image'];?>" width="60" height="60"></td>
            <td><?php echo " Rs.".$arr['price'];?></td>
            <td><?php echo $arr['description'];?></td>

            <td><a href="editProduct.php?edit=<?php echo $arr['id'];?>" class="btn btn-info">Edit</a>
                <a href="Javascript:void(0);" data-id="<?php echo $arr['id'];?>" class="delete btn btn-danger">Delete</a></td>
        </tr>
        <?php
            $sn++;
            }
        }else{
        ?>
        <tr>
            <td colspan="8" align="center">No record found</td>
        </tr>
        <?php }?>

    </table>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>