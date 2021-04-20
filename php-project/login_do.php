<?php
ini_set('display_errors', 1);
$con = mysqli_connect('localhost', 'root', '', 'demo1');

if (isset($_REQUEST['signup'])) {
	
	echo "Signing up";

	$query = "INSERT INTO admin SET name ='" . $_REQUEST['name'] . "', email = '" . $_REQUEST['email'] . "', password = '" . $_REQUEST['password'] . "', status = 'active'";
	echo $query;
	$result = mysqli_query($con, $query);
	
	$query1 = "SELECT * FROM admin WHERE email = '" . $_REQUEST['email'] . "' and password = '" . $_REQUEST['password'] . "' and status = 'active'";
	$result1 = mysqli_query($con, $query1);
	
	$count = mysqli_num_rows($result1); // Count number of rows in result
	echo $count;
	
	if($count == 0) {
		header("location: signup.php");
	}
	
	$fetch = mysqli_fetch_object($result1);
	echo $fetch->email;

	if ($count > 0) {
		@session_start();
		$_SESSION['AID'] = $fetch->id; // AID = Admin ID
		$_SESSION['NAME'] = $fetch->name;
		$_SESSION['EMAIL'] = $fetch->email;
		header("location: admin-panel/index.php");
	}

}

if (isset($_REQUEST['login'])) {
	
	$query = "SELECT * FROM admin WHERE email = '" . $_REQUEST['email'] . "' and password = '" . $_REQUEST['password'] . "' and status = 'active'";
	$result = mysqli_query($con, $query);
	$count = mysqli_num_rows($result); // Count number of rows in result
	echo $count;
	if($count == 0) {
		header("location: login.php?invalid=true");
	}
	$fetch = mysqli_fetch_object($result);
	echo $fetch->email;

	if ($count > 0) {
		@session_start();
		$_SESSION['AID'] = $fetch->id; // AID = Admin ID
		$_SESSION['NAME'] = $fetch->name;
		$_SESSION['EMAIL'] = $fetch->email;
		header("location: admin-panel/index.php");
	}

}

if (isset($_REQUEST['logout'])) {
	session_start();
	session_destroy(); // Stop session for user
	header("location: login.php"); // Redirect to Login Page
}

?>