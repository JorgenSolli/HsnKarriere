$(document).ready(function() {
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


// Mare SURE the user wants to do this action
$(document).on('click', '.submitBtn', function(e) {
	var form = $(this).closest('form');
	var msg  = $(form).children('.confirmMsg').val();
	console.log(msg);

	bootbox.confirm({
		size: 'small',
		message: '<p class="h4">' + msg + '<p>',
		buttons: {
			confirm: {
				label: 'Godkjenn',
				className: 'btn-success'
			},
			cancel: {
				label: 'Avbryt',
				className: 'btn-danger'
			}
		},
		callback: function(result) {
			if (result) {
				form.submit();
			}
		}
	});
});