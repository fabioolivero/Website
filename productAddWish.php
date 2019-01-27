<?php
/*
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina contiene la funzione PHP che aggiunge un prodotto alla wishlist.
*/

include "common.php";

#Controlla che sia presente il parametro e che il prodotto esista nel database 
if (isset ($_POST["id"]) && exist_id($_POST["id"])){
	$id = $_POST["id"];
	$nome = $_SESSION["name"];

	$db = db();

	$rows = $db->query("
	SELECT *
	FROM wishlist
	WHERE prod_id = '$id' AND username = '$nome'
	");

	#Se il prodotto non è presente nella wishlist lo aggiunge, altrimenti lo segnala all'utente
	if ($rows->rowCount()==0){
		$db->query("
		INSERT INTO `wishlist`(`username`, `prod_id`)
		VALUES ('$nome','$id')
		");
	}
} else {
	redirect("index.php", "");
}
?>
