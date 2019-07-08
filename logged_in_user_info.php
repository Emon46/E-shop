<?php
	include_once 'includes/dbh.inc.php';
	

?>

<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>CSE Socity</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
        <nav>

			<h1>CSE SOCIETY</h1>
			<div class="main-wrapper">
				<ul>
					<li><a href="adminhome.php">Home </a></li>
					<li><a href="logged_in_user_info.php">loggedInUser</a></li>
					<li><a href="adminhome.php">Notice</a></li>
					<?php if(isset($_SESSION['logged_in_adminname'])){
						echo '<li><a href="election.php">Election</a></li>';
					} ?>

				</ul
			</div>
			<div class="nav-login">		
				<?php
					if(isset($_SESSION['logged_in_adminname'])){
						echo '<a href="#" style="font-size:14px;padding-right:10px; padding-left:0px;text-align:left;">'. $_SESSION['logged_in_adminname'] .' </a>';
						echo '<form action="includes/adminlogout.inc.php" method="POST">';

						echo '<button type="submit" name="submit">Logout</button>
						</form>';
					}
					else {
						echo '<form action="includes/adminlogin.inc.php" method="POST">
							<input type="text" name="username" placeholder="username">
							<input type="password" name="pwd" placeholder="password">
							<button type="submit" name="submit">login</button>
						</form> ';
					}
				?>
			</div>
		</nav>
	</header>
		<div class="divider"> </div>


		
        <h1 style="text-align:center; padding-left:0px; color:#664B23"> logged in UserName's</h1>

        <?php 
			$sql="SELECT * from customers where logged_in=1 ; ";
			$result = mysqli_query($connct,$sql);//this will excute the query
			$resultCheck =mysqli_num_rows($result);
		?>
		<div class="showposts">
			<?php
			if($resultCheck<1){
				echo '<div class="posttitle"> ' ."no user is logged in currently" . '</div>';
			}
			    while($row=mysqli_fetch_array($result)){
			
			    	echo '<div class="singlepost">';
						echo '<div class="posttitle"> Name: ' . $row['user_name'] . '</div>';
						//echo '<div class="postusername">Candidad for : Vice President</div>';
						//echo '<div class="postusername">Total amount of vote for :' . $rowvote['vote_count_for_president'].'</div>';
						
			        	echo '</div>';
				    } 

		    ?> 	
		</div>

<div style="margin-top:350px;">
		</div>

<?php
	include_once 'footer.php';
?>