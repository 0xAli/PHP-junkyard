<?php
session_start();
$mc = @mysql_connect('localhost','root','sample'); // Edit this
if(!$mc) exit('Can\'t connect to database server');

$dc = @mysql_select_db('sample');                  // Edit this
if(!$dc) exit('Can\'t select database');

if(!@$_SESSION['pass']){
	if(!@$_POST['submit']){
	    // Print the form.
		print '<form action="" method="post">';
		print 'user: <input type="text" name="name" /><br/><br/>';
		print 'pass: <input type="password" name="password" /><br/><br/>';
		print '<input type="submit" name="submit" value="login" /><br/><br/>';
	}else{
		if (get_magic_quotes_gpc()){
			$password = md5(stripslashes($_POST['password']));
		}else{
			$password = md5($_POST['password']);
		}
		$user = mysql_real_escape_string($_POST['name']); // Lets hope that's enough
		$q = mysql_query("SELECT * FROM `users` WHERE `username` = '$user' AND `password` = '$password';");
		$m = mysql_fetch_assoc($q);
		$user   = $m['username'];
		$passwd = $m['password'];
		if($user === $_POST['name'] AND $password === $passwd){
		    // Matching user and password combination.
			$_SESSION['pass'] = $passwd;
			print 'Successfully logged in!';
			print '<meta http-equiv="refresh" content="3;URL=">';
		}else{
		    // User/Pass combination is not correct.
			print 'Wrong username or password [<a href="javascript:" onclick="history.go(-1); return false"> Back</a>]';
		}
	}
}else{
	// It would be a good idea to check if $_SESSION['pass'] is (still) valid on every request..
 	
	print 'Welcome to protected space!';
}

/*
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
);
*/

?>
