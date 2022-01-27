<?php
session_start();
if(!isset($_SESSION['user'])){
    header("location:index.php");
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

    <title>Dashboard</title>
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        .sidebar {
            background-color:#414a4c;
            height: 83vh;
            overflow-y: scroll;
        }

        .sidebar::-webkit-scrollbar {
            display: none;
        }

        .main-content {
            padding: 5px;
            height: 83vh;
            overflow-y: scroll;
        }

        .main-content::-webkit-scrollbar {
            display: none;
        }

        .sidebar-ul>li {
            text-align: center;
            font-weight: bold;
            list-style: none;
            border: none;
            border-bottom: 1px solid #f0f0f0;
            padding: 10px;
        }

        .sidebar-ul>li>a {
            text-decoration: none;
            color: white;
        }

        @media (max-width:768px) {
            .sidebar {
                height: auto;
            }
        }
    </style>
  </head>
  <body>
      <?php include('nav.php'); ?>

      <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 sidebar  p-0 m-0 " style="height:inherit;min-height:440px;" id="navbarSupportedContent">
                <ul class="sidebar-ul p-0 m-0">
                    <li class="nav-item">
                        <a class="nav-link" href="?page=home">All Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=profile">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=changePass">Change Password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=edit">Edit Profile</a>
                    </li>   
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 main-content" style="height: 100%;">
                <?php
                    $id=$_SESSION['user']['id'];
                    if (!empty($_GET['page'])) {
                        switch ($_GET['page']) {
                            case 'profile':
                                include('welcome.php');
                                break;
                            case 'changePass':
                                include('change.php');
                                break;
                            case 'edit':
                                include("edit.php");
                                break;
                            case 'addpost':include("addpost.php");
                            break;
                            default:
                            include('home.php');
                            
                        }
                    } else {
                        include('home.php');
                    }
                    ?>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
    <script src="./js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        $('.alert-danger').fadeOut(3000);
    </script>
    
  </body>
</html>