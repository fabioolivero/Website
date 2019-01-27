<?php
/*
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina restituisce la lista di amici in formato JSON.
*/

include "common.php";

$nome=$_SESSION["name"];
$db = db();
$rows = $db->query("
    SELECT user_2
    FROM friends
	WHERE user_1 = '$nome'
");
header("Content-type: application/json");

print '{ "friends": [';
foreach ($rows as $row) {
	$out = 	'{
			"nome" : "'.$row[0].'" }, ';
	print "$out";
}
print '{} ] }';
?>