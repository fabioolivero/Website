<?php
/* 
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina contiene la funzione PHP che conferma l'ordine dei prodotti
presenti nel carrello.
*/

include "common.php";

$user = $_SESSION["name"];

#Si controlla che il carrello contenga dei prodotti
if (isset($_COOKIE["cart"])){
	
	#I prodotti nel carrello si trovano nel campo "cart" dei cookie, in formato JSON
	$cart = $_COOKIE["cart"];
	$db = db();
	
	$array = array();
	$array = json_decode($cart);

	#Viene decrementata la disponibilità del prodotto che si acquista nel database
	foreach($array as $pr){
		$db->query("
			UPDATE `products` 
			SET `disponibilita`= `disponibilita` - '$pr[1]'
			WHERE `id` = '$pr[0]'
		");
	}
	
	#Si aggiunge l'ordine alla tabella degli ordini nel database
	$db->query("
		INSERT INTO `orders`(`products`, `date`, `user`)
		VALUES ('$cart', NOW(), '$user')
	");
	
	#Si svuota il carrello
	setcookie("cart", null);
	setcookie("sconto", null);
	redirect("profile.php", "Ordine effettuato con successo");
	
} else {
	redirect("index.php", "");
}
?>