<?php include "./partials_front/navbar.php" ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_food WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $row = mysqli_fetch_assoc($result);
        $title = $row['title'];
        $image_name = $row['image_name'];
        $price = $row['price'];
    } else {
        header("location: ./index.php");
    }
} else {
    header("location: ./index.php");
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
        <form action="./order.php" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    if ($image_name != "") {
                        ?>
                        <img src="./images/food/<?php echo $image_name ?>" alt="Food" class="img-responsive img-curve">
                        <?php
                    } else {
                    ?>
                        <img src="./images/default-image.jpg" alt="Food" class="img-responsive img-curve">
                    <?php
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title ?></h3>
                    <input type="hidden" name="title" value="<?php echo $title ?>">

                    <p class="food-price">₹<?php echo $price ?></p>
                    <input type="hidden" name="price" value="<?php echo $price ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" min="1" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="Enter your Name" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="Enter your Contact Number" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="Enter your Email Address" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

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

<?php
    if(isset($_POST['submit'])) {
        $food = $_POST['title'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $price * $qty;
        $status = "ordered";
        $date = date("Y-m-d h:i:sa");
        $customer_name = $_POST['full-name'];
        $customer_email = $_POST['email'];
        $customer_contact = $_POST['contact'];
        $customer_address = $_POST['address'];

        $sql2 = "INSERT INTO `tbl_order` ( `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES ('$food', '$price', '$qty', '$total', '$date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address');
        ";
        $result2 = mysqli_query($conn, $sql2);

        if ($result2 == true) {
            $_SESSION['insert'] = "<div class='success'>Ordered Successfully </div> <br> <br>";
            header("location: ./index.php");
        } else {
            $_SESSION['insert'] = "<div class='danger'>Failed to order!</div> <br> <br>";
            header("location: ./index.php");
        }
    }
?>

<?php include "./partials_front/footer.php" ?>


</body>

</html>