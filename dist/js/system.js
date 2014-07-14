$("[data-toggle='date-picker']").datepicker({});

$("[data-toggle='time-picker']").timepicker();

//$("#time").timepicker();

$(function() {
	$("[data-toggle='tooltip']").tooltip();
});
$(function() {
	$("[data-toggle='popover']").popover();
});

$(document).ready(function() {
	
	var defaults = {
			containerID: 'toTop', // fading element id
		containerHoverID: 'toTopHover', // fading element hover id
		scrollSpeed: 1200,
		easingType: 'linear' 
		};
	$().UItoTop({ easingType: 'easeOutQuart' });
	
});


// password
$(document).ready(function() {
	var dt = $('#passwordDatatable').dataTable( {
		
		"bSort": false,       // Disable sorting
		"iDisplayLength": 20,   //records per page
		"sDom": "t<'row'<'col-md-6'i><'col-md-6'p>>",
		"sPaginationType": "bootstrap"
	});
});

// new password form
$(document).ready(function() {
	
	
    $('#loginForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        
        
        submitHandler: function(validator, form, submitButton) {
        	
            console.log('handler clicked');
            
        
            
            $.post(form.attr('action'), form.serialize(), function(result) {
                // The result is a JSON formatted by your back-end
                // I assume the format is as following:
                //  {
                //      valid: true,          // false if the account is not found
                //      username: 'Username', // null if the account is not found
                //  }
                if (result.valid == true || result.valid == 'true') {
                	// do after we push data
                    $('#newPasswordModal').modal('hide');
                    $('#loginForm').bootstrapValidator('resetForm', true);
                    setSuccessMsg('The Password was Saved');
                } else {
                    // The account is not found
                    // Show the errors
                    $('#errors').html('The account is not found').removeClass('hide');

                    // Enable the submit buttons
                    $('#loginForm').bootstrapValidator('disableSubmitButtons', false);
                }
            }, 'json');
        },
        
        fields: {
        	title : {
        		validators: {
        			notEmpty: {
        				message: 'The Title is required'
        			}
        		}
        	},
        	location : {
        		validators: {
        			notEmpty: {
        				message: 'The Location is required'
        			}
        		}
        	},
        	
            username: {
                validators: {
                    notEmpty: {
                        message: 'The username is required'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    }
                }
            }
        }
    });
});

function setSuccessMsg(msg) {
	$('#flashMessenger').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>' + msg + '</div>');
    $(".alert").alert();
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 2000);
}

