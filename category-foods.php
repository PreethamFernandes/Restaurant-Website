<?php include "./partials_front/navbar.php" ?>


<?php

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $sql = "SELECT * FROM tbl_category WHERE id = $category_id";
    $res = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($res);
    $category_title = $row['title'];
} else {
    header("location: ./index.php");
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id AND active = 'yes'";
        $res2 = mysqli_query($conn, $sql2);
        $count = mysqli_num_rows($res2);

        if ($count > 0) {

            while ($row2 = mysqli_fetch_assoc($res2)) {
                $food_id = $row2['id'];
                $food_title = $row2['title'];
                $food_price = $row2['price'];
                $food_image = $row2['image_name'];
                $food_description = $row2['description'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if ($food_image != "") {
                        ?>
                            <img src="images/food/<?php echo $food_image ?>" alt="<?php echo $food_title ?>" class="img-responsive img-curve">
                        <?php

                        } else {
                        ?>
                            <img src="images/food/default-image.jpg" alt="food" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $food_title ?></h4>
                        <p class="food-price"><?php echo $food_price ?></p>
                        <p class="food-detail">
                            <?php echo $food_description  ?>
                        </p>
                        <br>

                        <a href="./order.php?id=<?php echo $food_id ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "NO food!";
        }
        ?>

        <div class="clearfix"></div>
    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<!-- social Section Starts Here -->
<section class="social">
    <div class="container text-center">
        <ul>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png" /></a>
            </li>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png" /></a>
            </li>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png" /></a>
            </li>
        </ul>
    </div>
</section>
<!-- social Section Ends Here -->

<?php include "./partials_front/footer.php" ?>


</body>

</html>