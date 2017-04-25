var loading = '<div class="text-center">' + 
	'<span class="fa fa-circle-o-notch fa-spin fa-3x"></span>' +
	'<p class="h5">Laster inn brukere</p></div>';
var container = $("#users-data");

// Ajax Sorting List
$("#sortList, #sortCards, #search-users-submit button").on('click', function() {
	if ($(this).attr('id') == 'sortCards') {
		$("#sortCards").addClass('active');
		$("#sortList").removeClass('active');
	} 
	else if ($(this).attr('id') == 'sortList') {
		$("#sortList").addClass('active');
		$("#sortCards").removeClass('active');
	}

	search(true);
});

// Searching = boolean
var search = function (searching) {
	if ($("#sortCards").attr('class').indexOf("active") >= 0) {
		var display = 'cards';
	} else {
		var display = 'list';
	}
	var searchString = $("#search-string").val();
	var sort = $("#sort-category select").val();
	container.html(loading);
	$.ajax({
		url: 'users/showUsers',
		headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
        	searchString: searchString,
        	searching: searching,
        	display: display,
        	sort: sort
        },
        success: function(data) {
			container.html(data['data']);
		}
	})
}

$(document).ready(function() {
	var panel = $("#bio-panel");

	if ( panel.length ) {
		// Adds the padding as well
		var bioHeight = panel.height() + 30;

		if (bioHeight < 230) {
			panel.css('height', '230px');
		}
	}

	var hash = window.location.hash.substr(1)

	if (hash == "bedrifter") {
		$('#brukerTabs a[href="#bedrifter"]').tab('show')
	} 
	else if (hash == "kontakter") {
		$('#brukerTabs a[href="#mine-kontakter"]').tab('show')
	} 
	else if (hash == "studenter") {
		$('#brukerTabs a[href="#studenter"]').tab('show')
	} 
	else {
		$('#brukerTabs a[href="#min-profil"]').tab('show')
	}

	// Hides the loadng adn removes the hash value after use
	$("#panel-loading").hide()
	if (hash) {
		parent.location.hash = ''
	}
});