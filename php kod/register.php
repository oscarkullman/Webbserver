<form action='register.php' method='post'>
Username: <input type='text' name='username' size='30'><br>
Password: <input type='password' name='password' size='30'><br>
Confirm your password: <input type='password' name='password_conf' size='30'><br>
Email: <input type='text' name='email' size='30'><br>
<input type='submit' name='bt1' value='Register'>
</form>

<?php
if(isset($_POST['bt1'])){
	register();
}
else{
	echo "Du har ej tryckt på knappen";
}
function register(){
	//Connecting to database
	$connect = mysql_connect("localhost", "root", "eber");
	if(!$connect){
	
	die(mysql_error());
	}
	
	//Selecting database
	$select_db = mysql_select_db("Diary", $connect);
	if(!$select_db){
		die(mysql_error());
	}
	//Collecting info
	$username = $_POST['username'];
	$password = $_POST['password'];
	$pass_conf = $_POST['password_conf'];
	$email = $_POST['email'];

	//Here we will check do we have all inputs filled
	if(empty($username)){
	die("Please enter your username!<br>");

	}
	if(empty($password)){
	die("Please enter your password!<br>");
	}
	if(empty($pass_conf)){
	die("Please confirm your password!<br>");
	}
	if(empty($email)){
	die("Please enter your email!");
	}

	//Let's check if this username is already in use
	$user_check = mysql_query("SELECT username FROM users WHERE username='$username'");
	$do_user_check = mysql_num_rows($user_check);
	//Now if email is already in use
	$email_check = mysql_query("SELECT email FROM users WHERE email='$email'");
	$do_email_check = mysql_num_rows($email_check);

	//Now display errors
	if($do_user_check > 0){
	die("Username is already in use!<br>");
	}
	if($do_email_check > 0){
	die("Email is already in use!");
	}

	//Now let's check does passwords match
	if($password != $pass_conf){
	die("Passwords don't match!");
	}

	//If everything is okay let's register this user
	$insert = mysql_query("INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')");
	if(!$insert){
		die("There's little problem: ".mysql_error());
	}
	echo $username.", you are now registered. Thank you!<br><a href=login.php>Login</a> | <a href=index.php>Index</a>";
}

?> 
