<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<?php
	
		$conn = mysqli_connect("localhost", "root", "", "snapbuy");
		
		if($conn === false){
            die("ERROR: Could not connect. " 
                . mysqli_connect_error());
        }
		
		
		$Producer = $_REQUEST['Producer'];
		$Application = $_REQUEST['Application'];
		$Color = $_REQUEST['Color'];
		$Cpu = $_REQUEST['Cpu'];
		$HDD = $_REQUEST['HDD'];
		$SSD = $_REQUEST['SSD'];
		$ScreenDiagonal = $_REQUEST['ScreenDiagonal'];
		$Resolution = $_REQUEST['Resolution'];
		$ScreenFrequency = $_REQUEST['ScreenFrequency'];
		$MatrixType = $_REQUEST['MatrixType'];
		$RAM = $_REQUEST['RAM'];
		$RamType = $_REQUEST['RamType'];
		$NetworkCard = $_REQUEST['NetworkCard'];
		$Bluetooth = $_REQUEST['Bluetooth'];
		$Height = $_REQUEST['Height'];
		$Width = $_REQUEST['Width'];
		$Depth = $_REQUEST['Depth'];
		$Weight = $_REQUEST['Weight'];
		$Data = $_REQUEST['Data'];
		$Price = $_REQUEST['Price'];
		$Description = $_REQUEST['Description'];		
		$Image1 = addslashes(file_get_contents($_FILES['Image1']['tmp_name']));
		$Image2 = addslashes(file_get_contents($_FILES['Image2']['tmp_name']));
		$Image3 = addslashes(file_get_contents($_FILES['Image3']['tmp_name']));
		$Image4 = addslashes(file_get_contents($_FILES['Image4']['tmp_name']));
		$Image5 = addslashes(file_get_contents($_FILES['Image5']['tmp_name']));
		$Image6 = addslashes(file_get_contents($_FILES['Image6']['tmp_name']));
		$Image7 = addslashes(file_get_contents($_FILES['Image7']['tmp_name']));
		$Image8 = addslashes(file_get_contents($_FILES['Image8']['tmp_name']));
		
		if (isset($_POST['Aukcja'])){
			$InsertAuction = "INSERT INTO auctions(Producer, Application, Color, Cpu, HDD, SSD, ScreenDiagonal, Resolution, ScreenFrequency, MatrixType, RAM, RamType, NetworkCard, Bluetooth, Height, Width, Depth, Weight, Data, Price, Description, Image1, Image2, Image3, Image4, Image5, Image6, Image7, Image8) VALUES ('$Producer','$Application','$Color','$Cpu','$HDD','$SSD','$ScreenDiagonal','$Resolution','$ScreenFrequency','$MatrixType','$RAM','$RamType','$NetworkCard','$Bluetooth','$Height','$Width','$Depth','$Weight','$Data','$Price','$Description', '$Image1', '$Image2', '$Image3', '$Image4', '$Image5', '$Image6', '$Image7', '$Image8')";
			if(mysqli_query($conn, $InsertAuction)){
				header('Location: index.php');
				echo "Poprawnie dodano predmiot na aukcje"; 
			} else{
				header('Location: index.php');
				echo "Coś poszło nie tak" 
                . mysqli_error($conn);
			}
		}else
			
		$InsertBuynow = "INSERT INTO buynow(Producer, Application, Color, Cpu, HDD, SSD, ScreenDiagonal, Resolution, ScreenFrequency, MatrixType, RAM, RamType, NetworkCard, Bluetooth, Height, Width, Depth, Weight, Data, Price, Description, Image1, Image2, Image3, Image4, Image5, Image6, Image7, Image8) VALUES ('$Producer','$Application','$Color','$Cpu','$HDD','$SSD','$ScreenDiagonal','$Resolution','$ScreenFrequency','$MatrixType','$RAM','$RamType','$NetworkCard','$Bluetooth','$Height','$Width','$Depth','$Weight','$Data','$Price','$Description','$Image1','$Image2','$Image3','$Image4','$Image5','$Image6','$Image7','$Image8')";
			if(mysqli_query($conn, $InsertBuynow)){
				header('Location: index.php');
				echo "Poprawnie dodano predmiot na aukcje"; 
			} else{
				header('Location: index.php');
				echo "Coś poszło nie tak" 
                . mysqli_error($conn);
			}	
          
        mysqli_close($conn);
		
	?>

</body>
</html>