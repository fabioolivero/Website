<?php
/* 
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina contiene la funzione PHP che restituisce le informazioni dei prodotti
presenti nel carrello in formato JSON
*/

include "common.php";

#Si leggono gli elementi del carrello in formato JSON e si decodificano in un array
if (isset($_COOKIE["cart"])) {
	$cart = $_COOKIE["cart"];
	$array = array();
	$array = json_decode($cart);
} else {
	redirect("index.php", "");
}

$db = db();

header("Content-type: application/json");
print '{ "products": [';

#Per ogni elemento presente nel carrello si ricercano nel database le relative
#informazioni e si aggiungono all'output JSON
foreach ($array as $elem){
	$rows = $db->query("
		SELECT *
		FROM products
		WHERE id = '$elem[0]'
	");
	
	foreach ($rows as $row){}
	
	$out = 	'{
			"id" : "'.$row[0].'" ,
			"nome" : "'.$row[1].'" , 
			"quant" : "'.$elem[1].'" , 
			"prezzo" : '.$row[3]." }, \n";
	print "$out";
} 

print '{} ] }';

?>
