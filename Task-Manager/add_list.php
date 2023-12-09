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
    <a class="btn-secondary" href="<?php echo SITEURL; ?>manage_list.php">Manage Lists</a>

    <h3>Add List Page</h3>

    <p>
        <?php
        if(isset($_SESSION['add-fail'])){
            echo $_SESSION['add-fail'];
            unset($_SESSION['add-fail']);
        }

        ?>
    </p>

    <!-- Form to add list starts here -->
    <form action="" method="POST">
        <table class="tbl-half">
            <tr>
                <td>List Name: </td>
                <td><input type="text" name="list_name" id="" placeholder="Type list name here" required></td>
            </tr>

            <tr>
                <td>List Description: </td>
                <td><textarea name="list_description" id="" cols="50" rows="3" placeholder="Type list description here"></textarea></td>
            </tr>

            <tr>
                <td><input type="submit" name="submit" value="SAVE" class="btn-primary btn-lg"></td>
            </tr>

        </table>
    </form>

    <!-- Form to add list ends here -->
    </div>
</body>
</html>

<?php
// check whether the form is submitted or not
if(isset($_POST['submit'])){

    // get the values from form and save it in variables
    $list_name = $_POST['list_name'];
    $list_description = $_POST['list_description'];

    // Connect Database
    // $con = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die('Failed to connect');
    //  or die(mysqli_error());

    // check whether the database is connected or not
    /*if($con==true){
        echo "Database Connected ";
    }
    */

    // select database
    // $db_select = mysqli_select_db($con, DB_NAME);

    // check whether database is connected or not
    /*if($db_select==true){
        echo "Database Selected";
    }
    */

    // Query to insert data into database
   $query = "INSERT INTO tbl_lists SET
    list_name = '$list_name',
    list_description = '$list_description'
    ";

    // execute query and insert into database
    $result = mysqli_query($conn, $query);

    // check whether the query executed successfully or not
    if($result==true){
        // data inserted succesfully
        $_SESSION['add'] = "List Added Successfully";
        header("Location: ".SITEURL.'manage_list.php');
    }else{
        // failed to insert data
        $_SESSION['add-fail'] = "Failed to Add List";
        header("Location: ".SITEURL.'add_list.php');
        
    }

}
?>