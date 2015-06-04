<form action='index.php' method='post'>
Diary: <input type='text' name='dagbok' size='30'><br>
<input type='submit' name='bt1' value='Create'>
</form>
<?php


//This will start a session

session_start();


$username = $_SESSION['username'];

$password = $_SESSION['password'];


//Check do we have username and password

if(!$username && !$password){

echo "Welcome Guest! <br> <a href=login.php>Login</a> | <a href=register.php>Register</a>";

}else{

echo "Welcome ".$username." (<a href=logout.php>Logout</a>)";

}
if(isset($_POST['bt1'])){
	Create();
}

function Create(){
	$connect = mysql_connect("localhost", "root", "eber");
	if(!$connect){
	
	die(mysql_error());
	}


	//Selecting database
	$select_db = mysql_select_db("Diary", $connect);
	if(!$select_db){
		die(mysql_error());
	}
	$dagbok = $_POST['dagbok'];
	
	if(empty($dagbok)){
	die("Please enter the desired name for your diary!<br>");

	}
	$dagbok_check = mysql_query("SELECT dagbok FROM users WHERE dagbok='$dagbok'");
	$do_dagbok_check = mysql_num_rows($dagbok_check);
	
	if($do_dagbok_check > 0){
	$mydiary = fopen("$dagbok.txt", "r+");
	echo fread($mydiary,filesize("$dagbok.txt"));
	}
	else{
	$insert = mysql_query("INSERT INTO users (dagbok) VALUES ('$dagbok')");
	if(!$insert){
		die("There's little problem: ".mysql_error());
	}
}
}


?>	
