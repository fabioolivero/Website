<?php
/*
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina contiene la funzione PHP che restituisce le informazioni in formato
JSON di un prodotto il cui id viene passato come parametro
*/

include "common.php";

#Controlla che il parametro sia impostato
if(isset($_POST["id"])){
	$id = $_POST["id"];
	$db = db();
	$rows = $db->query("
		SELECT *
		FROM products
		WHERE id = '$id'
	");
	header("Content-type: application/json");
	foreach ($rows as $row) {}

	$out = '{
		"nome" : "'.$row[1].'" ,
		"descrizione" : "'.$row[2].'" ,
		"disp" : "'.$row[4].'" ,
		"prezzo" : '.$row[3].'}';
	print "$out";
} else {
	redirect("index.php", "");
}
?>