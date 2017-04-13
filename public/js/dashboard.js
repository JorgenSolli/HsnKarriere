$(document).ready(function() {
	$(document).on('change', ':file', function() {
	    var input = $(this);
	    var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

	    $(this).closest('.input-group').find('.inputFile').text(label);
	    $(this).closest('.input-group').find('button').removeClass('disabled');
	});

	$('[data-toggle="tooltip"]').tooltip();
	var loading = "<div class='text-center'><span class='fa fa-circle-o-notch fa-spin fa-4x'></span></div>";

	$(".dashboard-menu .menu-item").on('click', function() {
		var param = $(this).attr('id');
		container = $("#data");
		container.html(loading);
		$.ajax({
			metod: 'GET',
			headers: {
	        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
			url: '/oversikt/' + param,

			success: function(data) {
				container.html(data['data']);
			}
		})
	});
});

$(".toggleList").on('click', function() {
	var ul = $(this).closest('ul');
	$(ul).find('.toggleMe').slideToggle(150);
});