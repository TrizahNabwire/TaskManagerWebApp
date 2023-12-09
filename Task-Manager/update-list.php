<?php
include('config/constants.php');

// get the current values of selected list
if(isset($_GET['list_id'])){
    // get the list_id value
    $list_id = $_GET['list_id'];

    $query = "SELECT * FROM tbl_lists WHERE list_id=$list_id";
    $result = mysqli_query($conn, $query);

    if($result==true){
        $row=mysqli_fetch_assoc($result); //value is in array
        // print_r($row);
        $list_name = $row['list_name'];
        $list_description = $row['list_description'];

    }else{
        header("Location:".SITEURL."manage_list.php");
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

        <!-- <div class="menu"> -->
            <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>
            <a class="btn-secondary" href="<?php echo SITEURL; ?>manage_list.php">Manage Lists</a>
        <!-- </div> -->

        <h3>Update List Page</h3>

        <?php
        if(isset($_SESSION['update_fail'] )){
            echo $_SESSION['update_fail'] ;
            unset($_SESSION['update_fail'] );
        }
        ?>

        <form action="" method="post">
            <table class="tbl-half">
                <tr>
                    <td>List Name</td>
                    <td>
                        <input type="text" name="list_name" value="<?php echo $list_name; ?>" required="required" id="">
                    </td>
                </tr>

                <tr>
                    <td>List Description</td>
                    <td>
                        <textarea name="list_description" id="" cols="50" rows="3"><?php echo $list_description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" name="submit" value="Update List" class="btn-primary btn-lg">
                    </td>
                </tr>
            </table>
        </form>
        </div>
    </body>
</html>

<?php
if(isset($_POST['submit'])){
    // get the updated values from form
    $list_name = $_POST['list_name'];
    $list_description = $_POST['list_description'];

    $query1 = "UPDATE tbl_lists SET
    list_name = '$list_name',
    list_description = '$list_description'
    WHERE list_id=$list_id
    ";

    $result1 = mysqli_query($conn, $query1);

    if($result1==true){
        $_SESSION['update'] = "List Updated Successfully";
        header("Location:".SITEURL."manage_list.php");

    }else{
        $_SESSION['update_fail'] = "Failed to Update List";
        header("Location:".SITEURL."update-list.php?list_id =". $list_id);
    }


}
?>