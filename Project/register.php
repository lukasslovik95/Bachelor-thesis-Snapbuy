<?php

session_start();

if( isset($_SESSION['user_id']) ){
	header('Location: index.php');
}

require 'database.php';


$conn2 = mysqli_connect("localhost", "root", "", "snapbuy");

	if($conn2 === false){
		die("ERROR: Could not connect."
		. mysqli_connect_error());
	}

$CheckEmail = mysqli_query($conn2, "SELECT `email` FROM `users` WHERE `email` = '".$_POST['email']."'");
$CheckName = mysqli_query($conn2, "SELECT `name` FROM `users` WHERE `name` = '".$_POST['name']."'");
$status = "Aktywny(a)";

if(mysqli_num_rows($CheckEmail)){
	exit('Użytkownik o takiej nazwie email posiada już konto na tej stronie.');
}elseif(mysqli_num_rows($CheckName)) {
    exit('Użytkownik o takim loginie posiada już konto na tej stronie.');
} else

if(!empty($_POST['email']) && !empty($_POST['name']) && !empty($_POST['password'])):


	$InsertUser = "INSERT INTO users (email, name, unique_id, password, status) VALUES (:email, :name, :unique_id, :password, :status)";
	$prep = $conn->prepare($InsertUser);

	$prep->bindParam(':email', $_POST['email']);
    $prep->bindParam(':name', $_POST['name']);
    $prep->bindParam(':unique_id', $_POST['unique_id']);
	$prep->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));
    $prep->bindParam(':status', $status);

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
