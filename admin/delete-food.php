<?php include "../config/db-connect.php" ?>

<?php
    if(isset($_GET['id']) AND isset($_GET['image_name'])) {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != "") {
            $path = "../images/food/".$image_name;
            $remove = unlink($path);

            if($remove == false) {
                $_SESSION['delete'] = "<div class='danger'>Failed to Delete Image</div>";
                header("location: ./manage-food.php");
                die();
            }
        }

        $sql = "DELETE FROM `tbl_food` WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if($result == true) {
            $_SESSION['delete'] = "<div class='success'>Deleted Food Successfully</div> <br> <br>";
            header("location: ./manage-food.php");
        } else {
            $_SESSION['delete'] = "<div class='danger'>Failed to Delete Food!</div> <br> <br>";
            header("location: ./manage-food.php");
        }
    } else {
        $_SESSION['delete'] = "<div class='danger'>Unauthorized Access</div> <br> <br>";
        header("location: ./manage-food.php");
    }
?>