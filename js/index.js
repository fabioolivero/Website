function ajaxFail(ajax, exception) {
	console.log ("Ajax failed: "+ajax.status+" "+ajax.statusText);
	if(exception){
		throw exception;
	}
}

/*Crea gli elementi che mostrano i prodotti consigliati per l'utente*/
function handle(ajax){
	var prod = JSON.parse(ajax.responseText).products;
	for(var i=0; i<prod.length-1; i++){
		
		var newProd = document.createElement("div");
		newProd.className = "prod";
		$("offerte").appendChild(newProd);

		var prodLink = document.createElement("a");
		prodLink.href = "product.php?id=" + prod[i].id;
		prodLink.innerHTML = prod[i].nome;

		var prodImg = document.createElement("img");
		prodImg.src = "img/prod/" + prod[i].id + ".jpg";
		prodImg.className = "prodimg";

		newProd.appendChild(prodImg);
		newProd.appendChild(prodLink);
	}
}

function newProdElem() {
	new Ajax.Request("indexProduct.php", {
		method: "get",
		onSuccess: handle,
		onFailure: ajaxFail,
		onExeption: ajaxFail
	});
}

window.onload = function() {
    newProdElem();
}