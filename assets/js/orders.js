// -------------------------------------------
// AlgoBreizh Script des commandes utilisateur
// -------------------------------------------


// Paramètres du DataTable
$(document).ready(function() {
	$("#orderTable").DataTable({
		"stateSave": true,
		"ordering": false,
		"deferRender": false,
		"bFilter": false,
  		"bLengthChange": false,
		"responsive": true,
		"page": true,
		"pagingType": "scrolling",
		"language": { 
			"url": 'assets/json/french.order.json'
		},
	  	"aoColumns": [
		   {"bSortable": true},
		   {"bSortable": true},
		   {"bSortable": true},
		   {"bSortable": true},
		   {"bSortable": true}
	  	],
		"processing": true,
	  	"serverSide": false,
	});
});
