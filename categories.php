<?php include "./partials_front/navbar.php" ?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        $sql = "SELECT * FROM tbl_category WHERE `active` = 'yes'";
        $result = mysqli_query($conn, $sql);

        if ($result == true) {
            $count = mysqli_num_rows($result);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
        ?>
                    <a href="category-foods.php?id=<?php echo $id ?>">
                        <div class="box-3 float-container">
                            <img src="./images/category/<?php echo $image_name ?>" alt="<?php echo $title ?>" class="img-responsive img-curve">

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