<?php
/* 
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina contiene la funzione PHP che restituisce una lista di prodotti
consigliati per l'utente in base alla sua wishlist.
*/

include("common.php");

$nome = $_SESSION["name"];

$db = db();

$wish = $db->query("
    SELECT *
    FROM wishlist
	WHERE username = '$nome'
");

//se l'utente ha dei prodotti nella wishlist vengono scelti dal database i prodotti della stessa categoria
if($wish->rowCount()>0){
	$rows = $db->query("
		SELECT id, nome, prezzo
		FROM products 
		WHERE categoria IN (
			SELECT products.categoria 
			FROM products JOIN wishlist ON (products.id = wishlist.prod_id)
			WHERE wishlist.username = '$nome'
			)
		ORDER BY rand()
		LIMIT 3
	");
} else { //altrimenti vengono scelti prodotti casuali
	$rows = $db->query("
		SELECT id, nome, prezzo
		FROM products
		ORDER BY rand()
		LIMIT 3
	");
}

//output del risultato (informazioni dei prodotti) in formato JSON
print '{ "products": [';
foreach ($rows as $row) {
	$out = 	'{
			"id" : "'.$row[0].'" ,
			"nome" : "'.$row[1].'" , 
			"prezzo" : '.$row[2]." }, \n";
	print "$out";
}
print '{} ] }';

?>
