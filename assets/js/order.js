// --------------------------------------------
// AlgoBreizh Script d'une commande utilisateur
// --------------------------------------------


// Paramètres du DataTable
$(document).ready(function() {
	$("#orderContentTable").DataTable({
		stateSave: true,
		ordering: false,
		deferRender: false,
		bFilter: false,
  		bLengthChange: false,
		responsive: true,
		bPaginate: true,
		iDisplayLength: 5,
		language: {
			url: 'style/french.order.json'
		},
	  	aoColumns: [
		   { bSortable: true },
		   { bSortable: true },
		   { bSortable: true },
		   { bSortable: true },
		   { bSortable: true }
	  	],
		processing: true,
	  	serverSide: false
	});
});
