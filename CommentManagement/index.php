<?php
$err = null;
error_reporting(0);
include('conn.php');
if (isset($_POST['login'])) {
    $username = $_POST['email'];
    $pass = sha1($_POST['pass']);

    if (!empty($username) && !empty($pass)) {
        $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `password`='$pass' AND (`email`='$username' OR `username`='$username') ");
        if (mysqli_num_rows($query) > 0) {
            session_start();
            $res = mysqli_fetch_assoc($query);
            $_SESSION['user'] = $res;
            if ($_POST['rmbr'] == 'on') {
                setcookie("username", $username, time() + 86400);
                setcookie("password", $_POST['pass'], time() + 86400);
            }
            header("Location: dashboard.php");
        } else {
            $err =  "Invalid username or password !";
        }
    } else {
        $err = "Both fields are required";
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

    <title>Login</title>
    <script>
        function checkAuth() {
            
            $res = $('input[name="email"]').val();
            if ($res == "<?php echo $_COOKIE['username']; ?>") {
                $('input[name="pass"]').val("<?php echo $_COOKIE['password']; ?>");

            }
        }
    </script>
</head>

<body>
    <?php include('nav.php'); 
    if ($err) {
        echo "
            <div class='alert alert-danger'>
            $err
            </div>
            ";
    }
    ?>
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-5 card p-0">
                <div class="card-header bg-white  text-center">
                    <h2>Login</h2>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="email">Username or email</label>
                            <input type="text" name="email" value="" class="form-control" onblur="checkAuth()">
                        </div>
                        <div class="form-group">
                            <label for="pass">Password</label>
                            <input type="password" name="pass" value="" class="form-control">
                        </div>
                        <div class="form-group p-1">
                            <input type="checkbox" name="rmbr" class="form-input-check">
                            <label for="">Remember me</label>
                        </div>
                        <div class="form-group p-3">
                            <button class="btn btn-primary form-control" name="login">Login</button>
                            <a href="register.php" class="text-info" style="float: right;text-decoration:none;">New User ?</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>