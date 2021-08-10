<?php include "./partials/navbar.php" ?>

<div class="wrapper">
    <h1>Update Admin</h1>

    <?php
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id="";
        }
 
        $sql = "SELECT * FROM `tbl_admin` WHERE `id` = '$id'";
        $result = mysqli_query($conn, $sql);

        if($result == true) {
            $count = mysqli_num_rows($result);
            
            if($count == 1) {
                
                while($row = mysqli_fetch_assoc($result)) {
                    $fullname = $row['full_name'];
                    $username = $row['username'];
                }

            } else {
                header("location: ./manage-admin.php");
            }
        }
        ?>
        <form id="form" class="admin-form" name="form" action="update-admin.php" method="post">
        <label for="full_name">Full Name</label>
        <input type="text" class="imp" id="full_name" name="full_name" placeholder="Enter you Full Name" value="<?php echo $fullname; ?>" required>

        <label for="username">Username</label>
        <input type="text" class="imp" name="username" id="username" placeholder="Enter your Username" value="<?php echo $username; ?>" required>

        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
    </form>
</div>

<?php 
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];
        $fullnameFinal = $_POST['full_name'];
        $usernameFinal = $_POST['username'];

        $sql = "UPDATE `tbl_admin` SET `full_name` = '$fullnameFinal', `username` = '$usernameFinal' WHERE `tbl_admin`.`id` = '$id';";
        $result = mysqli_query($conn, $sql);

        if($result == true) {
            $_SESSION['update'] = "<div class='success'> Updated Admin Successfully! </div>";
            header('location: ./manage-admin.php');
        } else {
            $_SESSION['update'] = "<div class='danger'> Failed to Update Admin!</div>";
            header('location: ./manage-admin.php');
        }
    }
?>

<?php include "./partials/footer.php" ?>