$(document).ready(function() {

	var newMessage = function () {
		var container = $("#newOrRead");
		container.html("");
		var loading = $(".ajaxLoading");
		var id = null;

		if (window.location.hash.substr(1)) {
			var hash = window.location.hash.substr(1);
			var id = hash.slice(4);
		}

		loading.show();
		$.ajax({
            type: 'GET',
            url: '/innboks/newMessage/', 
            data: {
            	reciepment: id
        	},
            success: function(data) {
            	loading.hide();
                $(".ajaxLoading").remove();
                container.html(data['data']);
                $('.select2').select2({
                	maximumSelectionLength: 2
                });
            }
        });
	};

	$("#newMessage").on('click', function() {
		newMessage();
	});

	var addUser = function (messageId) {
		var container = $("#addUserSelect");
		container.html("");
		var loading = $(".selectAjaxLoading");

		loading.show();
		$.ajax({
            type: 'GET',
            url: 'innboks/findUsers/' + messageId,
            success: function(data) {
            	loading.hide();
                $(".ajaxLoading").remove();
                container.html(data['data']);
            }
        });
	}
	
	$(document).on('click', '#addUser', function() {
		var messageId = $(this).children().attr('id');
		addUser(messageId);
	});

	var seeMessage = function(id) {
		var container = $("#newOrRead");
		container.html("");
		var loading = $(".ajaxLoading");
		loading.show();

		// Resets the active color on your message
		$("#messages a").removeClass('active');
		$.ajax({
			type: 'GET',
			url: '/innboks/seeMessage/' + id,
			success: function(data) {
				$("#" + id).addClass('active');
				loading.hide();
				container.html(data['data']);
			}
		});
	};

	$("#messages a").on('click', function() {
		var id = $(this).attr('id');
		seeMessage(id);
	});

	// Load message if notification is clicked from /innboks
	$(window).on('hashchange', function() {
		var hash = window.location.hash.substr(1);
		var id = hash.slice(3);
		seeMessage(id);
	});

	// gets the message on page-load
	if (window.location.hash.substr(1).includes('msg')) {
		var hash = window.location.hash.substr(1);
		var id = hash.slice(3);
		seeMessage(id);
	}

	// pre-loads new message with reciepment and topic
	if (window.location.hash.substr(1).includes('send')) {
		newMessage();
	}
}); // Close document ready