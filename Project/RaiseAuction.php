<?php
	$conn = mysqli_connect("localhost", "root", "", "snapbuy");
		
	if($conn === false){
		die("ERROR: Could not connect. " 
		. mysqli_connect_error());
	}
	
	$ProposedPrice = $_REQUEST['ProposedPrice'];
	$ID = $_REQUEST['ID'];
	$User = $_REQUEST['User'];
	$GetPrice = mysqli_query($conn,"SELECT Price From Auctions WHERE ID = '$ID'");
	$row = mysqli_fetch_array($GetPrice);
	
	
	if($row['Price'] < $ProposedPrice){
		$InsertUser = mysqli_query($conn,"UPDATE auctions SET User = '$User' WHERE ID='$ID'");
		$BidAuction = mysqli_query($conn,"UPDATE auctions SET price = '$ProposedPrice' WHERE ID = '$ID'");
		header('Location: ShowAuctions.php');
		
	}
	
          
        mysqli_close($conn);


?>