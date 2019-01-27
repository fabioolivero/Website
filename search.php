<?php 
/*
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina mostra i risultati della ricerca.
*/

include "top.php";
check_session();

$search = $_GET["search"];
if(strlen($search)>2){
	#Si sostiuiscono i caratteri speciali per evitare HTML/SQL injection
	$search = preg_replace("/[^A-Za-z0-9\s]/", "", $search); 
	?>
	<script type="text/javascript" src="js/search.js" ></script>
	<script type="text/javascript"> var search = "<?=$search?>" </script>
	<h2>Risultati per: <?=$search?></h2>
	<div id="result"></div>
	<div id="clear"></div>
<?php 
}else{
?>
	<h2>Inserisci una parola da cercare di almeno 3 caratteri</h2>
<?php }
include "bottom.php" ?> 