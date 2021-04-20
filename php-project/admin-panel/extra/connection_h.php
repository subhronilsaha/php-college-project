<?php
ini_set('display_errors', 1);

$con = mysqli_connect('localhost', 'root', '', 'demo1');

@session_start(); // Start session for user

if(!isset($_SESSION['NAME'])) {
	// echo $_SESSION['NAME'];
	// Redirect to Login Page
	header("location: ../login.php");
}

?>