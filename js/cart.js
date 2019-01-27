var SCONTO = false;

function ajaxFail(ajax, exception) {
	console.log ("Ajax failed: "+ajax.status+" "+ajax.statusText);
	if(exception){
		throw exception;
	}
}

/*Crea le righe della tabella che mostra tutti gli elementi nel carrello*/
function handle(ajax) {
	var prod = JSON.parse(ajax.responseText).products;
	$("cart").innerHTML = "<tr>" + "<th>Immagine</th>" + "<th>Prodotto</th>" +
		"<th>Quantità</th>" + "<th>Prezzo</th>" + "<th></th> </tr>";
	var tot = 0;
	var quant = 0;
	for (var i = 0; i < prod.length - 1; i++) {
		var newProd = document.createElement("tr");
		var imgsrc = "img/prod/" + prod[i].id + ".jpg";
		var img = "<img class='prodImg' src="+ imgsrc +'>';
		newProd.innerHTML ="<td> " + img + " </td> <td> " + prod[i].nome + " </td> <td>" 
			+ prod[i].quant + "</td> <td>" +  prod[i].prezzo +  "</td>";
		
		var remImg = document.createElement("img");
		remImg.className = "remImg";
		remImg.setAttribute("src", "img/bin.png");
		remImg.setAttribute("id", prod[i].id);
		remImg.setAttribute("q", prod[i].quant);
		remImg.observe ("click", removeCart);
		
		var remove = document.createElement("td");
		remove.appendChild(remImg);
		newProd.appendChild(remove);
		
		tot = tot + prod[i].prezzo*prod[i].quant;
		quant = quant + parseInt(prod[i].quant);
		
		$("cart").appendChild(newProd);		
	}
	if (SCONTO){
		var newTot = tot - (tot*0.1);
		var p = "SCONTO 10% <strong id='price'>"+newTot+"</strong>"
	} else {
		var p = "<strong id='price'>"+tot+"</strong>";
	}
	
	var totale = document.createElement("tr");
	totale.innerHTML = "<td></td> <td>Totale:</td> <td>"+ p +"</td>";
	$("cart").appendChild(totale);
	$("cartc").innerHTML = quant;
}

function removeCart() {
	var num = parseInt($("cartc").innerHTML);
	num = num - parseInt(this.getAttribute("q"));
	$("cartc").innerHTML = num;

	new Ajax.Request("cartDelete.php", {
			method: "post",
			parameters: {id: this.id},
			onSuccess: function(){
				if(num==0){
					$("cart").innerHTML="";
					$("conferma").remove();
					$("title").innerHTML="Carrello vuoto";
				} else {
					$("cart").innerHTML="";
					cart();
				}
			},
			onFailure: ajaxFail,
			onExeption: ajaxFail
	});
}

function cart() {
	new Ajax.Request("cartRequest.php", {
		onSuccess: handle,
		onFailure: ajaxFail,
		onExeption: ajaxFail
	})
}

window.onload = function () {
	$("conferma").onclick =  function() {
    	document.location.href = "cartConfirm.php";
		};
	cart();
}
