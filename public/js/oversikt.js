$(document).ready(function(){
	$(document).on('change', ':file', function() {
	    var input = $(this);
	    var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

	    $(this).closest('.input-group').find('.inputFile').text(label);
	    $(this).closest('.input-group').find('button').removeClass('disabled');
	});
});