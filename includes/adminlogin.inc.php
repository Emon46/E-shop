<?php
session_start();

if(isset($_POST['submit']))
{
	include 'dbh.inc.php';

	$username=mysqli_real_escape_string($connct,$_POST['username']);
	$pwd=mysqli_real_escape_string($connct,$_POST['pwd']);
	//error handlers

	//check if input are empty
	if(empty($username)||empty($pwd)){
		header("Location: ../adminlogin.php?login=empty");
	    exit();
	}
	else {
		$sql="SELECT * FROM admin WHERE username='$username' OR email='$username';";
		$result=mysqli_query($connct, $sql);
		$resultCheck =mysqli_num_rows($result);
		if($resultCheck<1){
			header("Location: ../adminlogin.php?login=kook");
	        exit();
		}
		else {
			if($row=mysqli_fetch_assoc($result)){
				//dehashing pass
				//$pwd=$row['password'];
				if($pwd!=$row['password']){
					header("Location: ../adminlogin.php?login=no_pass_match");
	        		exit();
				}
				elseif ($pwd=$row['password']) {
					//login the user here

					$_SESSION['logged_in_adminid']=$row['id'];
					$_SESSION['logged_in_adminname']=$row['username'];
					$_SESSION['logged_in_email']=$row['email'];
					header("Location: ../adminhome.php?login_as_admin");
	        		exit();

				}
			}

		}
	}

}
else {
	header("Location: ../adminlogin.php?login=error");
	exit();
}