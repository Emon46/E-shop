<?php
if (isset($_POST['submit'])) {
	include_once 'dbh.inc.php';
	$fullname=mysqli_real_escape_string($connct,$_POST['fullname']);

	$email=mysqli_real_escape_string($connct,$_POST['email']);

	$username=mysqli_real_escape_string($connct,$_POST['username']);

	$cardnumber=mysqli_real_escape_string($connct,$_POST['cardnumber']);

	$password=mysqli_real_escape_string($connct,$_POST['password']);

	$re_password=mysqli_real_escape_string($connct,$_POST['re_password']);
	//Error handlers
	//check for empty fields
	if(empty($fullname)||empty($email)||empty($username)||empty($cardnumber)||empty($password)||empty($re_password)||($password!=$re_password)){
		header("Location: ../index.php?signup=empty");
		exit();
	}
	else {
		//check if input is valid
		if(!preg_match("/^[a-zA-Z]*$/", $firstname)|| !preg_match("/^[a-zA-Z]*$/", $lastname)){
			header("Location: ../index.php?index=invalid");
			exit();
		}
		else{
			//check is email is valid
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				header("Location: ../index.php?signup=invalidemail");
				exit();
			}
			else{
				$sql="SELECT * FROM shopusers WHERE username='$username'";
				$result=mysqli_query($connct, $sql);
				$resultCheck =mysqli_num_rows($result);
				if ($resultCheck>0) {
					header("Location: ../index.php?signup=already_exist_username");
					exit();
				}
				else {
					//hashing passwrd
					$hashedpwd=password_hash($password,PASSWORD_DEFAULT);
					$customer='customer';
					//insert in datatable
					$sql="INSERT INTO shopusers (fullname,email,username,cardnumber,password,usertype) values ('$fullname','$email','$username','$cardnumber','$hashedpwd','$customer');";
					mysqli_query($connct,$sql);
					header("Location: ../home.php?signup=$username");
					exit();
				}
			}
		}
	}
}
else {
	header("Location: ../index.php");
	exit();
}
?>