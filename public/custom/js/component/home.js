$(document).ready(function() {
	// Return show select date
	$('#return-select-date').click(function() {
		showHiddenRow('#row-calendar', '#row-pitch');
	});

	$('#return-select-pitch').click(function() {
		showHiddenRow('#row-pitch', '#row-time');
	});


	// Select pitch
	$('.img-pitch').click(function() {
		// Make validate

		showHiddenRow('#row-time', '#row-pitch');

    	// get pitch to form
		var rent_pitch = $(this).attr('data-pitch');
		$('#pitch-rent').val(rent_pitch);
	});


	// Select time
	$('#select-time').change(function() {
		// Make validate

    	// get pitch to form
		$('#time-slot-rent').val(this.value);
	});

    // Show when finish select time
    $('#modalLogin').modal('show');

	function showHiddenRow(selector_show, selector_hidden) {
		$(selector_hidden).addClass('d-none');
		if($(selector_show).hasClass('d-none')){
			$(selector_show).removeClass('d-none');
			animateOpacity(selector_show);
		}

		titleScrollIntoView();
	}

	function titleScrollIntoView() {
		var row_title = document.getElementById('row-title');
		row_title.scrollIntoView({behavior: 'smooth'});
	}

	function animateOpacity(selector) {
		$(selector).animate({opacity: "0.2"});
		$(selector).animate({opacity: "1"});
	}


	// Show modal
	$('.btn-register').click(function() {
		$('#modalLogin').modal('hide');
		$('#modalForgotPassword').modal('hide');
	});

	$('.btn-login').click(function() {
		$('#modalRegister').modal('hide');
		$('#modalForgotPassword').modal('hide');
	});

	$('.btn-forgot-password').click(function() {
		$('#modalRegister').modal('hide');
		$('#modalLogin').modal('hide');
	});
});