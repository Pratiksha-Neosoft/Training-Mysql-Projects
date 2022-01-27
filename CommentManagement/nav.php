<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">COMMENT MANAGEMENT</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php if(isset($_SESSION['user'])){
            echo"
        <div class='float-right'>
        <a href='dashboard.php?page=changePass' class='btn btn-secondary' style='margin-left: 5px;'>Change Password</a>
            <a href='logout.php' class='btn btn-danger' style='margin-left: 5px;'>Logout</a>
        </div>";
        }?>
    </div>
</nav>

