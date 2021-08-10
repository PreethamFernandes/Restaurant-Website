<!-- Menu -->
<?php include "./partials/navbar.php" ?>

<!-------------- Main Content -------------->
<main class="main">
    <div class="wrapper">
        <h1>Manage Admin</h1>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if(isset($_SESSION['password'])) {
            echo $_SESSION['password'];
            unset($_SESSION['password']);
        }
        ?>

        <br>
        <br>

        <a href="./add-admin.php" id="admin" class="btn btn-primary">Add Admin</a>
        <table class="tbl-full">
            <tr>
                <th>S.No</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM `tbl_admin`;";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);
            if ($count > 0) {
                $num = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $name = $row['full_name'];
                    $username = $row['username'];
                    $num = $num + 1;
                    echo ' <tr>
                        <td>' . $num . '</td>
                        <td>' . $name . '</td>
                        <td>' . $username . '</td>
                        <td>
                            <a href="update-admin.php?id=' . $id . '" class="btn btn-primary">Update Admin</a>
                            <a href="delete-admin.php?id=' . $id . '" class="btn btn-danger">Delete Admin</a>
                            <a href="update-password.php?id=' . $id . '" class="btn btn-dark">Change Password</a>
                        </td>
                    </tr>';
                }
            } else {
                echo "No data!";
            }

            ?>

        </table>
    </div>

</main>


<!-- ------------ Footer ------------------ -->
<?php include "./partials/footer.php" ?>
</body>

</html>