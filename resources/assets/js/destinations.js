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
			loadingMessage: "<div class='loader' style='margin: 20px auto'></div>"
		});
	});
};

DESTINATIONS.getGoeCode = function(location){
	var data = {};
    data["location"] = location;
    return $.ajax({
      url: "/getgeocode",
      type: "post",
      data: data
    });
};

DESTINATIONS.updateStatus = function(id, status){
	var data = {};
	data["id"] = id;
	data["status"] = status;
	data["_token"] = token;
	return $.ajax({
		url: "/destinations/updateStatus/" + id + "/" + status,
		type: "post",
		data: data
	});
};