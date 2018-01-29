<?php 
	//$path = $_SERVER['REQUEST_URI'];
	$path = str_replace(".php", "", basename($_SERVER["SCRIPT_NAME"]));
	// var_dump($path);
	// exit;
?>
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">Online Library</a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="<?php echo ($path == '' || $path == 'index') ? 'active' : ''; ?>"><a href="/">Home <span class="sr-only">(current)</span></a></li>
				<li class="<?php echo ($path == 'users') ? 'active' : ''; ?>"><a href="users.php">Users</a></li>
				<li class="<?php echo ($path == 'students') ? 'active' : ''; ?>"><a href="students.php">Students</a></li>
				<li class="<?php echo ($path == 'books') ? 'active' : ''; ?>"><a href="books.php">Books</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>