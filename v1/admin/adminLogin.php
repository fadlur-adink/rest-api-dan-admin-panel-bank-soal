<?php
    session_start();
    require_once '../../include/DbOperations.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['username']) AND isset($_POST['password'])){

            $db = new DbOperations();
            if($result = $db->adminLogin($_POST['username'], $_POST['password'])){
                $_SESSION['username'] = $result['username'];
                header('location:index.php?page=dashboard');
            }else{
                header('location:login.php?wrongaccount');
            }

        }else{
            header('location:login.php?empetyfield');
        }
    }else{
        header('location:login.php?invalidrequest');
    }
?>
