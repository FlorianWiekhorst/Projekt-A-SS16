<?php 
session_start();
 
if(isset($_GET['login'])) 
  {
    	$email = $_POST['email'];
    	$passwort = $_POST['passwort'];
  	
  	//Überprüfung des Passworts
  	if ($user !== false && password_verify($passwort, $user['passwort'])) 
  	{
  	  	$_SESSION['userid'] = $user['id'];
  	  	die('Login erfolgreich. Weiter zu <a href="game.html">Asara Starten</a>');
  	} 
  	else 
  	{
  	  	$errorMessage = "E-Mail oder Passwort war ungültig<br>";
  	}
  }

?>
