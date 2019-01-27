<?php
/*
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina permette la visualizzazione della lista di suggerimenti degli 
utenti da aggiungere alla lista di amici durante la ricerca.
*/

include "common.php";

if(isset ($_POST["nome"])){
	$db = db();
	$nome =$_POST["nome"];
	$nome = preg_replace("/[^A-Za-z0-9_]/", " ", $nome);
	$nome_sess = $_SESSION["name"];
	$rows = $db->query("
		SELECT username
		FROM users
		WHERE username LIKE '$nome%' AND NOT '$nome' = ''
	");

	print "<ul>";
	foreach ($rows as $row) {
		print "<li>$row[0]</li>";
	}

	print"</ul>";
} else {
	redirect("index.php", "");
}


?>