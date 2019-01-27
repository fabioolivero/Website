<?php 
/* 
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina contiene la funzione PHP che controlla la validità di nome e
password inseriti dall'utente per il login. Se sono validi l'utente viene
reindirizzato alla home
*/

include "common.php";

if (isset($_POST["name"])){
	$name = $_POST["name"];
	$password = md5($_POST["pass"]);

	$db = db();
	$nameq = $db->quote($name);
	$password = $db->quote($password);

	#ricerca all'interno del database
	$rows = $db->query("
		SELECT *
		FROM users
		WHERE username = $nameq AND password = $password 
	");

	if ($rows->rowCount()>0) {
		$_SESSION["name"] = $name;
		redirect("index.php", "");
	} else {
		redirect("login.php", "Username o password errati");
	}
} else {
	redirect("index.php", "");
}
?>