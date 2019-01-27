<?php 
/* 
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina contiene la funzione PHP che rimuove un prodotto dal carrello
*/

include "common.php";

#si legge l'id del prodotto da rimuovere tramite la funzione POST
if (isset ($_POST["id"])){
	$id = $_POST["id"];
	$cart = $_COOKIE["cart"];
	$array = array();
	$array = json_decode($cart);

	$new = array();

	#si costruisce un nuovo array per i prodotti nel carrello escludendo quello da rimuovere
	for ($i=0; $i<count($array); $i++){
		if ($array[$i][0]!=$id)
			array_push($new, $array[$i]);
	}

	$cart = json_encode($new);
	if (count($new)>0)
		setcookie("cart", "$cart");
	else
		setcookie("cart", null);
} else {
	redirect("index.php", "");
}
?>
