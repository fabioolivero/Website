<?php
/* 
Olivero Fabio - Progetto finale TWeb (Sito di commercio elettronico) -
Questa pagina contiene la funzione PHP per il logout, che svuota il carrello e 
disattiva la sessione.
*/

include "common.php";

if (!isset($_SESSION)) {
    if (isset($_SESSION["name"])) {
		setcookie("cart", null);
		unset($_COOKIE["cart"]);
        unset($_SESSION["name"]);
    }
}

session_unset();
session_destroy();
redirect ("login.php", "");
?>
