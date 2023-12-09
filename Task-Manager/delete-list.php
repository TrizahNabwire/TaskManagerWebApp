<?php
include('config/constants.php');

// check whether list_id is assigned or not
if(isset($_GET['list_id'])){
    // get the list_id from url(get method)
    $list_id = $_GET['list_id'];
    $query = "DELETE FROM tbl_lists WHERE list_id=$list_id";
    $result = mysqli_query($conn,$query);
    if($result==true){
        $_SESSION['delete'] = "List Deleted Successfully";
        header("Location:".SITEURL."manage_list.php");

    }else{
        $_SESSION['delete_fail'] = "Failed To Delete List";
        header("Location:".SITEURL."manage_list.php");
    }

}else{
    header("Location: ".SITEURL."manage_list.php");
}



?>