<?php

try{
	$conn = new PDO('mysql:host=localhost;dbname=snapbuy;port=3306','root','');
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}
?>