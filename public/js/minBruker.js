// Loads proper tab if we asks for it
$(document).ready(function(e) {
	e.preventDefault;
	if (window.location.hash == "#studenter") {
		$('.nav-tabs a[href="#studenter"]').tab('show');
	}
});


