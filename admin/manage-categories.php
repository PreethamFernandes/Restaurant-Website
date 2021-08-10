<!-- Menu -->
<?php include "./partials/navbar.php" ?>

<!-- Main Content -->
<main class="main">
    <div class="wrapper">
        <h1>Manage Categories</h1>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['add-cat'])) {
            echo $_SESSION['add-cat'];
            unset($_SESSION['add-cat']);
        }

        if(isset($_SESSION['delete-cat'])) {
            echo $_SESSION['delete-cat'];
            unset($_SESSION['delete-cat']);
        }

        if(isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>


        <a href="./add-category.php" id="admin" class="btn btn-primary">Add Category</a>

        <?php
        $sql = "SELECT * FROM `tbl_category`";
        $result = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($result);

        if ($count < 1) {
            echo "<tr> <td> <div class='danger'>You have No categories!</div> </td> <tr>";
        } else {
            echo '<table class="tbl-full">
                    <tr>
                        <th>S.No</th>
                        <th>Title</th>
                        <th>Image Name</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>';
            $sno = 0;

            while ($row = mysqli_fetch_assoc($result)) {
                $sno = $sno + 1;
                $id = $row['id'];
                $title = $row['title'];
                $img = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active']

        ?>

                <tr>
                    <td><?php echo $sno ?></td>
                    <td><?php echo $title ?></td>
                    <td>
                        <?php
                            if($img != "") {
                                ?>
                                <img src="../images/category/<?php echo $img?>" width="200px" alt="">
                                <?php
                            }
                             else {
                                echo '<div class="danger">Image Not Added</div>';
                            }
                        ?>
                    </td>
                    <td><?php echo $featured ?></td>
                    <td><?php echo $active ?></td>
                    <td>
                        <a href="./update-category.php?id=<?php echo $id?>" class="btn btn-primary">Update Category</a>
                        <a href="./delete-category.php?id=<?php echo $id?>&image_name=<?php echo $img?>" class="btn btn-danger">Delete Category</a>
                    </td>
                </tr>

        <?php



            }
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