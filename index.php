<?php
session_start();

if(!$_SESSION['email'])
{
	include("db/db_conection.php");

	$usertable = "CREATE TABLE IF NOT EXISTS `users` (
	`id` int(11) NOT NULL auto_increment,
	`username` varchar(100) NOT NULL,
	`email` varchar(100) NOT NULL,
	`password` varchar(100) NOT NULL,
	`is_admin` tinyint(1) DEFAULT NULL,
	PRIMARY KEY (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5";
	
	mysqli_query($dbcon, $usertable);

	$studenttable = "CREATE TABLE IF NOT EXISTS `students` (
		`reg_no` int(11) NOT NULL auto_increment,
		`st_name` varchar(25) NOT NULL,
		`f_name` varchar(10) NOT NULL,
		`class` varchar(12) NOT NULL,
		`address` varchar(25) NOT NULL,
		PRIMARY KEY (`reg_no`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5";
		
	mysqli_query($dbcon, $studenttable);


	$booktable = "CREATE TABLE IF NOT EXISTS `books` (
		`acc_no` int(10) NOT NULL auto_increment,
		`title` varchar(10) NOT NULL,
		`author` varchar(25) NOT NULL,
		`shelf` varchar(10) NOT NULL,
		`issue_date` Date,
		`return_date` Date,
		`reg_no`  varchar(12) DEFAULT NULL,
		PRIMARY KEY (`acc_no`),
		FOREIGN KEY (reg_no) REFERENCES students(reg_no) on delete cascade 
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5";
			
	mysqli_query($dbcon, $booktable);
	

	$pass = md5('admin');
	$insert_user="insert into users (username,password,email,is_admin) VALUE ('admin', $pass,'admin@admin.com', 1)";
    
	mysqli_query($dbcon,$insert_user);
	
    header("Location: login.php");//redirect to login page to secure the welcome page without login access.
}

?>

<html>
<head>
	<meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css"> <!--css file link in bootstrap folder-->
    
    <title>
        Online Library :: Home
    </title>
</head>

<body>

	<div class="container">
	
		<?php require_once('nav.php') ?>

		<h1>Welcome</h1><br>
		<?php
			
			if(isset($_SESSION['is_admin'])) {
				echo '<h1>ADMIN LOGGED IN</h1>';
			}
		?>
	
	</div>
</body>

</html>

