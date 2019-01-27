/*
Programma javascript che gestisce il gioco. Muovendo il carrello con
il mouse si devono prendere al volo i pacchi che cadono dall'alto
*/

var COUNT = 0;
var LEFT_OFFSET = 0;
var HIT = false;

/*
Questa funzione una volta richiamata entra in un loop in cui ogni 100ms controlla se 
il pacco è sovrapposto al carrello. In caso positivo incrementa il contatore
e resetta la posizione del pacco.
*/
function check() {
	var x = $("#dropelem").offset().left;
	var y = $("#dropelem").offset().top;

	if ($("#cart").offset().left > x - 70 &&
		$("#cart").offset().left < x + 50 &&
		$("#cart").offset().top > y - 70 &&
		$("#cart").offset().top < y + 10 &&
		!HIT) {
		HIT = true;
		COUNT++;
		$("#dropelem").stop();
		$("#dropelem").toggle("puff");
		setTimeout(reset, 500);
		if (COUNT < 10) {
			$("#score").text(COUNT);
		} else {
			$("#score").text("HAI VINTO!");
			$("#score").effect( "shake", "slow" );
			document.cookie = "sconto = ok";
		}
	}
	setTimeout(check, 100);
}

/*
Questa funzione fa partire l'animazione del pacco dall'alto verso il basso.
Al termine richiama la funzione reset.
*/
function start() {
	var speed = (Math.floor(Math.random() * 15) + 50) * 10;
	$("#dropelem").animate({
			top: "650px"
		},
		speed,
		"linear",
		reset
	);
}

/*
Questa funzione mette il pacco nella posizione iniziale, generando casualmente
la posizione sull'asse X.
*/
function reset() {
	HIT = false;
	$("#dropelem").show();
	var l = Math.floor(Math.random() * 400) + LEFT_OFFSET;
	$("#dropelem").css({
		top: 240,
		left: l
	});
	setTimeout(start, 100);
}

$(function () {
	LEFT_OFFSET = $("#dropelem").offset().left;

	$("#cart").draggable({
		axis: "x"
	});
	check();
	reset();
});
