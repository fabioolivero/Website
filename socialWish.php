<?php
/*
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina restituisce la lista di prodotti nella wishlist di un amico
in formato JSON.
*/

include "common.php";

if (isset ($_POST["n"])){
	$db = db();
	$name =$db->quote($_POST["n"]);
	$rows = $db->query("
		SELECT products.id, products.nome
		FROM products JOIN wishlist ON (products.id = wishlist.prod_id)
		WHERE wishlist.username = $name
	");
	header("Content-type: application/json");

	print '{ "products": [';
	foreach ($rows as $row) {
		$out = 	'{
				"id" : "'.$row[0].'" ,
				"nome" : "'.$row[1].'"}, ';
		print "$out";
	}
	print '{} ] }';
} else {
	redirect("index.php", "");
}
?>