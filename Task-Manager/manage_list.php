<?php
include('config/constants.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css">
</head>
<body>
    <div class="wrapper">
    <h1>TASK MANAGER</h1>
    <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>

    <h3>Manage Lists Page</h3>

    <!-- <p> -->
        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'] ;
            unset($_SESSION['delete'] );
        }

        if(isset($_SESSION['delete_fail'])){
            echo $_SESSION['delete_fail'] ;
            unset($_SESSION['delete_fail'] );
        }
        
        ?>

        <?php
                if(isset($_SESSION['update'] )){
                    echo $_SESSION['update'] ;
                    unset($_SESSION['update'] );
                }
                ?>
    <!-- </p> -->

    <!-- Table to dispay lists starts here -->
    <div class="all-lists">
        <a class="btn-primary" href="<?php echo SITEURL; ?>add_list.php">Add List</a>
        <table class="tbl-half">
            <tr>
                <th>S.N</th>
                <th>List Name</th>
                <!-- <th>Description</th> -->
                <th>Action</th>
            </tr>

            <?php
            $query = "SELECT * FROM tbl_lists";
            $result = mysqli_query($conn, $query);
            if($result==true){
                // count number of rows in database
                $count = mysqli_num_rows($result);

                $sn = 1;
                // check whether there is data in database
                if($count>0){
                    // display data
                    while($row=mysqli_fetch_assoc($result)){
                        // getting the data from database
                        $list_id = $row['list_id'];
                        $list_name = $row['list_name'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $list_name; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>update-list.php?list_id=<?php echo $list_id; ?>">Update</a>
                                <a href="<?php echo SITEURL; ?>delete-list.php?list_id=<?php echo $list_id; ?>">Delete</a>
                            </td>
                        </tr>

                        <?php
                    }
                }else{
                    // No data
                    ?>
                    <tr>
                        <td colspan="3">No List Added Yet</td>
                    </tr>
                    <?php

                }
            }

            ?>

        </table>
    </div>

    <!-- Table to display lists ends here -->
    </div>
</body>
</html>