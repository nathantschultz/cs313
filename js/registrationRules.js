/* Registration Rules */

$().ready(function() {

	// validate signup form on keyup and submit
	$("#contentCreator").validate({
		rules: {
			title: {
				required: true,
				maxlength:15,
				},
				
			section: "required"
		},
		messages: {
			title: {
				required: "Please provide a title.",
				maxlength: "Your title must be less than 16 characters long."
			},
			
			section: "You must include a section."
			
		}
	});
	
	$("#People").validate({
		rules: {
			firstname: "required",
			lastname: "required",
			
			password: {
				required: true,
				minlength: 8,
			},
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			firstname: "Please enter your firstname",
			lastname: "Please enter your lastname",
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 8 characters long"
			},
			email: "Please enter a valid email address"
		}
	});

});