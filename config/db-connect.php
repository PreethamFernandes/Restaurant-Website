<?php
    session_start();

    $SiteURL = "http://127.0.0.1/restaurent/";
    $DB_server = "localhost";
    $DB_name = "root";
    $DB_password = "";
    $DB_database = "restaurent";
    
    
    $conn = mysqli_connect($DB_server,$DB_name, $DB_password, $DB_database);
?>    
