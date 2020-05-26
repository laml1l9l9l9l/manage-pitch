$(document).ready(function() {
	if($('#increase-price').is(':checked'))
	{
		$('#time-increase-price').parent('div').parent('div').removeClass('d-none');
	}
	else
	{
		$('#time-increase-price').parent('div').parent('div').addClass('d-none');
	}

	$('#increase-price, #manually').click(function () {
		if($('#increase-price').is(':checked'))
		{
			$('#time-increase-price').parent('div').parent('div').removeClass('d-none');
		}
		else
		{
			$('#time-increase-price').parent('div').parent('div').addClass('d-none');
		}
	});
});