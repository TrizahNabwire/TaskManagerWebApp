<?php
include('config/constants.php');


if(isset($_GET['task_id'])){
    $task_id = $_GET['task_id'];
    $query = "DELETE FROM tbl_tasks WHERE task_id=$task_id";
    $result = mysqli_query($conn, $query);
    if($result==true){
        $_SESSION['delete'] = "Task Deleted Successfully";
        header("Location:".SITEURL);

    }else{
        $_SESSION['delete_fail'] = "Failed To Delete Task";
        header("Location:".SITEURL);
    }
}else{
    header("Location:".SITEURL);
}
?>