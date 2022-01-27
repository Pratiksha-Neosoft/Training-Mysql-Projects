<?php
include("connection.php");
if(isset($_POST['catid'])){
    $id=$_POST['catid'];
    $sel=mysqli_query($conn,"select * from subcat where cat_id='$id'");
    echo"hii<option>Select Sub Category</option>";
    if(mysqli_num_rows($sel)>0)
    {  
    while($arr=mysqli_fetch_assoc($sel)){
        echo"<option value='$arr[id]'>$arr[name]</option>";
    }
    }

}
if(isset($_POST["subid"])){
    $id=$_POST["subid"];
    $sel=mysqli_query($conn,"select * from product where sub_id='$id'");
    if(mysqli_num_rows($sel)>0){
        while($arr=mysqli_fetch_assoc($sel)){
echo"
<div class='col-lg-4 card'>
    <img class='card-img-top' src='$arr[image]'>
    <div class='card-body'>
        <h3 class='card-title'>$arr[name]</h3>
        
        <p class='card-text'>$arr[price]</p>
    </div>

</div>
";
    }
    }else{
        echo "No record Found";
    }

}

?>