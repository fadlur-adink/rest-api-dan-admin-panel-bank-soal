<?php
session_start();
if (isset($_SESSION['username']) ) {
    header('Location: index.php');
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
	<meta charset="UTF-8">
    <title>Admin Panel</title>
    <style type="text/css">
        body {
            background: #4747ff;
        }
        .login-form {
            width: 340px;
            margin: 10% auto;
        }
        .login-form form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }
        .login-form h2 {
            margin: 0 0 15px;
        }
        .form-control, .btn {
            min-height: 38px;
            border-radius: 2px;
        }
        .btn {        
            font-size: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <?php
            $userfail = isset($_GET['wrongaccount']);
            $empetyfield = isset($_GET['empetyfield']);
            $invalidrequest = isset($_GET['invalidrequest']);    
            if ($userfail) {
            echo '<div class="alert alert-warning alert-dismissable">
                <button class="close" data-dismiss="alert">&times;</button>
                <p>Username / Password Salah !</p>
                </div>';
            }
            else if ($empetyfield) {
            echo '<div class="alert alert-warning alert-dismissable">
                <button class="close" data-dismiss="alert">&times;</button>
                <p>Harap isi field Username dan Password</p>
                </div>';
            }
            else if ($invalidrequest) {
            echo '<div class="alert alert-warning alert-dismissable">
                <button class="close" data-dismiss="alert">&times;</button>
                <p>Required Request POST!</p>
                </div>';
            }
        ?>
        <form action="adminLogin.php" method="POST">
            <h2 class="text-center">Admin Log in</h2>       
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Log in</button>
            </div>
            <div class="clearfix">
            </div>        
        </form>
    </div>
<!-- import file javascript untuk bootstrap -->
<script src="js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>