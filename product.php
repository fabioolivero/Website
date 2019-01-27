<?php 
/* 
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina mostra le informazioni di un prodotto, il cui id viene passato
come parametro tramite GET.
*/

include("top.php");
check_session();
	 
#controlla che sia impostato il parametro e che l'id sia presente nel database
if (isset ($_GET["id"]) && exist_id($_GET["id"])){
	
	$id = $_GET["id"];
	$imgfile = "img/prod/".$id.".jpg";
	?>
		<script type="text/javascript" src="js/product.js" ></script>
		<link href="css/product.css" type="text/css" rel="stylesheet">

		<script type="text/javascript"> var id=<?=$id?> </script>

		<div id="prodinfo">
			<img id="prodimg" src="<?=$imgfile?>" alt="Immagine profilo">
			<h1 id="prodname">Nome Prodotto </h1>
			<span id = "proddesc"> descrizione prodotto </span>
			<div id = "prodprice"> prezzo </div>
		</div>

			<input type="number" id="qt" name="qt" min="1" value="1">
			<input id="addcart" type="button" value="Aggiungi al carrello" >
			<?php
			if(exist_id_wish($id)){?>
				<input id="addwish" type="button" value="Aggiungi alla wishlist" 
					   	title="Questo prodotto è già nella tua wishlist" disabled>	
			<?php }else{?>
				<input id="addwish" type="button" value="Aggiungi alla wishlist" >
			<?php }?>

		<h2>Recensioni </h2>

		<div id=revs></div>

		<form id="review" action="productNewReview.php?id=<?=$id?>" method="post">
		<fieldset >
			<legend>Lascia la tua recensione</legend>
			<textarea name="testo" maxlength="500"></textarea><br>
			<label>Voto:</label>
			<select name="voto">
			  <option value="1">1</option>
			  <option value="2">2</option>
			  <option value="3">3</option>
			  <option value="4">4</option>
			  <option value="5">5</option>
			</select>
			<?php
			if(exist_review($id)){?>
				<input class="btn" type="submit" value="Pubblica"
					   title="Hai già aggiunto una recensione a questo prodotto" disabled>
			<?php }else{?>
				<input class="btn" type="submit" value="Pubblica">
			<?php }?>
			
		</fieldset>
		</form>
<?php } else { ?>
	<h2>Prodotto non trovato</h2>
<?php }
include("bottom.php"); ?>