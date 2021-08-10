<?php include "./partials/navbar.php" ?>

<?php
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header("location: ./manage-admin.php");
    }
?>

<div class="main">
    <div class="wrapper">
        <h1>Update Password</h1>

        <form id="form" class="admin-form" name="form" action="./update-password.php" method="post">
            <label for="old_password">Old Password</label>
            <input type="password" class="imp" id="old_password" name="old_password" placeholder="Enter your Old Password" required>

            <label for="new_password">New Password</label>
            <input type="password" class="imp" name="new_password" id="new_password" placeholder="Enter your New Password" required>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" class="imp" name="confirm_password" id="confirm_password" placeholder="Confirm your New Password" required>

            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>
</div>

<?php

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $current_password = md5($_POST['old_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    $sql = "SELECT * FROM `tbl_admin` WHERE `id` = $id AND `password` = '$current_password' ";
    $result = mysqli_query($conn, $sql);

    if($result == true) {
        $count = mysqli_num_rows($result);
        
        if($count == 1) {
            if($new_password == $confirm_password) {
                $sql = "UPDATE `tbl_admin` SET `password` = '$new_password' WHERE `tbl_admin`.`id` = '$id';";
                $result = mysqli_query($conn, $sql);
                $_SESSION['password'] = "<div class='success'>Pasword Changes successfully!</div>";
            } else {
                $_SESSION['password'] = "<div class='danger'>New Password and Confirm Password do not match! </div>";
            }
        } else {
            $_SESSION['password'] = "<div class='danger'>Old Password Incorrect!</div>";
        }
        
    }
}

?>

<?php include "./partials/footer.php" ?>