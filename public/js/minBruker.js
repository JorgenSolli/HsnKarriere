var loading = '<div class="text-center">' + 
	'<span class="fa fa-circle-o-notch fa-spin fa-3x"></span>' +
	'<p class="h5">Laster inn brukere</p></div>';
var container = $("#users-data");

// Ajax Sorting List
$("#sortList").on('click', function() {
	container.html(loading);
	$.ajax({
		type: 'GET',
		url: 'ajax/sort/list', 
		success: function(data) {
			container.html(data['users-list']);
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
		url: 'ajax/sort/cards', 
		success: function(data) {
			container.html(data['users-cards']);
			$("#sortCards").addClass('active');
			$("#sortList").removeClass('active');
		}
	});
});