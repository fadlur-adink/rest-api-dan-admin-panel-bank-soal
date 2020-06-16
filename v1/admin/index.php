<?php
session_start();
if (!isset($_SESSION['username']) ) {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
	<meta charset="UTF-8">
    <title>Admin Panel</title>
    
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-primary text-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">Admin Panel </div>
            <div class="list-group list-group-flush">
                <a href="index.php?page=dashboard" class="list-group-item list-group-item-action bg-primary text-light">Dashboard</a>
                <a href="index.php?page=soal" class="list-group-item list-group-item-action bg-primary text-light">Soal</a>
                <a href="index.php?page=siswa" class="list-group-item list-group-item-action bg-primary text-light">Siswa</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-dark bg-primary border-bottom">
                <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Profile
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#"><?php echo $_SESSION['username'];?></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="index.php?page=logout">Logout</a>
                        </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid">                
            <?php
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                    switch ($page) {
                        case 'dashboard':
                        include "dashboard.php";
                        break;
                        case 'soal':
                        include "soal.php";
                        break;
                        case 'editsoal':
                        include "editSoal.php";
                        break;
                        case 'insertsoal':
                        include "insertSoal.php";
                        break;
                        case 'siswa':
                        include "siswa.php";
                        break;
                        case 'logout':
                        include "logout.php";
                        break;
                        default:
                        echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
                        break;
                    }
                }
            ?>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
<!-- import file javascript untuk bootstrap -->
<script src="js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
<script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
</script>
</body>
</html>