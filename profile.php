<?php 
/*
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina permette all'utente di visualizzare le informazioni personali e
di visualizzare gli ordini.
*/

include("top.php");
check_session();

$name=$_SESSION["name"];
?>

<script src="js/profile.js"></script>
<link href="css/profile.css" type="text/css" rel="stylesheet">

<h1>Profilo di <?=$name?> </h1>
<div id="usrinfo">
	<img id="userimg" src="img/usr.jpg" alt="Immagine profilo">
	<table>
		<tr>
			<td>Username:</td>
			<td id="username"><?=$name?></td>
		</tr>
		<tr>
			<td>Nome:</td>
			<td id="nome"></td>
		</tr>
		<tr>
			<td>Cognome:</td>
			<td id="cognome"></td>
		</tr>
		<tr>
			<td>Data di nascita:</td>
			<td id="data"></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td id="email"></td>
		</tr>
	</table>
</div>

<h2 title="Vengono mostrati solo i tuoi ultimi 5 ordini">I miei ordini</h2>

<ul id=orders> </ul>

<h2>Wishlist</h2>
<div id="wishlist"></div>
<div id="clear"></div>
	
<?php 

include "bottom.php";
?>
