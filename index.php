<!-- 
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Home page del sito. Viene mostrata una selezione di prodotti per l'utente.
-->

<?php include("top.php"); 
check_session();
?>
<script src="js/index.js"></script>
<link href="css/index.css" type="text/css" rel="stylesheet">

<h2>Offerte per te:</h2>
<div id="offerte"></div>
<div id="clear"></div>

<?php 

include("bottom.php"); ?>
