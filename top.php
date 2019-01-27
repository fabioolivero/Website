<!DOCTYPE html>
<head>
	<!-- 
	Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
	Questa pagina contiene l'intestazione di ogni pagina. Al suo interno sono presenti
	la barra di navigazione e la barra di ricerca.
	-->
	
	<title>DropShop</title>
	<script src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.0.0/prototype.js"></script>
	<link href="css/common.css" type="text/css" rel="stylesheet">
	<link href="css/index.css" type="text/css" rel="stylesheet">
	<link rel="icon" href="img/favicon.ico" />
</head>

<body>

	<div id="topbar">
		<div id="toptext">
			<a href="index.php"><img id="logoimg" src="img/logo.png" alt="logo"></a>
		</div>
		<?php
		#Mostra nome utente e quantità elementi nel carrello
		include("common.php");
		if (isset($_SESSION["name"])) { 
			$cart_counter = 0;
			if (isset($_COOKIE["cart"])) {
				$cart = $_COOKIE["cart"];
				$array = json_decode($cart);
				foreach($array as $elem)
					$cart_counter = $cart_counter + $elem[1];
			}?>
			<div id="logout">
				<a href="profile.php"><span class="white"><?= $_SESSION["name"]?></span></a> |
				<a href="loginLogout.php"><span class="white">Logout</span></a> |
				<a href="cart.php"><span class="white">Carrello (<span id=cartc><?=$cart_counter?></span>)</span></a>
			</div>
			<?php } ?>
		</div>
	
	<div id=main>

		<?php
		#Se impostato, fa comparire un box contente un messaggio che scompare automaticamente dopo 2 secondi
		if (isset($_SESSION["flash"])) { ?>
				<div id="flash">
					<?= $_SESSION["flash"] ?>
				</div>
				<script src="http://ajax.googleapis.com/ajax/libs/scriptaculous/1.9.0/scriptaculous.js"></script>
				<script>setTimeout(function(){$("flash").fade();}, 2000);</script>
		<?php
			unset($_SESSION["flash"]);
		}
		
		if (isset($_SESSION["name"])) { ?>
			<div id="topmenu">
				<div class="topelem"><a class="white" href="index.php">Home</a></div>
				<div class="topelem"><a class="white" href="social.php">Social</a></div>
				<div class="topelem"><a class="white" href="game.php">Gioca</a></div>
				<div class="topelem"><a class="white" href="profile.php">Profilo</a></div>
				<form id="searchform" action="search.php" method="get">
					<input id="cerca" name="search" placeholder="Trova un prodotto" minlength="3" autocomplete="off">
					<input id="search" type="submit" value="Cerca">
				</form>
			</div>
		<?php } ?>
