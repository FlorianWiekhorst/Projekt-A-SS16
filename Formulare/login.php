<?php
/* login.php */

if(!empty($_POST['send'])){
	if(!empty($_POST['email']) AND !empty($_POST['password'])){
		$email = mysqli_real_escape_string($conncetion, $_POST['email']);
		$password = mysqli_real_escape_string($connection, $_POST['password']);
		$password = md5($password);
		$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
		$execQuery = mysqli_query($connection, $query);
		if(mysqli_num_rows($execQuery) !=0){ //Prüft ob der Account vorhanden ist
			$userData = mysqli_fetch_array($execQuery);
			$_SESSION['userID'] = $userData['id'];	// id ist primärschlüssel der Datenbank
			echo "<p>Sie wurden erfolgreich eingeloggt, ".$userData['name']."!</p>";
		}else{
			echo "<p>Die eingegebenen Daten sind nicht korrekt!</p>";
		}
	}else{
		echo "<p>Sie haben das Formular nicht korrekt ausgefüllt!</p>";
	}
}

echo "
	<form method='POST' action='index.php?form=login'>
		<p><input type='email' name='email' placeholder='E-Mail-Adresse'></p>
		<p><input type='password' name='password' placeholder='Passwort'></p>
		<p><input type='submit' name='send' value='Einloggen'></p>
	</form>
";

?>