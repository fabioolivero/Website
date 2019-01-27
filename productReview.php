<?php
/*
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina contiene la funzione PHP che restituisce le recensioni in formato
JSON di un prodotto il cui id viene passato come parametro
*/

include "common.php";

#Controlla che il parametro sia impostato
if (isset($_POST["id"])){
	$id = $_POST["id"];
	$db = db();
	$rows = $db->query("
		SELECT *
		FROM review
		WHERE prod = '$id'
	");
	header("Content-type: application/json");
	print '{ "riviews": [';
	foreach ($rows as $row) {
		$out = 	'{
			"nome" : "'.$row[1].'" , 
			"voto" : "'.$row[2].'" , 
			"testo" : "'.htmlspecialchars($row[3]).'"}, ';
		print "$out";
	}
	print ' {} ] }';
} else {
	redirect("index.php", "");
}
?>