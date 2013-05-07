<?php
// Authentication with hardcoded user/password.

$user = 'admin';				// Username
$passwd = 'myP/-\SVV0Rds1nadD';	// Password

session_start();				// Start that session
if($_SESSION['pass'] !== $passwd){
	//Not logged in.
	if(!$_POST['submit']){
		print '<form action="" method="post">';
		print 'user: <input type="text" name="name" /><br/><br/>';
		print 'pass: <input type="password" name="password" /><br/><br/>';
		print '<input type="submit" name="submit" value="login" /><br/><br/>';
	}else{
		// If magic quotes is enabled it will ruin the entered password
		// with adding slashes to ' " /
		// So lets check for it and remove the slashes if present.
		if (get_magic_quotes_gpc()){
			$password = stripslashes($_POST['password']);
		}else{
			$password = $_POST['password'];
		}
		
		if($user === $_POST['name'] AND $password === $passwd){
			//Good login
			$_SESSION['pass'] = $passwd;		// Basic session auth.
			print 'Successfully logged in!';
			print '<meta http-equiv="refresh" content="3;URL=">'; // Refresh the current page.
		}else{
			print 'Wrong username or password [<a href="javascript:" onclick="history.go(-1); return false"> Back</a>]';
		}
	}
}else{
	// Put here anything you want to protect.
	print 'Welcome to protected space!';
}
?>