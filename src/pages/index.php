<?php
	if(!isset($_SESSION)) {
    	session_start();
	}

	include('../utils/zugriff.inc');

	$besucherzahl = null;
	$gesamtUser = null;
	$registeredUsers = null;
	$meldung = null;

	try {
		$conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $database);
    	$query = 'SELECT COUNT(id) AS registered FROM loginsystem;';
    	$result = mysqli_query($conn, $query);

    	$row = mysqli_fetch_assoc($result);
    	mysqli_close($conn);

    	$registeredUsers = $row['registered'];
	} catch (exception) {
		$meldung = "Es ist ein Problem mit der Datenbank aufgetreten!";
	}

	try {
    	$conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $database);
    	$query = 'SELECT besucherzahl FROM besucher;';
    	$result = mysqli_query($conn, $query);

    	$row = mysqli_fetch_assoc($result);
    	mysqli_close($conn);

    	$besucherzahl = $row['besucherzahl'];

    	if(!isset($_COOKIE['besucher'])) {
   		    setcookie('besucher', true);
    	    $conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $database);
    	    $query = "UPDATE besucher SET besucherzahl = besucherzahl + 1;";
    	    mysqli_query($conn, $query);
    		mysqli_close($conn);
			$besucherzahl = $besucherzahl + 1;
    	}
	} catch (exception) {
		$meldung = "Es ist ein Problem mit der Datenbank aufgetreten!";
	}

	$gesamtUser = $besucherzahl + $registeredUsers;
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Herzlich Willkommen</title>
	<link rel="stylesheet" href="../assets/css/navbar.css"/>
	<link rel="stylesheet" href="../assets/css/page.css"/>
	<link rel="stylesheet" href="../assets/css/index.css"/>
</head>
<body>
	<div id="page">
		<header>
			<?php include('../utils/navbar.php'); ?>
		</header>
		<div id="content">
			<?php
				if(isset($_SESSION['logged-in'])) {
					if($_SESSION['logged-in'] == true && isset($_SESSION['username'])) {
						$user = $_SESSION['username'];
						echo "<h1 id='heading'>Willkommen zurück, $user!</h1>";
					}
				} else {
					echo "<h1 id='heading'>Herzlich Willkommen, Gast!</h1>";
				}
				if($gesamtUser != null && $registeredUsers != null) {
					echo '<br/>';
					echo "<h2>Diese Seite hat insgesamt $gesamtUser Besucher.";
					echo "<h2>Von diesen sind $registeredUsers Personen registriert.";
				} else {
					if($meldung != null) {
						echo "<p>$meldung</p>";
					} else {
						echo "<p>Es ist ein unbekannter Fehler aufgetreten!</p>";
					}
				}
			?>
			
		</div>
	</div>
</body>
</html>