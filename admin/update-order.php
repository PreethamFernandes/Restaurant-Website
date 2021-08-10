<?php include "./partials/navbar.php" ?>

<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_order WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if($count == 1) {
        $row = mysqli_fetch_assoc($result);
        $price = $row['price'];
        $food = $row['food'];
        $status = $row['status'];

    } else {
        header("location: ./manage-orders.php");
    }
} else {
    $_SESSION['update'] = "<div class='danger'>Unauthorized Access</div> <br> <br>";
    header("location: manage-orders.php");
}
?>
<div class="main">
    <div class="wrapper">
        <h1>Update Order</h1>
        <form class="admin-form" action="" method="post">
            <b><?php echo $food ?></b> <br><br>

            <b>₹<?php echo $price ?></b> <br><br>
            <!-- <label for="qty">Quantity:</label>
            <input class="imp" type="number" id="qty" name="qty" require> -->

            <label for="status">Status</label>
            <select class="imp" name="status" id="status" name="status">
                <option <?php if($status == "delivered") { echo "selected"; } ?> value="delivered">Delivered</option>
                <option <?php if($status == "ordered") { echo "selected"; } ?> value="ordered">Ordered</option>
                <option <?php if($status == "delivery") { echo "selected"; } ?> value="delivery">Delivery</option>
                <option <?php if($status == "cancel") { echo "selected"; } ?> value="cancel">Cancel</option>
            </select>

            <input type="hidden" name="id" value="<?php echo $id ?>.">
            <input class="btn btn-primary" type="submit" name="submit" value="Submit">
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];
        $status = $_POST['status'];

        $sql2 = "UPDATE tbl_order SET status = '$status' WHERE id = $id";
        $result2 = mysqli_query($conn, $sql2);

        if($result2 == true) {
            $_SESSION['update'] = "<div class='success'>Updated Order Successfully!</div>";
            header("location: ./manage-orders.php");
        } else {
            $_SESSION['update'] = "<div class='danger'>Failed to Update Order </div>";
            header("location: ./manage-orders.php");
        }
    }
?>

<?php include "./partials/footer.php" ?>