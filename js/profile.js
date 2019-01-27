function ajaxFail(ajax, exception) {
	console.log ("Ajax failed: "+ajax.status+" "+ajax.statusText);
	if(exception){
		throw exception;
	}
}

/*Carica le informazioni personali*/
function handleInfo(ajax1){
	var pers = JSON.parse(ajax1.responseText);
	$("nome").innerHTML = pers.nome;
	$("cognome").innerHTML = pers.cognome;
	$("data").innerHTML = pers.data;
	$("email").innerHTML = pers.email;
}

/*Crea gli elementi che mostrano i prodotti nella wishlist*/
function handleWish(ajax2){
	var prod = JSON.parse(ajax2.responseText).products;
	for(var i=0; i<prod.length-1; i++){
		
		var newProd = document.createElement("div");
		newProd.className = "prod";
		$("wishlist").appendChild(newProd);

		var prodLink = document.createElement("a");
		prodLink.href = "product.php?id=" + prod[i].id;
		prodLink.innerHTML = prod[i].nome + " €"+prod[i].prezzo + "<br>";

		var prodImg = document.createElement("img");
		prodImg.src = "img/prod/" + prod[i].id + ".jpg";
		prodImg.className = "prodimg";
		
		var remImg = document.createElement("img");
		remImg.className = "remImg";
		remImg.src = "img/bin.png";
		remImg.id = prod[i].id;
		remImg.observe ("click", removeWish);

		newProd.appendChild(prodImg);
		newProd.appendChild(prodLink);
		newProd.appendChild(remImg);
	}
}

function removeWish(){
	new Ajax.Request("productRemoveWish.php", {
			method: "post",
			parameters: {id: this.id},
			onFailure: ajaxFail,
			onExeption: ajaxFail
	});
	$(this).parentNode.remove();
}

/*Crea la lista di ordini e i relativi prodotti*/
function handleOrders(ajax3){
	var ord = JSON.parse(ajax3.responseText).orders;
	for(var i=0; i<ord.length-1; i++){
		var ordDate = document.createElement("li");

		var remImg = document.createElement("img");
		remImg.className = "remImg";
		remImg.src = "img/bin.png";
		remImg.id = ord[i].id;
		remImg.observe ("click", removeOrd);
		
		ordDate.innerHTML = "Ordine del: " + ord[i].data;
		ordDate.appendChild(remImg);
		
		var ordProd = document.createElement("ul");
		$("orders").appendChild(ordDate);
		for(var j=0; j<ord[i].products.length; j++){
			var prod = document.createElement("li");
			prod.innerHTML = ord[i].products[j].nome;
			ordProd.appendChild(prod);
		}
		ordDate.appendChild(ordProd);
	}
}

function removeOrd(){
	new Ajax.Request("profileOrdersRemove.php", {
			method: "post",
			parameters: {id: this.id},
			onFailure: ajaxFail,
			onExeption: ajaxFail
	});
	$(this).parentNode.remove();
}

function info(name){
	new Ajax.Request("profileRequest.php", {
			method: "post",
			parameters: {n: name},
			onSuccess: handleInfo,
			onFailure: ajaxFail,
			onExeption: ajaxFail
	})
}

function wishlist(name){
	new Ajax.Request("profileWish.php", {
			method: "post",
			parameters: {n: name},
			onSuccess: handleWish,
			onFailure: ajaxFail,
			onExeption: ajaxFail
	})
}

function orders(name){
	new Ajax.Request("profileOrders.php", {
			method: "post",
			parameters: {n: name},
			onSuccess: handleOrders,
			onFailure: ajaxFail,
			onExeption: ajaxFail
	})
}

window.onload = function() {
	info($("username").innerHTML);
	wishlist($("username").innerHTML);
	orders($("username").innerHTML);
}