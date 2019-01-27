<?php 
/* 
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina visualizza tutti i prodotti presenti nel carrello.
*/

include "top.php";
check_session();

#Se il carrello è vuoto reindirizza l'utente alla home
if(!isset($_COOKIE["cart"])){ ?>
	<h1>Carrello vuoto</h1>
<?php }else{ ?>

<h1 id="title">Carrello</h1>
<script type="text/javascript" src="js/cart.js"></script>
<link href="css/cart.css" type="text/css" rel="stylesheet">

<table id="cart">
</table>

<?php
#Se l'utente attraverso il gioco ha ottenuto lo sconto viene applicato qui
if(isset($_COOKIE["sconto"])){ ?>
	<script> SCONTO = true; </script>
<?php } ?>

<input id="conferma" type="button" value="Conferma ordine">

<?php }
include "bottom.php";
?>
