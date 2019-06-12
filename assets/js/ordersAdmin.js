// ------------------------------------------------
// AlgoBreizh Script de la validation des commandes
// ------------------------------------------------


// Paramètres du DataTable
$(document).ready(function() {
	$("#orderTable").DataTable({
		stateSave: true,
		ordering: false,
		deferRender: false,
		bFilter: false,
  		bLengthChange: false,
		responsive: true,
		page: true,
		pagingType: 'simple',
		language: {
			url: 'assets/json/french.orderAdm.json'
		},
	  	aoColumns: [
		   { bSortable: true },
		   { bSortable: true },
		   { bSortable: false },
		   { bSortable: false }
	  	],
		processing: true,
	  	serverSide: false
	});
});
