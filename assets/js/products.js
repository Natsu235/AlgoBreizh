// --------------------------------
// AlgoBreizh Script de la boutique
// --------------------------------


// Formatting
function capitalizeFirstLetter(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}

// Remplit la Modal Article avec les infos de l'article
function showProduct(id) {
	$("#modal_article_id").text(id);
	$("#modal_article_name").text(capitalizeFirstLetter($("#article_name_" + id).text()));
	$("#modal_article_img")[0].src = $("#article_img_" + id)[0].src; 
	$("#modal_article_price").text($("#article_price_" + id).text());
	$("#modal_quantity").val('1');
}

// Actualise le prix en fonction de la quantité
function newPrice(id) {
	var Price = $("#article_price_" + id).text();
	var newPrice = Price * $("#modal_quantity").val();
	$("#modal_article_price").text(Math.round(newPrice * 100) / 100);
}

// Ajoute l'article selectionné au panier
function addToCart(id) {
	var Quantity = $("#modal_quantity").val();
	var Name = $("#modal_article_name").text();
	$.ajax({
		url: 'index.php?action=addToCart&productId='+id+'&quantity='+Quantity+'&output=1',
		type: 'GET',
		dataType: 'json',
		success: function(json) {
			if (json['code'] == 'success') {	// Modal de succès
				$("#modal_message_success").html("<span><img src=\"assets/img/success.png\" style=\"width: 7%; height: 7%;\" />&nbsp; L'article <b>" + Name + " x" + Quantity + "</b> a été ajouté au panier.</span>");
				//$("#myModal2").modal("show");
			} else {							// Modal d'erreur
				$("#modal_message_error").html("<span><img src=\"assets/img/danger.png\" style=\"width: 7%; height: 7%;\" />&nbsp; Une erreur est survenue. Veuillez réesayer ultérieurement.</span>");
				//$("#myModal3").modal("show");
			}
		}
	});
}
