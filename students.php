<?php
session_start();

if(!$_SESSION['is_admin'])
{
	header("Location: login.php");//redirect to login page to secure the welcome page without login access.
	exit;
}

?>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css"> <!--css file link in bootstrap folder-->
    <title>View Users</title>
</head>
<style>

    .table {
        margin-top: 50px;
    }
</style>

<body>

<div class="container">
	<?php require_once('nav.php') ?>

	<div class="row"><!-- row class is used for grid system in Bootstrap-->
		<div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Register Student</h3>
				</div>
				<div class="panel-body">
					<form role="form" method="post" action="students.php">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Student Name *" name="st_name" type="text" autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Father Name *" name="f_name" type="text" autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Class *" name="class" type="text" value="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Address" name="address" type="text" value="">
							</div>
				
							<input class="btn btn-lg btn-success btn-block" type="submit" value="Register Student" name="register_student" >
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<div class="table-scrol">
		<h1 align="center">Registered Students</h1>

		<div class="table-responsive"><!--this is used for responsive display in mobile and other devices-->

			<table class="table table-bordered table-hover table-striped" style="table-layout: fixed">
				<thead>
					<tr>
						<th>Student Id</th>
						<th>Student Name</th>
						<th>Father Name</th>
						<th>Address</th>
						<th>Actions</th>
					</tr>
				</thead>

				<?php
				include("db/db_conection.php");
				$view_users_query="select * from students";//select query for viewing users.
				$run=mysqli_query($dbcon,$view_users_query);//here run the sql query.

				while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.
				{
					$reg_no=$row[0];
					$st_name=$row[1];
					$f_name=$row[2];
					$address=$row[3];
				?>

				<tr>
					<!--here showing results in the table -->
					<td><?php echo $reg_no;  ?></td>
					<td><?php echo $st_name; ?></td>
					<td><?php echo $f_name;  ?></td>
					<td><?php echo $address; ?></td>
					<td>
						<a href="delete.php?del=<?php echo $reg_no ?>&entity=s"><button class="btn btn-danger">Delete</button></a>
						<a href="books.php?reg_id=<?php echo $reg_no ?>"><button class="btn btn-primary">Add Book</button></a>
					</td> <!--btn btn-danger is a bootstrap button to show danger-->
				</tr>

				<?php } ?>

			</table>
		
		</div>

	</div>

</div>

<?php

if(isset($_POST['register_student']))
{
    $st_name=$_POST['st_name'];//here getting result from the post array after submitting the form.
    $f_name=$_POST['f_name'];//same
	$class=$_POST['class'];//same
	$address=$_POST['address'];//same

	if($st_name=='' && $f_name=='' && $class=='')
    {
        //javascript use for input checking
        echo"<script>alert('All * fields are requird!')</script>";
		exit();//this use if first is not work then other will not show
    
	}

	//insert the user into the database.
	$insert_student="insert into students (st_name,f_name,class,address) VALUE ('$st_name','$f_name','$class','$address')";

	if(mysqli_query($dbcon,$insert_student))
	{
		echo"<script>window.open('students.php','_self')</script>";
	}

}

?>
</body>

</html>
