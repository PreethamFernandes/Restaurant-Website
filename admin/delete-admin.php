<?php include "./partials/navbar.php"; ?>
<!-- <?php include "../config/db-connect.php"  ?> -->
<?php
    $id = $_GET['id'];

    $sql = "DELETE FROM `tbl_admin` WHERE id = $id;";
    $result = mysqli_query($conn, $sql);

    if($result = true) {
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Succesfully</div>";
        header("location: ./manage-admin.php");
    } else {
        $_SESSION['delete'] = "<div class='danger'>Failed to Delete Admin! Try again later!</div>";
        header("location: ./manage-admin.php");
    }
?>