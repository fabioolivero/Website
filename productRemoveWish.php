<?php
/*
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina contiene la funzione PHP che rimuove un prodotto dalla wishlist.
*/

include "common.php";

#Controlla che sia presente il parametro e che il prodotto esista nella wishlist
#e rimuove il prodotto dalla tabella wishlist del database
if(isset($_POST["id"]) && exist_id_wish($_POST["id"])){
	$id = $_POST["id"];
	$nome = $_SESSION["name"];

	$db = db();

	$db->query("
		DELETE FROM `wishlist` 
		WHERE prod_id = '$id' AND username = '$nome'
	");	 
}

?>
