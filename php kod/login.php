<form action='?act=login' method='post'>
Username: <input type='text' name='username' size='30'><br>
Password: <input type='password' name='password' size='30'><br>
<input type='submit' name="bt1" value='Login'>
</form>

<?php
if(isset($_POST['bt1'])){
	login();
}
else {
	echo "Logga in, tack.";
}

//This function will find and checks if your data is correct
function login(){
	session_start();
	//Collect your info from login form
	$username = $_POST['username'];
	$password = $_POST['password'];
	$connect = mysql_connect('localhost','root','eber');

	//Output any connection error
	if (!$connect){
		die('Not connected: '.mysql_error());
	}
	$db_selected = mysql_select_db('Diary',$connect);
	if(!$db_selected){
		die('Can\'t use Diary: '.mysql_error());
	}
	
	//Find if entered data is correct
	$result = mysql_query("SELECT * FROM users WHERE username='$username' AND password='$password'");
	$row = mysql_fetch_array($result);
	$id = $row['id'];
	$select_user = mysql_query("SELECT * FROM users WHERE id='$id'");
	$row2 = mysql_fetch_array($select_user);
	$user = $row2['username'];
	if($username != $user){
	die("Username is wrong!");
}

$pass_check = mysql_query("SELECT * FROM users WHERE username='$username' AND id='$id'");
$row3 = mysql_fetch_array($pass_check);
$email = $row3['email'];
$select_pass = mysql_query("SELECT * FROM users WHERE username='$username' AND id='$id' AND email='$email'");
$row4 = mysql_fetch_array($select_pass);
$real_password = $row4['password'];

if($password != $real_password){
die("Your password is wrong!");
}

//Now if everything is correct let's finish his/her/its login
$_SESSION['username'] = mysql_real_escape_string($username);
$_SESSION['password'] = $password;

echo "Welcome, ".$username." please continue on our <a href=index.php>Index</a>";
}

?> 
