<?php
	try {
		$meldung = null;
		$id = $_GET['id'];
		include('./zugriff.inc');
        $connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $database);
        $query = "SELECT name, description, price, img FROM articles WHERE id=$id;";
        $result = mysqli_query($connection, $query);

        while($datensatz = mysqli_fetch_object($result)) {
			$name = $datensatz -> name;
			$description = $datensatz -> description;
			$price = $datensatz -> price;
			$img = $datensatz -> img;
			date_default_timezone_set("Europe/Berlin");
			$timestamp = time();
			$datum = date("d.m.Y", $timestamp);
			$uhrzeit = date("H:i", $timestamp);
			$file = "../orders/orders.txt";
			$content = file_get_contents($file);
			$content = "Es ist eine Bestellung eingegangen: ID: $id, Artikelname: $name für $price"."€ Datum: $datum | $uhrzeit\n";
			file_put_contents($file, $content);
        }

		$query = "SELECT id FROM loginsystem WHERE article=$id;";
        $result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
			$itemmanager = $row['id'];
			date_default_timezone_set("Europe/Berlin");
			$timestamp = time();
			$query = "INSERT INTO messagesystem VALUES(NULL, $itemmanager, 0, '$content', $timestamp)";
			mysqli_query($connection, $query);
		}

		mysqli_close($connection);
		header('Location: ../pages/shop.php');
	} catch (exception $e) {
		$meldung = "Es ist ein Problem mit der Datenbank aufgetreten!";
	}
?>