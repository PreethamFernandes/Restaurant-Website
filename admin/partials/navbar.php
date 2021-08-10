<!DOCTYPE html>
<html lang="en">

<?php include "../config/db-connect.php" ?>
<?php include "./login-check.php" ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" href="../images/logo.jpg" type="image/x-icon">
    <title> Preetham Restaurent | Admin Panel </title>
</head>

<body>

    <nav class="menu">
        <div class="wrapper">
            <ul class="text-center">
                <li><a href="./index.php">Home</a></li>
                <li><a href="./manage-admin.php">Admin</a></li>
                <li><a href="./manage-categories.php">Category</a></li>
                <li><a href="./manage-food.php">Food</a></li>
                <li><a href="./manage-orders.php">Order</a></li>
                <li><a href="./logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
