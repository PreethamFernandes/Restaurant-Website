<?php include "./partials_front/navbar.php" ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <?php
            if(isset($_SESSION['insert'])) {
                echo $_SESSION['insert'];
                unset($_SESSION['insert']);
            }
        ?>
        <form action="food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- CAtegories Section Starts Here -->

<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        $sql = "SELECT * FROM tbl_category WHERE `featured` = 'yes' AND `active` = 'yes' LIMIT 3";
        $result = mysqli_query($conn, $sql);

        if ($result == true) {
            $count = mysqli_num_rows($result);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
        ?>
                    <a href='category-foods.php?id=<?php echo $id ?>'>
                        <div class="box-3 float-container">
                            <img src="./images/category/<?php echo $image_name ?>" alt="Pizza" class="img-responsive img-curve">

                            <h3 class="float-text text-white"><?php echo $title ?></h3>
                        </div>
                    </a>
        <?php
                }
            } else {
                echo "<div class='danger'>No Categories Added!</div>";
            }
        }

        ?>


        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        $sql2 = "SELECT * FROM tbl_food WHERE `feautured` = 'yes' AND `active` = 'yes' LIMIT 4";
        $result2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($result2);

        if ($count2 > 0) {
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $food_id = $row2['id'];
                $food_title = $row2['title'];
                $food_desc = $row2['description'];
                $food_price = $row2['price'];
                $food_image = $row2['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if ($food_image != "") {
                        ?>
                            <img src="images/food/<?php echo $food_image ?>" alt="<?php echo $food_image ?>" class="img-responsive img-curve">
                        <?php
                        } else {
                        ?>
                            <img src="./images/default-image.jpg" alt="Food Item" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                    </div>
                    <div class="food-menu-desc">
                        <h4><?php echo $food_title ?></h4>
                        <p class="food-price">₹<?php echo $food_price ?></p>
                        <p class="food-detail"><?php echo $food_desc ?></p>
                        <br>

                        <a href="./order.php?id=<?php echo $food_id ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

        <?php
            }
        } else {
            echo "<div class='danger'>No Foods Found</div>";
        }
        ?>

        <div class="clearfix"></div>

    </div>

    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
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