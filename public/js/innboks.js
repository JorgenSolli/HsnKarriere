$(document).ready(function() {
	$("#newMessage").on('click', function() {
		var container = $("#newOrRead");
		var loading = $(".ajaxLoading");

		loading.show();
		$.ajax({
            type: 'GET',
            url: 'innboks/newMessage/', 
            success: function(data) {
            	loading.hide();
                $(".ajaxLoading").remove();
                container.html(data['data']);
                $('.select2').select2({
                	maximumSelectionLength: 2
                });
            }
        });
	});

	$("#messages a").on('click', function() {
		var container = $("#newOrRead");
		var loading = $(".ajaxLoading");
		var id = $(this).attr('id');
		loading.show();

		// Resets the active color on your message
		$("#messages a").removeClass('active');

		$.ajax({
			type: 'GET',
			url: 'innboks/seeMessage/' + id,
			success: function(data) {
				$("#" + id).addClass('active');
				loading.hide();
				container.html(data['data']);
			}
		})
		console.log(id);
	});
});