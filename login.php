<?php
session_start();//session starts here

?>

<html>
<head lang="en">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css">
    <title>Login</title>
</head>
<style>
    .login-panel {
        margin-top: 150px;

</style>

<body>


<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Sign In</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="login.php">
                        <fieldset>
                            <div class="form-group"  >
                                <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="pass" type="password" value="">
                            </div>

							<input class="btn btn-lg btn-success btn-block" type="submit" value="login" name="login" >

                            <!-- Change this to a button or input when using this as a form -->
                          <!--  <a href="index.html" class="btn btn-lg btn-success btn-block">Login</a> -->
                        </fieldset>
                    </form>
					<center><b>Not yet registered ?</b> <br></b><a href="registration.php">Register here</a></center>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

</html>

<?php

include("db/db_conection.php");

	
if(isset($_POST['login']))
{
    $username=$_POST['username'];
    $password=$_POST['pass'];
	
    $check_user="select * from users WHERE username='$username' limit 1";
	
	$run=mysqli_query($dbcon,$check_user);

	$row=mysqli_fetch_array($run);
	
	$password_hash = $row['password'];

	/*if( password_verify($password, $password_hash) ) {
		echo 'Matched </br>';
	} else {
		echo 'no Matched </br>';
	}
	var_dump($row);
	die();*/

	//if(mysqli_num_rows($run))

	//if(password_verify($password, $password_hash))
	if( md5($password) == $password_hash)
    {
		
		if($row['is_admin']){
			$_SESSION['is_admin'] = true;
		}
		
		$_SESSION['email']=$row['email']; //here session is used and value of $user_email store in $_SESSION.

        echo "<script>window.open('index.php','_self')</script>";

 
    }
    else
    {
        echo "<script>alert('Email or password is incorrect!')</script>";
    }
}
?>