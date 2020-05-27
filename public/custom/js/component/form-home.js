$(document).ready(function() {
	// Validate form login and submit
	$('#form-login').validate({
	    rules: {
	        "custom[]": {
	        	required: true,
	        }
	    },
	    messages: {
	        "custom[]": {
	        	required: "Không được để trống"
	        },
	    },

	    // submitHandler: function(form) {
	    //     $.ajax({
	    //         url: form.action,
	    //         type: form.method,
	    //         data: $(form).serialize(),
	    //         success: function(response) {
	    //             $('#answers').html(response);
	    //         }            
	    //     });
	    // }
	});
});