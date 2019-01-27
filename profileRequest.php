<?php
/*
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina restituisce le informazioni di un utente in formato json.
*/

include "common.php";

if (isset($_POST["n"])){
	$name=$_POST["n"];

	$db = db();
	$rows = $db->query("
		SELECT nome, cognome, data, email
		FROM users
		WHERE username = '$name';
	");

	header("Content-type: application/json");
	foreach ($rows as $row) {
		$out = '{ 
		"nome" : "'.$row[0].'" , 
		"cognome" : "'.$row[1].'" , 
		"data" : "'.$row[2].'" , 
		"email" : "'.$row[3].'" 
		}';
	}
	print "$out";
} else {
	redirect("index.php", "");
}
?>