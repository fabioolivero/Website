<?php 
/*
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina contiene la funzione PHP che aggiunge una recensione di un prodotto.
*/

include "common.php";

#Controlla che siano presenti i parametri e che il prodotto esista nel database 
if (isset ($_GET["id"]) && isset($_POST["testo"]) && exist_id($_GET["id"])){
	$db = db();
	$id = $_GET["id"];
	$testo = $db->quote($_POST["testo"]);
	$voto = $_POST["voto"];
	if (!(is_numeric($voto) && $voto<6 && $voto>0)){
		redirect("product.php?id=$id", "Errore nell'inserimento dei dati");
	}
	$nome = $_SESSION["name"];

	$rows = $db->query("
	SELECT *
	FROM review
	WHERE prod = '$id' AND user = '$nome'
	");

	#Se l'utente non ha ancora lasciato una recensione a questo prodotto la aggiunge al database,
	#altrimenti lo segnala all'utente
	if ($rows->rowCount()==0){
		$db->query("
		INSERT INTO `review`(`prod`, `user`, `voto`, `testo`)
		VALUES ('$id','$nome','$voto',$testo)
		");
		redirect("product.php?id=$id", "Recensione aggiunta");
	} else { 
		redirect("product.php?id=$id", "Hai già recensito questo prodotto");
	} 
} else {
	redirect("index.php", "");
}
include("bottom.php"); ?>