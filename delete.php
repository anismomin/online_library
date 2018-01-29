<?php

include("db/db_conection.php");
$delete_id=$_GET['del'];
$entity=$_GET['entity'];

if($entity == 'u') {
	$delete_query="delete  from users WHERE id='$delete_id'";//delete query
	$run=mysqli_query($dbcon,$delete_query);
	if($run)
	{
		//javascript function to open in the same window
		echo "<script>window.open('view_users.php?deleted=User has been deleted','_self')</script>";
	}

} else if($entity == 'u') {
	$delete_query="delete  from students WHERE id='$delete_id'";//delete query
	$run=mysqli_query($dbcon,$delete_query);
	if($run)
	{
		//javascript function to open in the same window
		echo "<script>window.open('students.php?deleted=Student has been deleted','_self')</script>";
	}
} else if($entity == 'b') {
	$delete_query="delete  from books WHERE id='$delete_id'";//delete query
	$run=mysqli_query($dbcon,$delete_query);
	if($run)
	{
		//javascript function to open in the same window
		echo "<script>window.open('books.php?deleted=Book has been deleted','_self')</script>";
	}
}


?>