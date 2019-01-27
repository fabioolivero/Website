<?php
/*
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina restituisce le informazioni dei prodotti ricercati in base 
al nome (JSON)
*/

include "common.php";

$db = db();
if (isset($_GET["s"])){
	$search = $_GET["s"];
	$search = preg_replace("/[^A-Za-z0-9\s]/", "", $search); 

	$rows = $db->query("
		SELECT *
		FROM products
		WHERE nome LIKE '%$search%' AND '$search' NOT LIKE ' ' 
		AND '$search' NOT LIKE '' 
	");	

	header("Content-type: application/json");

	print '{ "products": [';
	foreach ($rows as $row) {
		$out = 	'{
				"id" : "'.$row[0].'" ,
				"nome" : "'.$row[1].'" , 
				"disp" : "'.$row[4].'" , 
				"prezzo" : '.$row[3]." }, \n";
		print "$out";
	}
	print '{} ] }';
} else {
	redirect("index.php", "");
}
?>