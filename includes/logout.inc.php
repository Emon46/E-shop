<?php

if(isset($_POST['submit'])){
	session_start();
	include 'dbh.inc.php';
	$userId=$_SESSION['logged_in_userid'];
	//$sql="UPDATE Customers SET logged_in = 0 WHERE ID = '$userId';";
	//$result=mysqli_query($connct, $sql);
	session_unset();
	session_destroy();
	header("Location: ../index.php");
	exit();
}
?>