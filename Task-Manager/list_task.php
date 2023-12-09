<?php
include("config/constants.php");
$list_id_url = $_GET['list_id'];


?>

<html>
    <head>
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

        <div class="all-task">
            <a class="btn-primary" href="<?php echo SITEURL; ?>add_task.php">Add Task</a>

            <table class="tbl-full">
                <tr>
                    <th>SN.</th>
                    <th>Task Name</th>
                    <th>Priority</th>
                    <th>Deadline</th>
                    <th>Actions</th>
                </tr>

                <?php
                $query2 = "SELECT * FROM tbl_tasks WHERE list_id=$list_id_url";
                $result2 = mysqli_query($conn, $query2);
                if($result2==true){
                    $count = mysqli_num_rows($result2);
                    $sn = 1;
                    if($count>0){
                        while($row2 = mysqli_fetch_assoc($result2)){
                            $task_id = $row2['task_id'];
                            $task_name = $row2['task_name'];
                            $priority = $row2['priority'];
                            $deadline = $row2['deadline'];
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
                        ?>
                        <tr>
                            <td colspan="5">No Tasks Added on this list</td>
                        </tr>
                        <?php
                    }
                }
                ?>

                
            </table>
        </div>
        </div>
    </body>
</html>