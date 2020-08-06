$('.card').on('click', function(){
   	let checkbox = $(this).find('input[type="checkbox"]');
   	checkbox.prop('checked', !checkbox.prop('checked'));

	let date   = checkbox.data('date');
	let pitch  = checkbox.data('pitch');
	let time   = checkbox.data('time');
	let amount = checkbox.data('amount');
	let array_data = [];

   	if(checkbox.prop('checked')){
		array_data['date']   = date;
		array_data['pitch']  = pitch;
		array_data['time']   = time;
		array_data['amount'] = amount;
   		addVisualDetailBill(array_data);
   	} else {
		array_data['date']   = date;
		array_data['pitch']  = pitch;
		array_data['time']   = time;
		array_data['amount'] = amount;
   		removeVisualDetailBill(array_data);
   	}
});

$('#confirm-suggest-bill').click(() => {
	checkAuthenticate();
});

function addVisualDetailBill(array) {
	$.ajax({
		url: routeAddVisualDetailBill,
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
		type: 'POST',
		dataType: 'json',
		data: {
			date: array['date'],
			pitch: array['pitch'],
			time: array['time'],
			amount: array['amount']
		},
		success: function(data) { console.log('success') },
  		error: function(ts) { console.log(ts.responseText) }
	});
	
}

function removeVisualDetailBill(array) {
	$.ajax({
		url: routeRemoveVisualDetailBill,
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
		type: 'POST',
		dataType: 'json',
		data: {
			date: array['date'],
			pitch: array['pitch'],
			time: array['time'],
			amount: array['amount']
		},
		success: function(data) { console.log('success') },
  		error: function(ts) { console.log(ts.responseText) }
	});
	
}

function checkAuthenticate() {
	var information = null;

	$.ajax({
    	async: false,
		url: urlGetInformation,
		type: 'GET',
		dataType: 'json',
		data: {},
        success: function(response) {
        	information = response;
        }
	});

	
	if(information){
		redirectConfirmBills();
	}else{
		$('#modalLogin').modal('show');
	}
}

// Form view
$('.btn-register').click(function() {
	$('#modalLogin').modal('hide');
	$('#modalForgotPassword').modal('hide');
});

$('#btn-login').click(function(e) {
	e.preventDefault();
	loginCustomer();
})

$('#email_custom_login, #password_custom_login').keypress(function (e) {
	if (e.which == 13) {
		e.preventDefault();
		loginCustomer();
	}
});

function loginCustomer() {
	var _token   = $('input[name="_token"]').val();
	var email    = $('#email_custom_login').val();
	var password = $('#password_custom_login').val();

	$.ajax({
		url: urlLogin,
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
		type: 'POST',
		dataType: 'json',
		data: {
			email: email,
			password: password,
		},
		success: function(data)
		{
			if (data.success) {
				alert(data.success);
				$('#modalLogin').modal('hide');
				$('input[name="_token"]').val(data._token);
				redirectConfirmBills();
			}
			else {
				var error = data.error;
				alert(data.error);
			}
		}	
	});
}

function redirectConfirmBills() {
	window.location.replace(urlConfirmBills);
}