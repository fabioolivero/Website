<?php
include "top.php";
check_session();
?>
<!-- 
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina contiene un gioco interattivo, attraverso il quale l'utente
può ottenere uno sconto sui prodotti.
-->

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="js/game.js"></script>
<link href="css/game.css" type="text/css" rel="stylesheet">

<h2>Cattura al volo 10 pacchi e ottieni uno sconto da usare subito</h2>

<div id="game">
	<img src="img/drop.png" id="dropelem" alt="drop">
	<img src="img/cart.png" id="cart" title="Trascinami con il mouse!" alt="cart">
</div>
<div id="score">0</div>

<?php
include "bottom.php";
?>
