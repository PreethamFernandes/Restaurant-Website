<?php include "./partials/navbar.php" ?>

<?php
if (isset($_GET['id']) && isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $sql2 = "SELECT * FROM tbl_food WHERE id = $id";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);

    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['feautured'];
    $active = $row2['active'];
} else {
    $_SESSION['update'] = "<div class=\"danger\">Unauthorized Access</div> <br> <br>";
    header("location: ./manage-food.php");
}
?>
<div class="main">
    <div class="wrapper">
        <h1>Update Food</h1>

        <form class="admin-form" action="./update-food.php" enctype="multipart/form-data" method="post">
            <label for="title">Title</label>
            <input type="text" id="title" value="<?php echo $title ?>" name="title" class="imp" placeholder="Enter Food Title" required>

            <label for="description">Description</label>
            <textarea placeholder="Enter Food Description" rows="4" value="<?php echo $description ?>" type="text" id="description" name="description" class="imp" required><?php echo $description ?></textarea>

            <label for="price">Price</label>
            <input type="number" value="<?php echo $price ?>" name="price" id="price" placeholder="Enter Food Price" class="imp" required>

            <label for="image">Current Image</label> <br> <br>
            <?php
            if ($current_image != "") {
            ?>
                <img src="../images/food/<?php echo $current_image ?>" width="300px" alt="">
            <?php
            } else {
                echo "<div class='danger'>Image Not Added</div>";
            }
            ?>

            <br><br><label for="new_image">Select Image</label>
            <input type="file" name="image" class="imp">

            <label for="category">Category</label>
            <select name="category" value="foodads" id="category" required>
                <?php
                $sql = "SELECT * FROM `tbl_category` WHERE active = 'yes'";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $category_id = $row['id'];
                        $title = $row['title'];
                ?>
                        <option <?php if ($current_category == $category_id) echo "selected" ?> value="<?php echo $category_id ?>"><?php echo $title; ?></option>
                    <?php
                    }
                } else {
                    ?>
                    <option value="">No Category Found</option>
                <?php
                }
                ?>
            </select> <br> <br>

            <label>Featured</label> <br> <br>
            <input <?php if ($featured == "yes") {
                        echo 'checked';
                    } ?> type="radio" name="feautured" value="yes" placeholder="Enter your Username" required> Yes <br>
            <input <?php if ($featured == "no") {
                        echo 'checked';
                    } ?> type="radio" name="feautured" value="no" placeholder="Enter your Username" required> No <br> <br>

            <label for="">Active</label> <br> <br>
            <input <?php if ($active == "yes") {
                        echo 'checked';
                    } ?> type="radio" name="active" id="" value="yes" required> Yes <br>
            <input <?php if ($active == "no") {
                        echo 'checked';
                    } ?> type="radio" name="active" id="" value="no" required> No <br> <br>

            <input type="hidden" value="<?php echo $id ?>" name="id">
            <input type="hidden" value="<?php echo $current_image ?>" name="current_image">

            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $current_image = $_POST['current_image'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $featured = $_POST['feautured'];
    $active = $_POST['active'];
    $image_name = $_FILES['image']['name'];

    if (isset($_FILES['image']['name'])) {



        if ($image_name != "") {
            $ext = end(explode(".", $image_name));
            $image_name = "Food_name" . rand(0000, 9999) . '.' . $ext;
            $src_path = $_FILES['image']['tmp_name'];
            $dest_path = "../images/food/".$image_name;
            $upload = move_uploaded_file($src_path, $dest_path);

            if ($upload == false) {
                $_SESSION['update'] = "<div class='danger'>Failed to Upload Image</div> <br> <br>";
                header("location: ./manage-food.php");
                die();
            }
        } else {
            $image_name = $current_image;
        }

        if ($current_image != "") {
            $remove_path = "../images/food/$current_image";
            $remove = unlink($remove_path);
            if ($remove == false) {
                $_SESSION['update'] = "<div class='danger'>Failed to remove current image!</div> <br> <br>";
                header("location: ./manage-food.php");
                die();
            }
        }  
    } else {
        $image_name = $current_image;
    }


$sql3 = "UPDATE tbl_food SET title = '$title', `description` = '$description', `price` = $price, `image_name` = '$image_name', `category_id` = '$category', `feautured` = '$featured', `active` = '$active' WHERE `id` = $id";

$result3 = mysqli_query($conn, $sql3);

if ($result3 == false) {
    $_SESSION['update'] = "<div class='danger'>Failed to Update Food </div> <br> <br>";
    header("location: ./manage-food.php");
} else {
    $_SESSION['update'] = "<div class='success'>Updated Food successfully!</div> <br> <br>";
    header("location: ./manage-food.php");
}

}
?>

<?php include "./partials/footer.php" ?>