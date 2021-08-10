<!-- Menu -->
<?php include "./partials/navbar.php" ?>

<!-- Main Content -->
<main class="main">
    <div class="wrapper">
        <h1>Manage Orders</h1>

        <?php
        if(isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <?php
        $sql = "SELECT * FROM tbl_order ORDER BY id desc";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        if ($count > 0) {
        ?>
            <table class="tbl-full">
                <tr>
                    <th>S.No</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sno++;
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $quantity =$row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                ?>
                    <tr>
                        <td><?php echo $sno ?></td>
                        <td><?php echo $food ?></td>
                        <td><?php echo $price ?></td>
                        <td><?php echo $quantity ?></td>
                        <td><?php echo $total ?></td>
                        <td><?php echo $order_date ?></td>
                        <td><?php 
                            if($status == "ordered") {
                                ?>
                                <p><?php echo $status ?></p>
                                <?php
                            } elseif($status == "delivery") {
                                ?>
                                <p style="color: orange;"><?php echo $status?></p>
                                <?php
                            } elseif($status == "cancel") {
                                ?>
                                <p style="color: red;"><?php echo $status ?></p>
                                <?php
                            } else {
                                ?>
                                <p style="color: green;"><?php echo $status ?></p>
                                <?php
                            }
                        ?></td>
                        <td><?php echo $customer_name ?></td>
                        <td><?php echo $customer_contact ?></td>
                        <td><?php echo $customer_email ?></td>
                        <td><?php echo $customer_address ?></td>
                        <td>
                            <a href="./update-order.php?id=<?php echo $id ?>" class="btn btn-primary">Update Order</a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <div class="danger">No Order Yet!</div>
            <?php
            }
            ?>

            </table>
    </div>
    <div class="floatFix">

    </div>
</main>

<!-- ------------ Footer ------------------ -->
<?php include "./partials/footer.php" ?>
</body>

</html>