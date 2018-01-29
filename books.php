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

	<?php 
		require_once('nav.php');
	?>

	<div class="row"><!-- row class is used for grid system in Bootstrap-->
		<div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Register Book</h3>
				</div>
				<div class="panel-body">
					<form role="form" method="post" action="books.php">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Title *" name="title" type="text" autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Author *" name="author" type="text" autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Shelf *" name="shelf" type="text" value="">
							</div>
							
							<input class="btn btn-lg btn-success btn-block" type="submit" value="Register Book" name="register_book" >
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="table-scrol">
		<h1 align="center">Registered Books</h1>

		<div class="table-responsive"><!--this is used for responsive display in mobile and other devices-->

			<table class="table table-bordered table-hover table-striped" style="table-layout: fixed">
				<thead>
					<tr>
						<th>Book ID</th>
						<th>Title</th>
						<th>Author</th>
						<th>Shelf</th> 
						<th>Action</th>
					</tr>
				</thead>

				<?php
				include("db/db_conection.php");
				$view_books_query="select * from books";//select query for viewing users.
				$run=mysqli_query($dbcon,$view_books_query);//here run the sql query.

				while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.
				{
					$book_id=$row[0];
					$title=$row[1];
					$author=$row[2];
					$shelf=$row[3];
				?>

				<tr>
					<td><?php echo $book_id;  ?></td>
					<td><?php echo $title;  ?></td>
					<td><?php echo $author;  ?></td>
					<td><?php echo $shelf;  ?></td> 
					<td><a href="delete.php?del=<?php echo $book_id ?>&entity=b"><button class="btn btn-danger">Delete</button></a></td> 
				</tr>

				<?php } ?>

			</table>
		
		</div>

	</div>
</div>

<?php


if(isset($_POST['register_book']))
{
    $title=$_POST['title'];//here getting result from the post array after submitting the form.
    $author=$_POST['author'];//same
	$shelf=$_POST['shelf'];//same
	$issue_date= new DateTime;//same

	if( isset($_GET['reg_no']) ) {
		$reg_no = $_GET['reg_no'];	
	}

	if($title=='' && $author=='' && $shelf=='')
    {
        //javascript use for input checking
        echo"<script>alert('All * fields are requird!')</script>";
		exit();//this use if first is not work then other will not show
    
	}

	//insert the user into the database.
	$insert_book="insert into books (title,author,shelf,issue_date,reg_no) VALUE ('$title','$author','$shelf','$issue_date','$reg_no')";

	if(mysqli_query($dbcon,$insert_book))
	{
		echo"<script>window.open('books.php','_self')</script>";
	}
	
}

?>

</body>

</html>
