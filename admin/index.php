<?php include "./partials/navbar.php" ?>

<?php
if (!isset($_SESSION['user'])) {
    $_SESSION['no-login'] = "<div class='danger'>Login to access Admin Control Panel </div>";
    header("location: ./login.php");
}
?>

<!-- Main Content -->
<main class="main">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <?php
        if (isset($_SESSION['login-true'])) {
            echo $_SESSION['login-true'];
            unset($_SESSION['login-true']);
        }

        ?>

        <div class="col-4 text-center">
            <h1>
                <?php
                $sql = "SELECT * FROM tbl_category";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);
                echo $count;
                ?>
            </h1>
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>
                <?php
                $sql2 = "SELECT * FROM tbl_food";
                $result2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($result2);
                echo $count2;
                ?>
            </h1>
            Food
        </div>
        <div class="col-4 text-center">
            <h1>
                <?php
                $sql3 = "SELECT * FROM tbl_order";
                $result3 = mysqli_query($conn, $sql3);
                $count3 = mysqli_num_rows($result3);
                echo $count3;
                ?>
            </h1>
            Total Orders
        </div>
        <div class="col-4 text-center">
            <h1>
                <?php 
                $sql4 = "SELECT SUM(total) as TOTAL FROM tbl_order WHERE status = 'delivered'";
                $result4 = mysqli_query($conn, $sql4);
                $row = mysqli_fetch_assoc($result4);
                $revenue = $row['TOTAL'];
                echo "₹".$revenue;
                ?>
            </h1>
            Revenue Generated
    </div>
    </div>
    <div class="floatFix">

    </div>
</main>

<!-- ------------ Footer ------------------ -->
<?php include "./partials/footer.php" ?>
</body>

</html>