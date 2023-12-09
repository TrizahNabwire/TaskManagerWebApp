<?php

// create constants to save database credentials
define('LOCALHOST','localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'task_manager');

define('SITEURL', 'http://localhost/Task-Manager/');

$conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD, DB_NAME);
if(!$conn){
   die('Could not Connect MySQL:');
}
?>