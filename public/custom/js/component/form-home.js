$(document).ready(function() {
	$('#btn-login').click(function(e) {
		e.preventDefault();
		var _token   = $('input[name="_token"]').val();
		var email    = $('#email_custom_login').val();
		var password = $('#password_custom_login').val();
		console.log({
			email: email,
			password: password,
		});
		$.ajax({
			url: urlLogin,
			type: 'POST',
			dataType: 'json',
			data: {
				_token: _token,
				email: email,
				password: password,
			},
			success: function(data)
			{
				if (data.success) {
					alert(data.success);
    				$('#modalLogin').modal('hide');
    				$('input[name="_token"]').val(data._token);
    				submitFormCreateBill();
				}
				else {
					var error = data.error;
					alert(data.error);
				}
			}	
		});
	})
});