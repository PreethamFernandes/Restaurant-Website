<?php include "./partials_front/navbar.php" ?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search ">
    <div class="container">


        <?php
        $search = $_POST['search'];
        $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        echo '<h2 class="text-center" >Foods on Your Search <a href="#" class="text-white">"' . $search . '"</a></h2>';
        ?>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">

        <?php
        if ($count > 0) {
            echo " <p class='text-center'>" . $count . " results found from your search '" . $search . "'</p> <br> <br> <br>  ";
        } else {
            echo "No Results found!";
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $food_id = $row['id'];
            $food_title = $row['title'];
            $food_desc = $row['description'];
            $food_price = $row['price'];
            $food_image = $row['image_name'];
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
        ?>
    </div>
    <br><br><br><br><br> <br><br><br><br><br>
</section>

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