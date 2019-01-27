function ajaxFail(ajax, exception) {
	console.log ("Ajax failed: "+ajax.status+" "+ajax.statusText);
	if(exception){
		throw exception;
	}
}

/*Crea gli elementi che mostrano i prodotti nella wishlist di un amico*/
function handleWish(ajax2){
	var prod = JSON.parse(ajax2.responseText).products;
	for(var i=0; i<prod.length-1; i++){
		
		var newProd = document.createElement("div");
		newProd.className = "prod";
		$("wish").appendChild(newProd);

		var prodLink = document.createElement("a");
		prodLink.href="product.php?id="+prod[i].id;
		prodLink.innerHTML = prod[i].nome;

		var prodImg = document.createElement("img");
		prodImg.src="img/prod/"+prod[i].id+".jpg";
		prodImg.className = "prodimg";

		newProd.appendChild(prodImg);
		newProd.appendChild(prodLink);
	}
}

/*Richiede il caricamento dei prodotti della wishlist dell'amico selezionato*/
function loadWish(){
	var list = document.getElementById("wish");
	while (list.hasChildNodes()) {   
		list.removeChild(list.firstChild);
	}
	var name = this.innerHTML;

	var title = document.createElement("h2");
	title.innerHTML = "Wishlist di " + name;
	$("wish").appendChild(title);
	
	new Ajax.Request("socialWish.php", {
			method: "post",
			parameters: {n: name},
			onSuccess: handleWish,
			onFailure: ajaxFail,
			onExeption: ajaxFail
	});
}

/*Mostra la lista di amici*/
function handleFriend(ajax){
	var list = JSON.parse(ajax.responseText).friends;
	for(var i=0; i<list.length-1; i++){
		var newFriend = document.createElement("li");
		newFriend.className = "friend";
		newFriend.innerHTML = list[i].nome;
		$("friendlist").appendChild(newFriend);
		newFriend.onclick = loadWish;
	}
}

function loadFriend(){
	new Ajax.Request("socialFriend.php", {
			onSuccess: handleFriend,
			onFailure: ajaxFail,
			onExeption: ajaxFail
	})
}

window.onload = function() {
	loadFriend();
	
	/*Suggerimenti durante la ricerca*/
	new Ajax.Autocompleter("amici", "lista", "socialSuggest.php", {paramName: 'nome' });
	$("aggiungi").onclick =  function() {
		var name = $("amici").value;
		new Ajax.Request("socialAddFriend.php", {
			method: "get",
			parameters: {n: name},
			onSuccess: function(){
				$("friendlist").innerHTML="";
				loadFriend();
			},
			onFailure: ajaxFail,
			onExeption: ajaxFail
		});
		
	};

}