<?php
	$conn = mysqli_connect("localhost", "root", "", "snapbuy");
		
	if($conn === false){
		die("ERROR: Could not connect. " 
		. mysqli_connect_error());
	}
	
	
	$ID = $_REQUEST['ID'];
	$User = $_REQUEST['User'];	
	
	$BuyProduct = mysqli_query($conn, "UPDATE buynow SET User = '$User' WHERE ID='$ID'");
	$End = mysqli_query($conn, "UPDATE buynow SET End = 'Yes' WHERE ID='$ID'");
	header('Location: kup-teraz.php');
    
	
    mysqli_close($conn);


?>