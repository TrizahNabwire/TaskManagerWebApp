<?php
include('config/constants.php');

?>
<html>
    <head>
        <title>Task Manager</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css">
    </head>
    <body>
        <div class="wrapper">
        <h1>TASK MANAGER</h1>

        <a class="btn-secondary" href="<?php echo SITEURL;?>">Home</a>

        <h3>Add Task Page</h3>

        <p>
            <?php
            if(isset($_SESSION['add_fail'])){
                echo $_SESSION['add_fail'] ;
                unset($_SESSION['add_fail'] );
            }

            ?>
        </p>

        <form action="" method="post">
            <table class="tbl-half">
                <tr>
                    <td>Task Name</td>
                    <td>
                        <input type="text" name="task_name" placeholder="Type your task name" id="" required>
                    </td>
                </tr>

                <tr>
                    <td>Task Description</td>
                    <td>
                        <textarea name="task_description" id="" cols="50" rows="3" placeholder="Type your task description"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Select List</td>
                    <td>
                        <select name="list_id" id="">
                            <?php
                            $query = "SELECT * FROM tbl_lists";
                            $result = mysqli_query($conn, $query);
                            if($result==true){
                                $count = mysqli_num_rows($result);
                                if($count>0){
                                    // display all lists on dropdown from database
                                    while($row=mysqli_fetch_assoc($result)){
                                        $list_id = $row['list_id'];
                                        $list_name = $row['list_name'];
                                        ?>
                                        <option value="<?php echo $list_id; ?>"><?php echo $list_name;?></option>

                                        <?php
                                    }
                                }else{
                                        // display none as options
                                    ?>
                                    <option value="0">None</option>
                                    <?php
                                    }
                            }
                            ?>
                            

                            <!-- <option value="2">Doing</option> -->
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Priority</td>
                    <td>
                        <select name="priority" id="">
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Deadline</td>
                    <td>
                        <input type="date" name="deadline" id="">
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" name="submit" value="SAVE" class="btn-primary btn-lg">
                    </td>
                </tr>
            </table>
        </form>
        </div>
    </body>
</html>
<?php
if(isset($_POST['submit'])){
    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_description'];
    $list_id = $_POST['list_id'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];


    $query1 = "INSERT INTO tbl_tasks SET
    task_name = '$task_name',
    task_description = '$task_description',
    list_id = $list_id,
    priority = '$priority',
    deadline = '$deadline'
    ";

    $result1 = mysqli_query($conn, $query1);

    if($result1==true){
        $_SESSION['add'] = "Task Added Successfully";
        header("Location:".SITEURL);

    }else{
        $_SESSION['add_fail'] = "Failed to Add Task";
        header("Location:".SITEURL."add_task.php");

    }
}
?>