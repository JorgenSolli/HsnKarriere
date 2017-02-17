$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();

	$(".dashboard-sidebar .sidebar-item").on('click', function() {
		var param = $(this).attr('id');
		container = $("#data");
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