<?php
include("conn.php");
$id=$_SESSION['user']['id'];
$query = mysqli_query($conn, "SELECT * FROM `users` WHERE `id`='$id'");
unset($_SESSION['user']);
$res = mysqli_fetch_assoc($query);
$_SESSION['user'] = $res;
?>
<h2> &nbsp;WELCOME: <small class="text-secondary" style="font-size: 20px;"><?php echo $_SESSION['user']['email']; ?></small></h2>
<div class="container mt-3">
    <div class="card p-0 m-0">
        <div class="card-body m-0">
        <div class="col mt-1">
                <h3>Profile</h3>
                <img src="<?php echo $_SESSION['user']['profile']; ?>" alt="" height="100" width="100">
            </div>
            <div class="col p-0">
                <div class="row">
                    <div class="col-6">Name</div>
                    <div class="col-6 text-secondary"><?php echo $_SESSION['user']['name']; ?></div>


                    <div class="col-6">Email</div>
                    <div class="col-6 text-secondary"><?php echo $_SESSION['user']['email']; ?></div>


                    <div class="col-6">Username</div>
                    <div class="col-6 text-secondary"><?php echo $_SESSION['user']['username']; ?></div>


                    <div class="col-6">Age</div>
                    <div class="col-6 text-secondary"><?php echo $_SESSION['user']['age']; ?></div>

                    <div class="col-6">City</div>
                    <div class="col-6 text-secondary"><?php echo $_SESSION['user']['city']; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>