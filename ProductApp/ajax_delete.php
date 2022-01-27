<?php
include("connection.php");
if(!empty($_POST['id'])){
    $id=$_POST['id'];
    mysqli_query($conn,"delete from products where id=$id");
}
?>