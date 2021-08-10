<?php include "./partials/navbar.php" ?>
<style>
    input,
    textarea {
        border: none;
        border-bottom: 2px solid black;
        margin-bottom: 2rem;
    }
</style>
<div class="main">
    <div class="wrapper">
        <h1>Add Food</h1>

        <form class="admin-form" action="./add-food.php" enctype="multipart/form-data" method="post">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="imp" placeholder="Enter Food Title" required>

            <label for="description">Description</label>
            <textarea placeholder="Enter Food Description" type="text" id="description" name="description" class="imp" required></textarea>

            <label for="price">Price</label>
            <input type="number" name="price" id="price" placeholder="Enter Food Price" class="imp" required>

            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="imp" >

            <label for="category">Category</label>
            <select name="category" id="category" required>
                <?php
                    $sql = "SELECT * FROM `tbl_category` WHERE active = 'yes'";
                    $result = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($result);

                    if($count > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $title = $row['title'];
                            ?>
                            <option value="<?php echo $id ?>"><?php echo $title; ?></option>
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
            <input type="radio" name="feautured" value="yes" placeholder="Enter your Username" required> Yes <br>
            <input type="radio" name="feautured" value="no" placeholder="Enter your Username" required> No <br>

            <label for="">Active</label> <br> <br>
            <input type="radio" name="active" id="" value="yes" required> Yes <br>
            <input type="radio" name="active" id="" value="no" required> No <br>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $featured = $_POST['feautured'];
        $active = $_POST['active'];

        if(isset($_FILES['image']['name'])) {
            $image_name = $_FILES['image']['name'];

            if ($image_name != "") {
                $ext = end(explode('.', $image_name));
                $image_name = "Food_item_" . rand(0000, 9999) . '.' . $ext;
                $source_path = $_FILES['image']['tmp_name'];
                $destination = "../images/food/$image_name";
                $upload = move_uploaded_file($source_path, $destination);

                if ($upload == false) {
                    $_SESSION['food'] = "<div class='danger'>Failed to Upload Image!</div> <br> <br>";
                    header("location: ./manage-food.php");
                    die();
                }
            }
        } else {
            $image_name = "";
        }
        $sql2 = "INSERT INTO `tbl_food` (`title`, `description`, `price`, `image_name`, `category_id`, `feautured`, `active`) VALUES ( '$title', '$description', $price, '$image_name', '$category', '$featured', '$active');";

        $result2 = mysqli_query($conn, $sql2);

        if($result == true){
            $_SESSION['food'] = "<div class='success'>Added Food Successfully</div> <br> <br>";
            header("location: ./manage-food.php");
        } else {
            $_SESSION['food'] = "<div class='danger'>Failed to add Food!</div> <br> <br>";
            header("location: ./manage-food.php");
        }
    }
?>

<?php include "./partials/footer.php" ?>