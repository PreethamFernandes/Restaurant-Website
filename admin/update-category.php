<?php include "./partials/navbar.php" ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM `tbl_category` WHERE `id` = $id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($result);

        $title = $row['title'];
        $current_image = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
    } else {
        $_SESSION['update'] = "<div class='danger'>Category not found!</div> <br> <br>";
        header("location: ./manage-categories.php");
    }
} else {
    header("location: ./manage-categories.php");
}
?>

<div class="main">
    <div class="wrapper">
        <h1>Update Category</h1>

        <form class="admin-form" action="./update-category.php" method="post" enctype="multipart/form-data">
            <label for="title">Title</label>
            <input class="imp" type="text" name="title" id="title" value="<?php echo $title ?>" placeholder="Enter your Category"> <br>

            <label for="">Current Image Image</label> <br> <br>

            <?php
            if ($current_image != "") {
            ?>
                <img src="../images/category/<?php echo $current_image ?>" name="current_image" width="200px" alt="">
                <br>
                <br>
            <?php
            } else {
                echo "<div class='danger'>Image Not Added</div> <br>";
            }
            ?>

            <label for="new_image">New Image</label>
            <input type="file" name="file" id="new_image"> <br><br>

            <label>Featured</label> <br> <br>
            <input <?php if ($featured == "yes") {
                        echo "checked";
                    } ?> type="radio" name="feautured" value="yes" placeholder="Enter your Username" required> Yes <br>
            <input <?php if ($featured == "no") {
                        echo "checked";
                    } ?> type="radio" name="feautured" value="no" placeholder="Enter your Username" required> No <br> <br>

            <label for="">Active</label> <br> <br>
            <input <?php if ($active == "yes") {
                        echo "checked";
                    } ?> type="radio" name="active" id="" value="yes" required> Yes <br>
            <input <?php if ($active == "no") {
                        echo "checked";
                    } ?> type="radio" name="active" id="" value="no" required> No <br> <br>

            <input type="hidden" name="current_image" value="<?php echo $current_image ?>">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="submit" value="Submit" name="submit" class="btn btn-primary">
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $image_name = $_POST['file'];
            $new_featured = $_POST['feautured'];
            $new_active = $_POST['active'];

            if (isset($_FILES['file']['name'])) {
                $image_name = $_FILES['file']['name'];

                if ($image_name != "") {
                    $ext = end(explode('.', $image_name));
                    $image_name = "Food_category_" . rand(000, 999) . '.' . $ext;
                    $source_path = $_FILES['file']['tmp_name'];
                    $destination = "../images/category/$image_name";
                    $upload = move_uploaded_file($source_path, $destination);

                    if ($upload == false) {
                        $_SESSION['update'] = "<div class='danger'>Failed to Upload Image!</div> <br> <br>";
                        header("location: ./manage-categories.php");
                        die();
                    }

                    if ($current_image != "") {
                        $remove_path = "../images/category/" . $current_image;
                        $remove = unlink($remove_path);

                        if ($remove == false) {
                            $_SESSION['update'] = "<div class='danger'>Failed to Remove Image!</div> <br> <br>";
                            header("location: ./manage-categories.php");
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            $sql = "UPDATE tbl_category SET
                title = '$title',
                image_name = '$image_name',
                featured = '$new_featured',
                active = '$new_active'
                WHERE id = $id
                ";

            $result = mysqli_query($conn, $sql);

            if ($result == true) {
                $_SESSION['update'] = "<div class='success'>Updated Category Successfully</div> <br> <br>";
                header("location: ./manage-categories.php");
            } else {
                $_SESSION['update'] = "<div class='danger'>Failed to Update Category</div> <br> <br>";
                header("location: ./manage-categories.php");
            }
        }
        ?>

    </div>
</div>
<?php include "./partials/footer.php" ?>