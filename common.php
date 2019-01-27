<?php
/* 
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina contiene alcune funzioni PHP utili in diverse parti del codice
*/
	
session_start();

#controlla se è stato eseguito un login
function check_session(){
	if (!isset($_SESSION["name"])) {
		header("Location: login.php");
		die;
	}
}

#ritorna oggetto database
function db(){
	return new PDO("mysql:dbname=shop; host=localhost", "root", "");
}

#controlla se un utente è prensente nel database
function exist($username){
	$db = db();	
	$rows = $db->query("
		SELECT *
		FROM users
		WHERE username = '$username'
	");

	if ($rows->rowCount()>0)
		return true;
	else
		return false;	
}

#controlla se il prodotto è presente nel database (prodotti)
function exist_id($id){
	$db = db();	
	$rows = $db->query("
		SELECT *
		FROM products
		WHERE id = '$id'
	");

	if ($rows->rowCount()>0)
		return true;
	else
		return false;
}

function exist_review($id){
	$db = db();	
	$name = $_SESSION["name"];
	$rows = $db->query("
		SELECT *
		FROM review
		WHERE prod = '$id' AND user = '$name'
	");

	if ($rows->rowCount()>0)
		return true;
	else
		return false;
}

#controlla se il prodotto è presente nella wishlist
function exist_id_wish($id){
	$db = db();	
	$name = $_SESSION["name"];
	$rows = $db->query("
		SELECT *
		FROM wishlist
		WHERE prod_id = '$id' AND username = '$name'
	");

	if ($rows->rowCount()>0)
		return true;
	else
		return false;
}

#reindirizza ad un url specifico, eventualmente mostrando un messaggio
function redirect($url, $message){
	$head = "Location: ".$url;
	if ($message != "")
		$_SESSION["flash"] = "$message";
    header($head);
    die();
}

?>
