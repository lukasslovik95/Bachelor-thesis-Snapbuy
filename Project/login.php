<?php

session_start();

if( isset($_SESSION['user_id']) ){
	header("Location: index.php");
}

$conn=new PDO('mysql:host=localhost;dbname=snapbuy;port=3306','root','');
  if (!$conn)
  {
    die('Could not connect: ' . mysql_error());
  }

if(!empty($_POST['email']) && !empty($_POST['password'])):
	
	$records = $conn->prepare('SELECT id,email,password FROM users WHERE email = :email');
	$records->bindParam(':email', $_POST['email']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message = '';

	if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){

		$_SESSION['user_id'] = $results['id'];
		header("Location: index.php");

	} else {
		$message = 'Wprowadziłeś złe dane';
		echo $message;
	}

endif;

?>