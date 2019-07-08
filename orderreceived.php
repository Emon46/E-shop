<?php
	include_once 'includes/dbh.inc.php';
	

?>


<?php
	include_once 'header.php';
?>
<?php
	//session_start();
	if(!isset($_SESSION['logged_in_username'])){
		header("Location: index.php?login=empty");
	}
?>	 
<div class="divider"> </div>
		
        <h1 style="text-align:center;padding-top:50px; padding-left:0px; color:#664B23"> Order has beed received by the supplier, kiddo!!!! </h1>

         	

		</div>
        <div style="margin-top:325px;">
		</div>



<?php
	include_once 'footer.php';
?>