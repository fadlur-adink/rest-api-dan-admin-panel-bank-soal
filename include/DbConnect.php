<?php
    class DbConnect{

        private $con;

        function __construct(){

        }

        function connect(){
            include_once dirname (__FILE__).'/Constant.php';
            $this->con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if(mysqli_connect_errno()){
                echo "Failed To Connect To Database".mysqli_connect_err();
            }

            return $this->con;
        }

    }
?>