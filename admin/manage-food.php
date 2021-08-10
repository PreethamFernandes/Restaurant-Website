<!-- Menu -->
<?php include "./partials/navbar.php" ?>

<!-- Main Content -->
<main class="main">
    <div class="wrapper">
        <h1>Manage Foods</h1>

        <?php
        if (isset($_SESSION['food'])) {
            echo $_SESSION['food'];
            unset($_SESSION['food']);
        }

        if(isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);    
        }

        if(isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <a href="./add-food.php" id="admin" class="btn btn-primary">Add Food</a>


        <?php
        $sql = "SELECT * FROM `tbl_food`";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        if ($count < 1) {
            echo "<tr> <td> <div class='danger'>You have No Food!</div> </td> <tr>";
        } else {
            echo '<table class="tbl-full">
            <tr>
                <th>S.No</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
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
                $featured = $row['feautured'];
                $price = $row['price'];
                $active = $row['active']

        ?>

                <tr>
                    <td><?php echo $sno ?></td>
                    <td><?php echo $title ?></td>
                    <td><?php echo $price ?></td>

                    <td>
                        <?php
                        if ($img != "") {
                        ?>
                            <img src="../images/food/<?php echo $img ?>" width="200px" alt="">
                        <?php
                        } else {
                            echo '<div class="danger">Image Not Added</div>';
                        }
                        ?>
                    </td>
                    <td><?php echo $featured ?></td>
                    <td><?php echo $active ?></td>
                    <td>
                        <a href="./update-food.php?id=<?php echo $id ?>&image_name=<?php echo $img?>" class="btn btn-primary">Update Food</a>
                        <a href="./delete-food.php?id=<?php echo $id ?>&image_name=<?php echo $img?>" class="btn btn-danger">Delete Food</a>
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