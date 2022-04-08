<?php
	if(!isset($_SESSION)) {
    	session_start();
	}
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Already logged out!</title>
	<link rel="stylesheet" href="../assets/css/navbar.css">
	<link rel="stylesheet" href="../assets/css/page.css">
</head>
<style>
	#content {
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
	}
	
	h1 {
		filter: drop-shadow(0 0 0.75rem grey);
	}

	h2 {
		filter: drop-shadow(0 0 0.75rem grey);
	}
</style>
<body>
	<div id="page">
		<header>
			<?php include('../utils/navbar.php'); ?>
		</header>
		<div id="content">
			<h1>Du bist bereits abgemeldet!</h1>
			<h2>Leite weiter zu Home...</h2>
		</div>
	</div>
</body>
</html>
<script>
	function sleep(ms) {
    	return new Promise(resolve => setTimeout(resolve, ms));
	}

	async function redirect() {
		await sleep(2000).then(() => {
		window.location = './index.php';
		});
	}
	
	redirect();
</script>