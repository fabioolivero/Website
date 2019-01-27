<?php
/*
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina rimuove un elemento dalla lista degli ordini di un utente.
*/

include "common.php";

#se l'id non è impostato o non fa parte della wishlist non succede nulla
if(isset($_POST["id"])){
	$id = $_POST["id"];
	$nome = $_SESSION["name"];

	$db = db();

	$rows = $db->query("
		DELETE FROM `orders` 
		WHERE id = '$id' AND user = '$nome' 
	");
} else {
	redirect("index.php", "");
}


?>