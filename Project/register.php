<?php

session_start();

if( isset($_SESSION['user_id']) ){
	header('Location: index.php');
}

require 'database.php';


$conn2 = mysqli_connect("localhost", "root", "", "snapbuy");

	if($conn2 === false){
		die("ERROR: Could not connect. "
		. mysqli_connect_error());
	}

$CheckEmail = mysqli_query($conn2, "SELECT `email` FROM `users` WHERE `email` = '".$_POST['email']."'");

if(mysqli_num_rows($CheckEmail)){
	exit('Użytkownik o takiej nazwie email posiada już konto na tej stronie.');
}else

if(!empty($_POST['email']) && !empty($_POST['password'])):


	$InsertUser = "INSERT INTO users (email, password) VALUES (:email, :password)";
	$prep = $conn->prepare($InsertUser);

	$prep->bindParam(':email', $_POST['email']);
	$prep->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));

	if( $prep->execute() ):
		$message = 'Poprawnie dodano użytkownika';
		header('Location: index.php');
	else:
		$message = 'Error';
	endif;

endif;


?>

<?php if(!empty($message)): ?>
	<p><?= $message ?></p>
<?php endif; ?>
