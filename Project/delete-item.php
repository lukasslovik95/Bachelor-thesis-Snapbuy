<?php
	$conn = mysqli_connect("localhost", "root", "", "snapbuy");
		
	if($conn === false){
		die("ERROR: Could not connect. " 
		. mysqli_connect_error());
	}
	$ID = $_REQUEST['ID'];
	
	$DeleteProduct = mysqli_query($conn,"Delete from buynow where ID = '$ID'");
	header('Location: index.php');
	mysqli_close($conn);

?>