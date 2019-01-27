<?php
/*
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina permette di aggiungere nuovi amici e di visualizzarne
le wishlist
*/

include "top.php";
check_session();
?>

<script src="http://ajax.googleapis.com/ajax/libs/scriptaculous/1.9.0/scriptaculous.js"></script>
<script src="js/social.js"></script>
<link href="css/social.css" type="text/css" rel="stylesheet">

<h1>Social</h1>

<div id="find">
	<div>Trova un amico da seguire<br><br> </div>
	<input id="amici" autocomplete="off" size="30" type="text" title="Segui i suggerimenti"/>
	<input id="aggiungi" type="button" value="Segui">
	<div class="autocomplete" id="lista"></div>
</div>

<p> Questa è la lista dei tuoi amici, se clicchi puoi vedere la loro wishlist </p>
<ul id="friendlist">
</ul>

<div id="wish"></div>
<div id="clear"></div>

<?php
include "bottom.php"
?>