<?php
	if(!isset($_SESSION)) {
    	session_start();
	}
	$meldung = null;
	if(isset($_POST['username']) && isset($_POST['password'])) {
		if($_POST['username'] == "" || $_POST['password'] == "") {
			$meldung = "Bitte gib das Passwort und den Benutzernamen ein!";
		} else {
			try {
				$user = $_POST['username'];
				$password = $_POST['password'];
				include('../utils/zugriff.inc');
        		$connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $database);
        		$query = "SELECT id, pwhash, mitarbeiter FROM loginsystem WHERE username='$user';";
        		$result = mysqli_query($connection, $query);

        		while($datensatz = mysqli_fetch_object($result)) {
					$userid = $datensatz -> id;
        		    $pwhash = $datensatz -> pwhash;
					$mitarbeiter = $datensatz -> mitarbeiter;

					$inputhash = hash('sha256', $password);
					if($inputhash == $pwhash) {
						$_SESSION['logged-in'] = true;
						$_SESSION['username'] = $user;
						$_SESSION['userid'] = $userid;

						switch($mitarbeiter):
							case '0':
								$_SESSION['mitarbeiter'] = false;
								break;
							case '1':
								$_SESSION['mitarbeiter'] = true;
								break;
							default:
								$meldung = "Es ist ein Fehler bei der Datenverarbeitung aufgetreten!";
						endswitch;
						
						header('Location: ./index.php');
					} else {
						$meldung = "Falsches Passwort";
					}
        		}
				mysqli_close($connection);
			} catch (exception) {
				$meldung = "Es ist ein Problem mit der Datenbank aufgetreten!";
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="de">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	<link rel="stylesheet" href="../assets/css/navbar.css">
	<link rel="stylesheet" href="../assets/css/page.css">
	<link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
	<div id="page">
		<header>
			<?php include('../utils/navbar.php'); ?>
		</header>
		<div id="content">
			<div id="logindiv">
				<h1 id="heading">Login</h1>
				<form id="loginform" action="" method="POST">
					<input name="username" class="field" placeholder="Username" type="text"/>
					<input name="password" class="field" placeholder="Passwort" type="password"/>
					<input id="submit_button" type="submit"/>
					<?php
						if($meldung != null) {
							echo'<h3 id="meldung">'.$meldung.'</h3>';
						}
					?>
				</form>
			</div>
		</div>
	</div>
</body>

</html>