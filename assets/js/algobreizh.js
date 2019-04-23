// -----------------------------------
// AlgoBreizh Script du gabarit commun
// -----------------------------------


// Affiche le nom de l'utilisateur de la session
$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();
});
$.ajax({
	url: 'index.php?action=isUserLogged',
	type: 'GET',
	dataType: 'json',
	success: function(json) {
		if (json['code'] == 'logged') {
			if ($(".pageTitle").html() == "Accueil") {
				$(".pageTitle").html("Bonjour "+json['firstname']+ "!");
			}
			var loginTitle = "Session: ";
			setTimeout(function(){
				if (json['firstname'].toUpperCase() == json['lastname'].toUpperCase()) {
					$(".login").attr("data-original-title", loginTitle +" "+ json['firstname'].toUpperCase());
				} else if (json['firstname'] && json['lastname']) {
					$(".login").attr("data-original-title", loginTitle +" "+ json['firstname'].toUpperCase() +" "+ json['lastname'].toUpperCase());
				} else {
					$(".login").attr("data-original-title", loginTitle + "UTILISATEUR");
				}
			}, 100);
		}
	}
});
