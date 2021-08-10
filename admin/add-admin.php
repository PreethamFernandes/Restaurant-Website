<?php include "./partials/navbar.php" ?>

<div class="main">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>


        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $fullname = $_POST['full_name'];
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $sql = "INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES (NULL, '$fullname', '$username', '$password');";
            $result = mysqli_query($conn, $sql);

            if ($result == true) {
                $_SESSION['add'] = "Admin Added Successfully";
                header("location:" . $SiteURL . "admin/manage-admin.php");
            } else {
                $_SESSION['add'] = "Failed to add Admin";
                header("location:" . $SiteURL . "admin/add-admin.php");
            }
        }
        ?>


        <form id="form" class="admin-form" name="form" action="add-admin.php" method="post">
            <label for="full_name">Full Name</label>
            <input type="text" class="imp" id="full_name" name="full_name" placeholder="Enter you Full Name" required>

            <label for="username">Username</label>
            <input type="text" class="imp" name="username" id="username" placeholder="Enter your Username" required>

            <label for="password">Password</label>
            <input type="password" class="imp" name="password" id="password" placeholder="Enter your Password" required>

            <input type="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>
</div>

<?php include "./partials/footer.php" ?>