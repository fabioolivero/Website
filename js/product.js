function ajaxFail(ajax, exception) {
	console.log ("Ajax failed: "+ajax.status+" "+ajax.statusText);
	if(exception){
		throw exception;
	}
}

/*Carica le informazioni del prodotto scelto*/
function handleInfo(ajax1){
	var prod = JSON.parse(ajax1.responseText);
	$("prodname").innerHTML = prod.nome;
	$("proddesc").innerHTML = prod.descrizione;
	if (parseInt(prod.disp) > 0){
		$("prodprice").innerHTML = "€"+prod.prezzo;
	}else{
		$("prodprice").innerHTML = "Non disponibile";
		$("addcart").disabled = "true";
	}
}

/*Carica le recensioni del prodotto scelto*/
function handleReview(ajax2){
	var rev = JSON.parse(ajax2.responseText).riviews;
	for (var i=0; i<rev.length-1; i++){
		var newRev = document.createElement("div");
		newRev.className = "rev";
		$("revs").appendChild(newRev);
		
		var revImg = document.createElement("img");
		revImg.className = "revimg";
		revImg.src = "img/usr.jpg";
		
		var revText = document.createElement("div");
		revText.className = "revtext";
		revText.innerHTML = "<h4>"+rev[i].nome+": "+rev[i].voto+"</h4>"+rev[i].testo;
		
		newRev.appendChild(revImg);
		newRev.appendChild(revText);
	}
}

function info(id){
	new Ajax.Request("productRequest.php", {
		method: "post",
		parameters: {id: id},
		onSuccess: handleInfo,
		onFailure: ajaxFail,
		onExeption: ajaxFail
	})
}

function review(id){
	new Ajax.Request("productReview.php", {
		method: "post",
		parameters: {id: id},
		onSuccess: handleReview,
		onFailure: ajaxFail,
		onExeption: ajaxFail
	})
}

window.onload = function() {
	$("addcart").onclick =  function() {
		var qt = $("qt").value;
		new Ajax.Request("productAddCart.php", {
			method: "post",
			parameters: {id: id,
						qt: qt 
						},
			onFailure: ajaxFail,
			onExeption: ajaxFail
		});
		var num = parseInt($("cartc").innerHTML);
		$("cartc").innerHTML = num+parseInt(qt);
	};
	
	$("addwish").onclick =  function() {
			new Ajax.Request("productAddWish.php", {
			method: "post",
			parameters: {id: id},
			onFailure: ajaxFail,
			onExeption: ajaxFail
		});
		$("addwish").disabled = "true";
		$("addwish").title = "Questo prodotto è già nella tua wishlist";
	};
	
	info(id);
	review(id);
}