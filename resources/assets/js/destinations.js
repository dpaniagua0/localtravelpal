var DESTINATIONS = DESTINATIONS || {};


DESTINATIONS.searchByCategory = function(categories, sortBy) {
	var data = ($(categories).length > 0)? categories : -1;
	var sortOption = sortBy;

	$.ajax({
		url: "/filterbycategories",
		type: "post",
		data: {categories: data, sort: sortOption },
		beforeSend: function(){
			$(".result-destinations").html('<div class="loader" style="margin: 0 auto; "></div>');
		}
	}).done(function(response){
		setTimeout(function(){
			$(".result-destinations").html(response);
		}, 1000);
	});
};

DESTINATIONS.loadGallery = function(){
	$("body").on('click','*[data-toggle="lightbox"]', function(event) {
		event.preventDefault();
		return $(this).ekkoLightbox({
		/*	onShown: function() {
				if (window.console) {
					return console.log('onShown event fired');
				}
			},
			onContentLoaded: function() {
				if (window.console) {
					return console.log('onContentLoaded event fired');
				}
			},
			onNavigate: function(direction, itemIndex) {
				if (window.console) {
					return console.log('Navigating '+direction+'. Current item: '+itemIndex);
				}
			}*/
		});
	});
};