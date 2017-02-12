var loading = '<div class="text-center">' + 
	'<span class="fa fa-circle-o-notch fa-spin fa-3x"></span>' +
	'<p class="h5">Laster inn brukere</p></div>';
var container = $("#users-data");

// Ajax Sorting List
$("#sortList").on('click', function() {
	container.html(loading);
	$.ajax({
		type: 'GET',
		url: 'users/showUsers/list', 
		success: function(data) {
			container.html(data['data']);
			$("#sortList").addClass('active');
			$("#sortCards").removeClass('active');
		}
	});
});

// Ajax sorting Cards
$("#sortCards").on('click', function() {
	container.html(loading);
	$.ajax({
		type: 'GET',
		url: 'users/showUsers/cards', 
		success: function(data) {
			container.html(data['data']);
			$("#sortCards").addClass('active');
			$("#sortList").removeClass('active');
		}
	});
});

// Ajax for searcing the cards
$("#search-users-submit").on('submit', function(e) {
	e.preventDefault();
	var postUrl;
	var searchString = $("#search-string").val();

	if ($("#sortCards").attr('class').indexOf("active") >= 0) {
		postUrl = 'users/showUsers/cards';
	} else {
		postUrl = 'users/showUsers/list';
	}
	
	container.html(loading);
	$.ajax({
		type: 'GET',
		url: postUrl,
		data: {
			searchString: searchString,
			searching: true
		},
		success: function(data) {
			container.html(data['data']);
		}
	});

});