<?php
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <div id="tar">
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            function load(){
            $.ajax('display.php',{
                success:function(data){
                    $("#tar").html(data);
                }
            })
            }
            load();
            $(document).on("click",".delete",function(){
                var id=$(this).data("id");
                $.ajax('ajax_delete.php',{
                    type:"POST",
                    data:{id:id},
                    success:function(data){
                        load();
                    }
                });
            })
        });
    </script>

</body>
</html>