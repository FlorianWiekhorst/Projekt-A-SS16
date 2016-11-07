<!-- Register php form -->
<?php

if(!empty($_POST['send'])) {  //wenn button gedrückt
	if(!empty($_POST['name'])){
		$name = mysqli_real_escape_string($connection, $_POST['name']); //Username in Datenbank abspeichern mit Escape
		$query = "SELECT * FROM users WHERE name = '$name'"; 			//überprüfung aller eingaben innerhalb der Datenbank zu dem Namen
		$execQuery = mysqli_query($connection, $query);
		if(mysqli_num_rows($execQuery) == 0){							// Anzahl vorhandener Datensätze zurückgeben und auf 0 überprüfen
			$nameChecked = true;
		}else{
			echo "<p>Nutzername \"$name\" wird bereits verwendet!</p>";
		}
	}else{
		echo "<p>Sie haben keinen Nutzernamen angegeben!</p>";
	}
	
	if(!empty($POST['email'])){
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$query = "SELECT * FROM users WHERE email = '$email'";
		$execQuery = mysqli_query($connection, $query);
		if(mysqli_num_rows($execQuery) == 0){
			if(preg_match('/^[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+(?:\.[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+)*\@[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+(?:\.[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+)+$/i', $email)){
				$emailChecked = true;
			}else{
				echo "<p>Sie müssen eine gültige E-Mail-Adresse angeben!</p>";
			}
		}else{
			echo "<p>Es ist bereits ein Account unter der Emailadresse registriert!"
		}
	}else{
		echo "<p>Sie haben keine Emailadresse angegeben!"
	}
	
	if(!empty($_POST['password']) AND !empty($_POST(['password2'])){
		$password mysqli_real_escape_string($connection, $_POST['password']);
		$password2 = mysqli_real_escape_string($connection, $_POST['password2']);
		if(strlen($password) >= 6){ 										//Passwort soll min. 6 Zeichen lang sein
			$password = md5($password);	//simple verschlüsselung "md5"
			$password2 = md5($password2);
			if($password == $password2){
				$passwordChecked = true;
			}else{
				echo "<p>Die beiden angegebenen Passwörter sind nicht identisch!</p>";
			}
		}echo{
			echo "<p>Das angegebene Passwort ist zu kurz. Es muss min. 6 Zeichen lang sein!</p>";
		}
	}else{
		echo "<p>Sie haben kein Passwort angegeben oder das Passwort nicht wiederholt!</p>";
	}
	
	if(isset($nameChecked) AND isset($emailChecked) AND isset($passwordChecked)){ // Account erstellen wenn alle 3 werte gesetzt sind
		$query = "INSERT INTO users(name, email, password) VALUES('$name','$email',$password')";
		$execQuery = mysqli_query($connection, $query);
		if($execQuery){
			echo "<p>Vielen Dank für ihre Registrierung, $name!</p>";
		}else{
			echo "<br>".mysqli_error($connection);
		}
	}
}


echo "
	<form method='POST' action='index.php?form=register">
		<p><input type='text' name='name' placeholder='Benutzername'></p>
		<p><input type='email' name='email' placeholder='E-mail'></p>
		<p><input type='password' name='password' placeholder='Passwort'></p>
		<p><input type='password' name='password2' placeholder='Passwort wiederholen'></p>
		<p><input type='submit' name='send' value='Account anlegen'></p>
	</form>
	";
	
?>