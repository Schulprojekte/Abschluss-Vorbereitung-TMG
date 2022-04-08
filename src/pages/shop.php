<?php
	if(!isset($_SESSION)) {
    	session_start();
	}
	if(!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] != true ) {
		header('Location: ./login.php');
	}
?>
<!DOCTYPE html>
<html lang="de">

<head>
	<meta charset="UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Shop</title>
	<link rel="stylesheet" href="../assets/css/navbar.css"/>
	<link rel="stylesheet" href="../assets/css/page.css"/>
	<link rel="stylesheet" href="../assets/css/shop.css"/>
	<script src="../assets/js/order.js"></script>
</head>

<body>
	<div id="page">
		<header>
			<?php include('../utils/navbar.php'); ?>
		</header>
		<div id="content">
			<div id="articles">
				<?php
					$meldung = null;
					try {
						include('../utils/zugriff.inc');
        				$connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $database);
        				$query = "SELECT id, name, description, price, img FROM articles;";
        				$result = mysqli_query($connection, $query);

        				while($datensatz = mysqli_fetch_object($result)) {
        		    		$id = $datensatz -> id;
							$name = $datensatz -> name;
							$description = $datensatz -> description;
							$price = $datensatz -> price;
							$img = $datensatz -> img;
							
							echo
							'
								<article>
									<h1>'.$name.'</h1>
									<br/>
									<img src="../assets/img/'.$img.'" alt="Buch">
									<br/>
									<p>'.$description.'</p>
									<br/>
									<div class="order_div">
										<p class="price">Preis: '.$price.'€</p>
										<button onclick="order('.$id.')">Buy</button>
									</div>
								</article>
							';
        				}
						mysqli_close($connection);
					} catch (exception) {
						$meldung = "Es ist ein Problem mit der Datenbank aufgetreten!";
					}
					if($meldung != null) {
						echo'<h3 id="meldung">'.$meldung.'</h3>';
					}
				?>
			</div>
		</div>
	</div>
</body>

</html>