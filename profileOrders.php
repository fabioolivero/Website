<?php
/*
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina restituisce la lista degli ordini di un utente in formato JSON.
*/

include "common.php";

if (isset($_POST["n"])){
	$name=$_POST["n"];
	$db = db();
	
	#Ricerca nel database tutti gli ordini dell'utente
	$rows = $db->query("
		SELECT *
		FROM orders
		WHERE user = '$name'
		LIMIT 5;
	");

	header("Content-type: application/json");

	print '{ "orders": [';
	
	#Output di tutti gli ordini
	foreach ($rows as $row) {

		#Decodifica della lista di prodotti (da formato JSON)
		$prods = json_decode($row[1]);
		$names = array();
		
		#Output delle informazioni di ogni prodotto (nome e quantità)
		foreach ($prods as $elem){
			$id = $elem[0];
			
			#Si risale al nome tramite l'id
			$temp = $db->query("
				SELECT nome
				FROM products
				WHERE id = '$id';
			");
			foreach ($temp as $name){}
			$name["nome"] = $name["nome"]." (".$elem[1].")";
			array_push($names, $name);
		}
		$names_json = json_encode($names);

		$out = 	'{
				"id" : "'.$row[0].'" ,
				"data" : "'.$row[2].'" , 
				"products" : '.$names_json." }, \n";
		print "$out";
	}
	print '{} ] }';
} else {
	redirect("index.php", "");
}
?>