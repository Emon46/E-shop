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
		header("Location: ../index.php?login=empty");
	    exit();
	}
	else {
		$sql="SELECT * FROM shopusers WHERE username='$username' OR email='$username';";
		$result=mysqli_query($connct, $sql);
		$resultCheck =mysqli_num_rows($result);
		if($resultCheck<1){
			header("Location: ../index.php?login=no_user_match");
	        exit();
		}
		else {
			if($row=mysqli_fetch_assoc($result)){
				
				$hashedpwdcheck=password_verify($pwd,$row['password']);
				if($hashedpwdcheck==false){
					header("Location: ../index.php?login=no_pass_match");
	        		exit();
				}
				elseif ($hashedpwdcheck==true) {
					//login the user here
					//print_r($row);
					$_SESSION['logged_in_usertype']=$row['usertype'];

					$_SESSION['logged_in_username']=$row['username'];
					$user=$row['username'];
					$_SESSION['logged_in_fullname']=$row['fullname'];
					$_SESSION['logged_in_email']=$row['email'];
					$_SESSION['logged_in_cardnumber']=$row['cardnumber'];
					//$userId=$_SESSION['logged_in_userid'];
					$result=mysqli_query($connct, $sql);
					if($_SESSION['logged_in_usertype']=='customer')header("Location: ../home.php?login_as_$user");
					if($_SESSION['logged_in_usertype']=='admin'){
						header("Location: ../admin.home.php?login_as_admin");
					}
					if($_SESSION['logged_in_usertype']=='supplier'){
						header("Location: ../supplier.home.php?login_as_supplier");
					}
	        		exit();

				}
			}

		}
	}

}
else {
	header("Location: ../index.php?login=error");
	exit();
}