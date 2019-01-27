<!--
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina contiene i campi per il login o la registrazione dell'utente.
-->

<?php include("top.php"); ?>
<link href="css/login.css" type="text/css" rel="stylesheet">

<h3>Accedi al sito o registrati per visualizzare i contenuti</h3>

<div id="login">
	<form id="login" autocomplete="off" action="loginValid.php" method="post">
	<fieldset >
		<legend>Login</legend>
			<label>Username:</label> <input type="text" name="name" maxlength="16" > <br>
			<label>Password:</label> <input type="password" name="pass" maxlength="16" > <br>
			<input class="btn" type="submit" value="Login" >	
	</fieldset>
	</form>
</div>

<div id="register">
	<form id="register" autocomplete="off" action="loginRegister.php" method="post">
	<fieldset >
		<legend>Registrati</legend>
			<label>Nome:</label> <input type="text" name="nome" maxlength="20" required="required"> <br>
			<label>Cognome:</label> <input type="text" name="cognome" maxlength="20" required="required"> <br>
			<label>Data:</label><input type="date" id="start" name="data" value="1990-01-01" min="1900-01-01" max="2000-01-01"><br>
			<label>Email:</label> <input type="email" name="email" maxlength="30" required="required" 
				pattern="[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Inserisci un indirizzo email valido"> <br>
			<label>Username:</label> <input type="text" name="username" maxlength="20" required="required"> <br>
			<label>Password:</label> <input type="password" name="password" maxlength="20" required="required" pattern=".{6,}" 
				title="Inserisci almeno 6 caratteri"> <br>
			<label>Indirizzo:</label> <input type="text" name="indirizzo" maxlength="30" required="required"> <br>
			<label>Telefono:</label> <input type="tel" name="telefono" maxlength="10" required="required" pattern="\d{10,}"
				title="Inserisci numero di telefono valido"> <br>
			<input class="btn" type="submit" value="Registrati" >
	</fieldset>
	</form>
</div>

<?php include("bottom.php"); ?>