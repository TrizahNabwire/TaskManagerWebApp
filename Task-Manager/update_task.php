<?php
include("config/constants.php");

if(isset($_GET['task_id'])){
    $task_id = $_GET['task_id'];
    $query = "SELECT * FROM tbl_tasks WHERE task_id=$task_id";
    $result = mysqli_query($conn, $query);
    if($result==true){
        $row = mysqli_fetch_assoc($result);
        $task_name = $row['task_name'];
        $task_description = $row['task_description'];
        $list_id = $row['list_id'];
        $priority = $row['priority'];
        $deadline = $row['deadline'];
    }else{
        header("Location:".SITEURL);
    }
}
?>


<html>
    <head>
        <title>Task Manager</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css">
    </head>
    <body>
        <div class="wrapper">
        <h1>TASK MANAGER</h1>

        <div class="menu">
            <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>
        </div>

        <h3>Update Task Page</h3>

        <form action="" method="post">
            <table class="tbl-half">
                <tr>
                <td>Task Name</td>
                <td>
                    <input type="text" name="task_name" value="<?php echo $task_name; ?>" required="required" id="">
                </td>
                </tr>

                <tr>
                    <td>Task Description</td>
                    <td>
                        <textarea name="task_description" id="" cols="50" rows="3"><?php echo $task_description; ?></textarea>
                    </td>
                </tr>

                <tr>
                <td>Select List</td>
                    <td>
                        <select name="list_id"> 
                        <?php
                        $query2 = "SELECT * FROM tbl_lists";
                        $result2 = mysqli_query($conn, $query2);
                        if($result2==true){
                            $count = mysqli_num_rows($result2);
                            if($count>0){
                                while($row2=mysqli_fetch_assoc($result2))
                                {
                                    $list_id_db = $row2['list_id'];
                                    $list_name = $row2['list_name'];
                                    ?>
                                    <option <?php if($list_id_db==$list_id){echo "selected='selected'";} ?> value="<?php echo $list_id_db; ?>"><?php echo $list_name; ?></option>
                                    <?php
                                }

                            }else{
                                ?>
                                <option <?php if($list_id=0){echo "selected='selected'";} ?> value="0">None</option>
                                <?php
                            }
                        }
                        ?>
                            
                    
                        </select>

                </tr>

                <tr>
                    <td>Priority</td>
                    <td>
                    <select name="priority" value="<?php echo $priority; ?>">
                            <option <?php if($priority=="High"){echo "selected='selected'";}?> value="High">High</option>
                            <option <?php if($priority=="Medium"){echo "selected='selected'";} ?> value="Medium">Medium</option>
                            <option <?php if($priority=="Low"){echo "selected ='selected'";} ?> value="Low">Low</option>
                    </select>
                    </td>
                </tr>

                <tr>
                    <td>Deadline</td>
                    <td>
                    <input type="date" name="deadline" value="<?php echo $deadline; ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" name="submit" value="Update Task" class="btn-primary btn-lg">
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

    $query1 = "UPDATE tbl_tasks SET
    task_name = '$task_name',
    task_description = '$task_description',
    list_id = $list_id,
    priority = '$priority',
    deadline = '$deadline'
    WHERE task_id = $task_id
    ";

    $result1 = mysqli_query($conn, $query1);
    if($result1==true){
        $_SESSION['update'] = "Task Updated Successfully";
        header("Location:".SITEURL);
    }else{
        $_SESSION['update_fail'] = "Failed to update task";
        header("Location:".SITEURL."update_task.php?task_id=".$task_id);

    }
}
?>