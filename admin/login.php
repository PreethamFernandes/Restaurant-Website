<?php
include "../config/db-connect.php";
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM `tbl_admin` WHERE `username` = '$username' AND `password` = '$password'";
    $result = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['login-true'] = "<div class='success'>You have logged in successfully!</div>";
        $_SESSION['user'] = $username;
        $_SESSION['loggedin'] = true;
        header("location: ./index.php");
    } else {
        $_SESSION['login-false'] = "<div class='danger'>Invalid Credentials!</div>";
        header("location: ./login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Login to Preetham Restaurent</title>
    <style>
        input {
            border: none;
            text-align: left;
            border-bottom: 3px solid black;
        }

        input:hover {
            border-bottom: 3px solid grey;
            transition: 0.4s;
        }

    </style>

    <!-- <script>
        let full_name = document.getElementById("full_name")

        full_name.addEventListener("keyup", () => {
            console.log("key uped!")
        })
    </script> -->
</head>

<body>
    <div class="login text-center">
        <?php
        if (isset($_SESSION['login-false'])) {
            echo $_SESSION['login-false'];
            unset($_SESSION['login-false']);
        }
        if (isset($_SESSION['no-login'])) {
            echo $_SESSION['no-login'];
            unset($_SESSION['no-login']);
        }
        if (isset($_SESSION['logout-true'])) {
            echo $_SESSION['logout-true'];
            unset($_SESSION['logout-true']);
        }

        if (isset($_SESSION['logout'])) {
            echo $_SESSION['logout'];
            unset($_SESSION['logout']);
        }

        ?>
        <h1>Login</h1>
        <form id="form" onk class="admin-form" name="form" action="login.php" method="post">
            <!-- <label for="full_name">Full Name</label>
            <input type="text" class="imp" id="full_name" name="full_name" placeholder="Enter you Full Name" required> -->

            <label for="username">Username</label>
            <input autocomplete="true" type="text" class="imp" name="username" id="username" placeholder="Enter your Username" required>

            <label for="password">Password</label>
            <input type="password" class="imp" name="password" id="password" placeholder="Enter your Password" required>

            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>
</body>

</html>