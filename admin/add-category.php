<?php include "./partials/navbar.php" ?>

<div class="main">
    <div class="wrapper">
        <h1>Add Category</h1>


        <form id="form" class="admin-form" name="form" action="add-category.php" method="post" enctype="multipart/form-data">
            <label for="title">Title</label>
            <input type="text" class="imp" id="title" name="title" placeholder="Enter Category Title" required>

            <label for="file">Select Image</label> <br> <br>
            <input type="file" name="image" id="file"> <br> <br>

            <label>Featured</label> <br> <br>
            <input type="radio" name="feautured" value="yes" placeholder="Enter your Username" required> Yes <br>
            <input type="radio" name="feautured" value="no" placeholder="Enter your Username" required> No <br> <br>

            <label for="">Active</label> <br> <br>
            <input type="radio" name="active" id="" value="yes" required> Yes <br>
            <input type="radio" name="active" id="" value="no" required> No <br> <br>
            <input type="submit" value="Submit" class="btn btn-primary">
        </form>

        <?php

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $title = $_POST['title'];
            $feautured = $_POST['feautured'];
            $active = $_POST['active'];

            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {
                    $ext = end(explode('.', $image_name));
                    $image_name = "Food_category_" . rand(000, 999) . '.' . $ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination = "../images/category/$image_name";
                    $upload = move_uploaded_file($source_path, $destination);

                    if ($upload == false) {
                        $_SESSION['update'] = "<div class='danger'>Failed to Upload Image!</div> <br> <br>";
                        header("location: ./manage-categories.php");
                        die();
                    }
                }
            } else {
                $image_name = "";
            }

            
            $sql = "INSERT INTO `tbl_category` (`title`, `featured`, `image_name`, `active`) VALUES ( '$title', '$feautured', '$image_name', '$active');";
            $result = mysqli_query($conn, $sql);

            if ($result = true) {
                $_SESSION['add-cat'] = "<div class='success'>Category Added Successfully </div> <br> <br>";
                header("location: ./manage-categories.php");
            } else {
                $_SESSION['add-cat'] = "<div class='danger'>Failed to add Category!</div> <br> <br>";
                header("location: ./manage-categories.php");
            }
        }
        ?>













</div>
</div>

<?php include "./partials/footer.php" ?>