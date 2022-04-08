<?php
	if(!isset($_SESSION)) {
    	session_start();
	}
?>
<div id="header_div">
	<div id="logo">BKN</div>
	<div id="navbar">
		<a class="nav_item" href="./index.php">Home</a>
		<a class="nav_item" href="./shop.php">Shop</a>
		<?php
			if(isset($_SESSION['logged-in']) && $_SESSION['logged-in'] == true) {
				if(isset($_SESSION['mitarbeiter']) && $_SESSION['mitarbeiter'] == true) {
					echo '<a class="nav_item" href="./verwaltung.php">Verwaltung</a>';
				}
				echo '<a class="nav_item" href="./logout.php">Logout</a>';
			} else {
				echo'<a class="nav_item" href="./login.php">Login</a>';
			}
		?>
	</div>
</div>