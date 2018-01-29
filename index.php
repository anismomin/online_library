<?php
session_start();

if(!$_SESSION['email'])
{
	include("db/db_conection.php");

	$usertable = "CREATE TABLE IF NOT EXISTS `users` (
	`id` int(11) NOT NULL auto_increment,
	`user_name` varchar(100) NOT NULL,
	`user_email` varchar(100) NOT NULL,
	`user_pass` varchar(100) NOT NULL,
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


    header("Location: login.php");//redirect to login page to secure the welcome page without login access.
}

?>

<html>
<head>
    <title>
        Registration
    </title>
</head>

<body>
	<h1>Welcome</h1><br>
	<?php
		echo $_SESSION['email'];
	?>
	<h1><a href="logout.php">Logout here</a> </h1>
</body>

</html>

