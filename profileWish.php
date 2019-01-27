<?php
/*
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina restituisce le informazioni dei prodotti nella wishlist di
un utente in formato JSON.
*/

include "common.php";

if(isset ($_POST["n"])){
	$name=$_POST["n"];
	$db = db();
	$rows = $db->query("
		SELECT products.id, products.nome, products.prezzo
		FROM wishlist JOIN products ON (wishlist.prod_id = products.id)
		WHERE wishlist.username LIKE '$name';
	");

	header("Content-type: application/json");

	print '{ "products": [';
	foreach ($rows as $row) {
		$out = 	'{
				"id" : "'.$row[0].'" , 
				"nome" : "'.$row[1].'" , 
				"prezzo" : '.$row[2]." }, \n";
		print "$out";
	}
	print '{} ] }';
} else {
	redirect("index.php", "");
}
?>