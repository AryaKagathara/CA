jQuery('#login_btn').click(function(e){
			 
	e.preventDefault();			   
	var username = jQuery('.username').val();	
	var password = jQuery('.passwordr').val();
	var c_response = jQuery('#cf-chl-widget-40nhd_response').val();
	var cn_response = jQuery('#cf-chl-widget-40nhd_g_response').val();
	if(username == ''){ jQuery('.username').addClass('error'); }else{ jQuery('.username').removeClass('error'); }
	if(password == ''){ jQuery('.passwordr').addClass('error'); }else{ jQuery('.passwordr').removeClass('error'); }
	if(c_response == '' && cn_response == ''){
		jQuery('.cf-turnstile iframe').css('border','2px solid red');
	}else{
		jQuery('.cf-turnstile iframe').css('border','0px solid red');
		jQuery.ajax({
			type   : 'POST',
			url    : ca_ajax_object.ajax_url,
			data   : {
				username:username,
				password:password,
				action: 'login_forms',
			},
			dataType: "json",
			success: function(response){
				if(response.error_message){
					jQuery('.username').removeClass('error');
					jQuery('.passwordr').removeClass('error');
					jQuery('.login_error_message').html(response.error_message);
				}
				if(response.success){
					window.location = "https://w3n.xyz/projects/CA/dashboard/";
				}
			}
		});
	}
});


jQuery(document).ready(function () {
	jQuery('.client_add_btn').click(function(){

		const validateEmail = (email) => {
			return email.match(
			/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
			);
		};

		var type_form = jQuery('input[name="type_form"]:checked').val();
		var company_type = jQuery('#company_type').val();
		var resident_type = jQuery('#resident_type').val();
		var username = jQuery('input[name="username"]').val();
		var name = jQuery('input[name="names"]').val();
		var email = jQuery('input[name="email"]').val();
		var phone_number = jQuery('input[name="phone_number"]').val();
		var password = jQuery('input[name="password"]').val();
		var confirm_password = jQuery('input[name="confirm_password"]').val();

		if(username){ 
			jQuery('input[name="username"]').removeClass('error'); 
			jQuery('#username_typer').hide();
		}else{ 
			jQuery('input[name="username"]').addClass('error');
			jQuery('#username_typer').show();
		}

		if(name){ 
			jQuery('input[name="names"]').removeClass('error'); 
			jQuery('#names_typer').hide();
		}else{ 
			jQuery('input[name="names"]').addClass('error'); 
			jQuery('#names_typer').show();
		}

		if(email){ 
			jQuery('input[name="email"]').removeClass('error'); 
			jQuery('#email_typer').hide();
		}else{ 
			jQuery('input[name="email"]').addClass('error'); 
			jQuery('#email_typer').show();
		}
		
		if(type_form){ 
			jQuery('#types_form').hide(); 
		}else{ 
			jQuery('#types_form').show(); 
		}

		if(type_form == 'company'){
			if(company_type){ 
				jQuery('#company_type').parent().find('.nice-select').removeClass('error'); 
				jQuery('#company_typer').hide();
			}else{ 
				jQuery('#company_type').parent().find('.nice-select').addClass('error'); 
				jQuery('#company_typer').show();
			}
		}

		if(resident_type){ 
			jQuery('#resident_type').parent().find('.nice-select').removeClass('error'); 
			jQuery('#resident_typer').hide();
		}else{ 
			jQuery('#resident_type').parent().find('.nice-select').addClass('error'); 
			jQuery('#resident_typer').show();
		}

		if(phone_number){ 
			jQuery('input[name="phone_number"]').removeClass('error'); 
			jQuery('#phone_typer').hide();
		}else{ 
			jQuery('input[name="phone_number"]').addClass('error'); 
			jQuery('#phone_typer').show();
		}

		if(password){ 
			jQuery('input[name="password"]').removeClass('error'); 
			jQuery('#password_typer').hide();
		}else{ 
			jQuery('input[name="password"]').addClass('error'); 
			jQuery('#password_typer').show();
		}

		var checks = '';
		if(confirm_password){ 
			jQuery('input[name="confirm_password"]').removeClass('error'); 
			jQuery('#confirmpass_typer').hide();
		}else{ 
			jQuery('input[name="confirm_password"]').addClass('error'); 
			jQuery('#confirmpass_typer').show();
		}
		if(password == confirm_password){
			jQuery('input[name="confirm_password"]').removeClass('error');
			var checks = '1';
		}else{
			jQuery('input[name="confirm_password"]').addClass('error');
		}

		if(username == '' && name == '' && type_form == '' && resident_type == '' && email == '' && phone_number == '' && password == '' && confirm_password == ''){
			
		}else{
			var valid = '';
			if(validateEmail(email)){
				jQuery('input[name="email"]').removeClass('error');
				var valid = 'true';
			}else{
				jQuery('input[name="email"]').addClass('error');
			}
			if(valid != '' && checks != ''){
				jQuery("#client_add").submit();
			}
		}
	});

	jQuery('.client_edit_btn').click(function(){

		const validateEmail = (email) => {
			return email.match(
			/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
			);
		};

		var type_form = jQuery('input[name="type_form"]:checked').val();
		var company_type = jQuery('#company_type').val();
		var resident_type = jQuery('#resident_type').val();
		var name = jQuery('input[name="names"]').val();
		var email = jQuery('input[name="email"]').val();
		var phone_number = jQuery('input[name="phone_number"]').val();

		if(name){ jQuery('input[name="names"]').removeClass('error'); }else{ jQuery('input[name="names"]').addClass('error'); }

		if(email){ jQuery('input[name="email"]').removeClass('error'); }else{ jQuery('input[name="email"]').addClass('error'); }

		if(type_form){ jQuery('#types_form').hide(); }else{ jQuery('#types_form').show(); }

		if(company_type){ jQuery('#company_type').parent().find('.nice-select').removeClass('error'); }else{ jQuery('#company_type').parent().find('.nice-select').addClass('error'); }

		if(resident_type){ jQuery('#resident_type').parent().find('.nice-select').removeClass('error'); }else{ jQuery('#resident_type').parent().find('.nice-select').addClass('error'); }

		if(phone_number){ jQuery('input[name="phone_number"]').removeClass('error'); }else{ jQuery('input[name="phone_number"]').addClass('error'); }

		if(name == '' && type_form == '' && resident_type == '' && email == '' && phone_number == ''){
			alert('error');
		}else{
			var valid = '';
			if(validateEmail(email)){
				jQuery('input[name="email"]').removeClass('error');
				var valid = 'true';
			}else{
				jQuery('input[name="email"]').addClass('error');
			}
			if(valid != ''){
				jQuery("#client_edit").submit();
			}
		}
	});

});