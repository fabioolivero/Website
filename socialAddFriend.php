<?php
/*
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina contiene la funzione PHP che aggiunge un nuovo utente alla lista
degli amici.
*/

include "common.php";

$db = db();

if(isset($_GET["n"])){
	$nome2 = $db->quote($_GET["n"]);
	$nome1 = $db->quote($_SESSION["name"]);
	
	#Controllo esistenza utente ricercato nel database
	$rows1 = $db->query("
			SELECT *
			FROM users
			WHERE username = $nome2
		");
	if ($rows1->rowCount()==0){
		redirect("social.php", "Utente non trovato");
	}
	
	#Controllo che l'utente da aggiungere non sia già nella lista di amici
	$rows = $db->query("
		SELECT *
		FROM friends
		WHERE user_1 = $nome1 AND user_2 = $nome2
	");

	#Aggiunta amico
	if ($rows->rowCount()==0){
		$db->query("
		INSERT INTO `friends`(`user_1`, `user_2`)
		VALUES ($nome1,$nome2)
		");		
	} 
} else {
	redirect("index.php", "");
}

?>
