var DESTINATIONS = DESTINATIONS || {};



DESTINATIONS.searchByCategory = function(categories) {
	var data = ($(categories).length > 0)? categories : -1;

	$.ajax({
		url: "/filterbycategories",
		type: "post",
		data: {categories: data},
		beforeSend: function(){
			$(".result-destinations").html('<div class="loader" style="margin: 0 auto; "></div>');
		}
	}).done(function(response){
		setTimeout(function(){
			$(".result-destinations").html(response);
		}, 1000);
	});
};