<?php
	if(!isset($_SESSION)) {
    	session_start();
	}
	if(!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] != true) {
		header('Location: ./login.php');
	}
	if(!isset($_SESSION['mitarbeiter']) || $_SESSION['mitarbeiter'] != true) {
		header('Location: ./login.php');
	}
	if(!isset($_SESSION['userid'])) {
		header('Location: ./login.php');
	}

	include('../utils/zugriff.inc');
	$meldung = null;
	$userid = $_SESSION['userid'];
	if(isset($_POST['users']) && isset($_POST['write_box'])) {
		if($_POST['users'] != "" || $_POST['write_box'] != "") {
			$sendtouserid = $_POST['users'];
			$messagetext = $_POST['write_box'];
			date_default_timezone_set("Europe/Berlin");
			$timestamp = time();
			try {
       			$connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $database);
        		$query = "INSERT INTO messagesystem VALUES(NULL, $sendtouserid, $userid, '$messagetext', $timestamp);";
        		$result = mysqli_query($connection, $query);
				mysqli_close($connection);
			} catch(exception $e) {
				echo "<p>$e</p>";
				$meldung = "Es ist ein Problem mit der Datenbank aufgetreten! $e";
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
	<title>Verwaltung</title>
	<link rel="stylesheet" href="../assets/css/navbar.css">
	<link rel="stylesheet" href="../assets/css/page.css">
	<link rel="stylesheet" href="../assets/css/verwaltung.css">
</head>
<body>
	<div id="page">
		<header>
			<?php include('../utils/navbar.php'); ?>
		</header>
		<div id="content">
			<div class="container" id="posteingang">
				<h1>Posteingang</h1>
				<div class="box" id="messages">
					<?php
						try {
       						$connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $database);
        					$query = "SELECT senderid, msgtext, unixtime FROM messagesystem WHERE ownerid=$userid;";
        					$result = mysqli_query($connection, $query);

        					while($datensatz = mysqli_fetch_array($result)) {
        						$senderid = $datensatz['senderid'];
								$text = $datensatz['msgtext'];
								$unixtime = $datensatz['unixtime'];
								$date = gmdate("d.M.Y", $unixtime);
								$time = gmdate("H:i", $unixtime);
								if($senderid != 0) {
									$query2 = "SELECT username FROM loginsystem WHERE id=$senderid;";
        							$result2 = mysqli_query($connection, $query2);
									$sendername = mysqli_fetch_assoc($result2)['username'];
									echo "<p>$sendername am $date um $time Uhr | $text</p>";
								} else {
									echo "<p>SYSTEM | $text</p>";
								}
        					}
							mysqli_close($connection);
						} catch(exception) {
							$meldung = "Es ist ein Problem mit der Datenbank aufgetreten!";
						}
						if($meldung != null) {
							echo "<p>$meldung</p>";
						}
					?>
				</div>
			</div>
			<div class="container" id="verfassen">
				<h1>Verfassen</h1>
				<div class="box" id="write">
					<form action="./verwaltung.php" method="POST" id="sendform">
						<label>Senden an:</label>
							<?php
								try {
        							$connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $database);
        							$query = "SELECT id, username FROM loginsystem;";
        							$result = mysqli_query($connection, $query);

									echo '<select name="users" id="users">';

        							while($row = mysqli_fetch_object($result)) {
        		    					$id = $row -> id;
										$username = $row -> username;
										if($username != $_SESSION['username']) {
											echo "<option class='optusr' value='$id'>$username</option>";
										}
        							}
									mysqli_close($connection);

									echo '</select>';
									echo '<input type="submit" id="sendebtn"/>';
								} catch(exception) {
									$meldung = "Es ist ein Problem mit der Datenbank aufgetreten!";
								}
								if($meldung != null) {
									echo "<p>$meldung</p>";
								}
							?>
					</form>
					<hr/>
					<textarea id="write_box" name="write_box" rows="4" cols="50" form="sendform">Schreibe eine Nachricht</textarea>
				</div>
			</div>
		</div>
	</div>
</body>
</html>