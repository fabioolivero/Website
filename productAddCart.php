<?php
/* 
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina contiene la funzione PHP che aggiunge un prodotto al carrello.
*/

include "common.php";

#Controlla che sia presente il parametro e che il prodotto esista nel database
if (isset ($_POST["id"]) && exist_id($_POST["id"])){
	$id = $_POST["id"];
	$qt = $_POST["qt"];
	if (!(is_numeric($qt) && $qt>0)){
		redirect("product.php?id=$id", "Errore nell'inserimento dei dati");
	}
	
	if (isset($_COOKIE["cart"])) {
		$cart = $_COOKIE["cart"];
		$array = array();
		$array = json_decode($cart);
		
		#Ricerca se è già presente nel carrello e aumenta la quantità,
		#altrimenti crea un nuovo elemento		
		$found = false;
		$i = 0;
		while ($i<count($array) && !$found){
			if ($array[$i][0] == "$id"){
				$array[$i][1] += $qt; //aumenta quantità
				$found = true;
			}else{ 
				$i++;
			}
		}
		if (!$found){ //non trovato, crea un nuovo elemento
			$array[count($array)] = array($id, $qt);
		}
		
		$cart = json_encode($array);
		setcookie("cart", "$cart");
	} else {
		$array = array();
		$array[0] = array($id, $qt);
		$cart = json_encode($array);
		setcookie("cart", "$cart");
	}
} else {
	redirect("index.php", "");
}

?>