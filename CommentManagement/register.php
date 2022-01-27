<?php
include('conn.php');
error_reporting(0);
$err = null;
if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pass = sha1($_POST['pass']);
    $name = $_POST['name'];
    $age = $_POST['age'];
    $city = $_POST['city'];
    $profile = $_FILES['profile'];
    if (!empty($email) && !empty($username) && !empty($pass) && !empty($name) && !empty($age) && !empty($city) && !empty($profile['tmp_name'])) {
	$fname = $profile['name'];
        $extn = pathinfo($fname, PATHINFO_EXTENSION);
        $nameExt = "attatch-" . rand() . '-' . time() . ".$extn";
        $dest = "upload/$nameExt";
        if (move_uploaded_file($profile['tmp_name'], $dest)) {
            $query = mysqli_query($conn, "INSERT INTO `users` (`email`, `username`, `password`, `name`, `age`, `city`, `profile`) VALUES ('$email', '$username', '$pass', '$name', '$age', '$city', '$dest')");
            if ($query) {
                echo "
                <script>
                    alert('user registered !');
                    window.location.href = 'index.php';
                </script>
                ";
            } else {
                $err = mysqli_error($conn);
            }
        } else {
            $err = "Please select the profile picture !";
        }
    } else {
        $err = "All fields are required. please check all fields !";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Project 1 :: Register</title>
</head>

<body>
    <?php include('nav.php'); ?>
    <div class="container mt-2">
                <?php

                if ($err) {
                    echo "
                        <div class='alert alert-danger'>
                        $err
                        </div>
                        ";
                }
                ?>

    </div>

    <div class="container card my-3 w-50">
                <div class=" bg-white text-center ">
                    <h2 class='card-header'>Register</h2>
                </div>
                <form action="" method="POST" class="mb-3" enctype="multipart/form-data">
                        <div class="form-group p-1">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="" class="form-control">
                        </div>
                        <div class="form-group p-1">
                            <label for="email">Username </label>
                            <input type="text" name="username" value="" class="form-control">
                        </div>
                        <div class="form-group p-1">
                            <label for="pass">Password</label>
                            <input type="password" name="pass" value="" class="form-control">
                        </div>

                        <div class="form-group p-1">
                            <label for="email">Name </label>
                            <input type="text" name="name" value="" class="form-control">
                        </div>
                        <div class="form-group p-1">
                            <label for="number">Age </label>
                            <input type="text" name="age" value="" class="form-control">
                        </div>

                        <div class="form-group p-1">
                            <label for="email">City </label>
                            <input type="text" name="city" value="" class="form-control">
                        </div>
                        <div class="form-group p-1">
                            <label for="">Profile Image</label>
                            <input type="file" name="profile" id="" class="form-control">
                        </div>
                        <div class="form-group p-3">
                            <button class="btn btn-success form-control" name="register">Register</button>
                            <a href="index.php" class="text-primary" style="float: right;text-decoration:none;">Already have account ?</a>
                        </div>
                    </form>
                </div>
    <script src="./js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
</body>

</html>