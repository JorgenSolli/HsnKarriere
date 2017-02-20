$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();
	var loading = "<div class='text-center'><span class='fa fa-circle-o-notch fa-spin fa-4x'></span></div>";

	$(".dashboard-menu .menu-item").on('click', function() {
		var param = $(this).attr('id');
		container = $("#data");
		container.html(loading);
		$.ajax({
			metod: 'GET',
			url: '/oversikt/' + param,

			success: function(data) {
				console.log(data['data']);
				container.html(data['data']);
			}
		})
	});
});