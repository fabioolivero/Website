<?php 
/* 
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina contiene la funzione PHP che aggiunge un nuovo utente nel database.
*/

if (isset ($_POST["nome"])){
	include "common.php";
	$a = array();
	
	#lettura delle informazioni sull'utente tramite metodo POST
	$a[0] = $_POST["nome"];
	$a[1] = $_POST["cognome"];
	$a[2] = $_POST["data"];
	$a[3] = $_POST["email"];
	$a[4] = $_POST["username"];
	$a[5] = $_POST["password"];
	$a[6] = md5($a[5]);
	$a[7] = $_POST["indirizzo"];
	$a[8] = $_POST["telefono"];

	$db = db();
	
	#validazione dei campi attraverso espressioni regolari
	if(!preg_match("/[^a-zA-Z1-9\s]/", $a[0]) && 
	  !preg_match("/[^a-zA-Z1-9\s]/", $a[1]) && 
	  preg_match("/[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,}/", $a[3]) &&
	  !preg_match("/[^a-zA-Z1-9]/", $a[4]) &&
	  preg_match("/.{6,}/", $a[5]) && 
	  !preg_match("/[^a-zA-Z1-9\s]/", $a[7]) && 
	  preg_match("/\d{10,}/", $a[8])
	  ) { 
		#si controlla che l'utente non sia gia presente all'interno del database
		if (exist($username)) {
			redirect("login.php", "Utente già registrato");
		} else {
			for($i=0; $i<count($a); $i++){
				$a[$i] = $db->quote($a[$i]);
			}
			
			#inserimento all'interno del database
			$db->query("
			INSERT INTO `users`(`username`, `nome`, `cognome`, `data`, `email`, `password`, `indirizzo`, `telefono`)
			VALUES ($a[4], $a[0], $a[1], $a[2], $a[3], $a[6], $a[7], $a[8])
			");
			redirect("login.php", "Adesso esegui il login");
		}
	} else {
		redirect("login.php", "Errore nell'inserimento dei dati");
	} 
} else {
	redirect("index.php", "");
}?>
