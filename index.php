<?php
session_start();
header("Content-Type: text/html; Charset=utf-8");

$host = 'localhost';
$user = 'root';
$password = 'hardcorepassword';
$db = 'asaradatenbank';

$connection = mysqli_connect($host, $user, $password);
if($connection){
	if(!mysqli_select_db($connection, $db))
		echo "<br>".mysqli_error($connection);
}else{
	echo "<br>".mysqli_error($connection);
}

if(!empty($_SESSION['userID'])){
	$userID = mysqli_real_escape_string($connection, $_SESSION['userID']);
	$query = "SELECT * FROM users WHERE id = '$userID'";
	$execQuery = mysqli_query($connection, $query);
	if(mysqli_num_rows($execQuery) != 0){
		$userData = mysqli_fetch_array($execQuery);
		echo "<h1>Herzlich Willkommen, ".$userData['name']."</h1>";
	}
}

echo "
	<p>
	<a href='index.php?form=register'>Registrieren</a>
	<a href='index.php?form=login'>Einloggen</a>
	</p>
	";

if(empty($_GET['form']) OR !empty($_GET['form']) AND $_GET['form'] == "register"){
	//Registrierungs-Formular
	include("register.php");
}else if(!empty($_GET['form']) AND $_GET['form'] == "login"){
	//Login-Formular
	include("login.php");
}

?>

<html lang="de">
	<head>
		<meta name="description" content="Simple WebGame">
		<meta name="author" content="Florian Wiekhorst">
		<meta charset="UTF-8">	
		<title>Asara Hauptmenue</title>
		<link href="CSS/index.css" rel="stylesheet"/>
	</head>
	
	<body> 
			
	
	
			<?php include("Gruppen_de/Startseite.php")?>
	</body>
	
</html>



	

<!--
===================================
=== Feedback Alpers, 2016-06-13 ===
===================================
Die folgende Nummerierung habe ich eingefügt, damit es später leichter ist, sich auf eine bestimmte Anmerkung zu beziehen.
(1) Leider haben Sie etwas wichtiges übersehen: In diesem Semester ist JavaScript nicht für das Projekt zugelassen. Wenn Sie HTML dynamisch erzeugen wollen, nutzen Sie dafür bitte PHP.
(2) Sie sollten ebenfalls keine Frameworks und andere Erweiterungen nutzen. Darunter fallen die Google Fonts.
(3) Bitte streichen Sie auch die Verwendung von width/height, wenn Sie hier nicht zuvor die Auflösung des beim Nutzer verwendeten Displays in die Skalierung einbezogen haben. (Stichwort Responsive Design)
(4) Bitte nutzen Sie keine Container wie <i>, <u> usw., sondern definieren Sie jegliches Design über Einstellungen in einem CSS-Dokument.
(5) Bei der Verwendung des <header>-Containers ist Ihnen ein Fehler unterlaufen, der bei der Anzeige in einem aktuellen Browser nicht auffallen würde. (Stichwort: Verwendung des <section>-Containers)
(6) Die id-Attribute sind leider nicht gut bezeichnet: "Fenster ..." sagte leider nichts darüber aus, was für ein Element hier näher definiert wird. Das macht es für Designer schwierig, im CSS-Dokument die jeweils zugehörigen Design-Vorgaben zu programmieren. Bitte ändern Sie das so ab, dass der Zusammenhang am Namen erkennbar ist.
(7) In HTML5 soll es zu jedem audio-visuellen Container mindestens einen <figure>- und einen <figcaption>-Container geben. Die fehlen hier leider.
(8) Bitte lagern Sie CSS-Dokumente in ein eigenes Verzeichnis aus und passen Sie die src-Attribute entsprechend an.
(9) Bitte nutzen Sie systematisch Einrückungen, damit auf den ersten Blick erkennbar ist, welche Container sich in welcher hierarchischen Anordnung befinden.
(10) Bitte nutzen Sie <div>-Container dann und nur dann, wenn es keine sinnvolle Alternative gibt. Hier gäbe es eine.
(11) Nur zur Sicherheit folgende Anmerkung (nicht wertungsrelevant): Stellen Sie bitte sicher, dass es sich bei allen verwendeten audio-visuellen Medien um Ihr geistiges Eigentum bzw. um frei verwendbare Elemente handelt. Wenn Sie letztere verwenden sollten Sie eine entsprechende Anmerkung erstellen.
Wertung 6: HTML: n / 10 (kein Wertung, siehe unten)
- Umsetzung von 10 strukt. Elem (ohne Wiederholung): 0 (da die Aufstellung der strukt. Elem. noch fehlt.)
- Sinnvolle Ausgliederung einer Gruppe: 0 (da die Aufstellung der strukt. Elem. noch fehlt.)
- Repetitive Gruppen: ab drei Gruppen: 0 (da die Aufstellung der strukt. Elem. noch fehlt.)
- Verwendung von HTML 4.01: -1 
Abschließend noch eine Anmerkung: Wenn Sie die aktuellen Wertungen addieren, ergibt sich nur ein sehr kleiner Wert, aber das liegt einzig daran, dass ich zurzeit nicht klar erkennen kann, wie systematisch Sie vorgegangen sind. Der aktuelle Stand wird also mit einem Wert zwischen 10 und 40 Punkten bewertet werden, wenn Sie das Feedback umsetzen.
-->
