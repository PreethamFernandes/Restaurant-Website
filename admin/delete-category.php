<?php include "./partials/navbar.php" ?>

<?php
if (isset($_GET['id']) and isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image = $_GET['image_name'];

    if ($image != "") {
        $path = "../images/category/" . $image . "";
        $remove = unlink($path);

        if ($remove == false) {
            $_SESSION['delete-cat'] = "<div class='danger'>Failed to Delete Image</div> <br> <br>";
            header("location: ./manage-categories.php");
            die();
        }

        $sql = "DELETE FROM `tbl_category` WHERE `id` = $id";
        $result = mysqli_query($conn, $sql);

        if ($result == true) {
            $_SESSION['delete-cat'] = "<div class='success'>Deleted Category Successfully</div> <br> <br>";
            header("location: ./manage-categories.php");
        } else {
            $_SESSION['delete-cat'] = "<div class='danger'>Failed to Delete Category</div> <br> <br>";
            header("location: ./manage-categories.php");
        }
    } else {
        $sql = "DELETE FROM `tbl_category` WHERE `id` = $id";
        $result = mysqli_query($conn, $sql);
        $_SESSION['delete-cat'] = "<div class='success'>Deleted Category Successfully</div> <br> <br>";
        header("location: ./manage-categories.php");
    }
} else {
    header("location: ./manage-categories.php");
}
?> 

<?php include "./partials/footer.php" ?>