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

    <!-- Menu Starts Here -->
    <div class="menu">
        <a href="<?php echo SITEURL; ?>">Home</a>
        <?php
        // display lists from database in menu
        $query1 = "SELECT * FROM tbl_lists";
        $result1 = mysqli_query($conn, $query1);
        if($result1==true){
            while($row1=mysqli_fetch_assoc($result1)){
                $list_id = $row1['list_id'];
                $list_name = $row1['list_name'];
                ?>
                <a href="<?php echo SITEURL; ?>list_task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>

                <?php
            }

        }
        ?>
       

        <a href="<?php echo SITEURL; ?>manage_list.php">Manage Lists</a>
    </div>

    <!-- Menu Ends Here -->

    <p>
    <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'] ;
                unset($_SESSION['add'] );
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
    </p>

    <!-- Tasks Starts Here -->
    <div class="all-tasks">
        <a class="btn-primary" href="<?php echo SITEURL;?>add_task.php">Add Task</a>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Task Name</th>
                <!-- <th>Description</th> -->
                <th>Priority</th>
                <th>Deadline</th>
                <th>Action</th>
            </tr>

            <?php
            $query = "SELECT * FROM tbl_tasks";
            $result = mysqli_query($conn, $query);
            if($result==true){
                // display the tasks from database
                $count = mysqli_num_rows($result);
                $sn = 1;

                if($count>0){
                    // data is in database
                    while($row=mysqli_fetch_assoc($result)){
                        $task_id = $row['task_id'];
                        $task_name = $row['task_name'];
                        $priority = $row['priority'];
                        $deadline = $row['deadline'];

                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $task_name; ?></td>
                            <td><?php echo $priority; ?></td>
                            <td><?php echo $deadline; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>update_task.php?task_id=<?php echo $task_id; ?>">Update</a>
                                <a href="<?php echo SITEURL; ?>delete_task.php?task_id=<?php echo $task_id; ?>">Delete</a>
                            </td>
                        </tr>


                        <?php
                    }
                }else{
                    // no data in database
                    ?>
                    <tr>
                        <td colspan="5">No Task Added yet</td>
                    </tr>
                    <?php
                }
            }

            ?>

            
        </table>
    </div>

    <!-- Tasks Ends Here -->
    </div>
</body>
</html>