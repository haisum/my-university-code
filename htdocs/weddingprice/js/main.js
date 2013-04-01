$(document).ready(function(){
	
	if($('.vticker1').length > 0){
		$('.vticker1').vTicker({
		   speed: 800,
		   pause: 3000,
		   showItems: 2,
		   animation: 'fade',
		   mousePause: true,
		   height: 0,
		   direction: 'up'
		});
	}
	$('.numberOnly').live('keydown', function(e){
			if((e.which>47 && e.which < 58) || (e.which>95 && e.which < 106)  || e.which == 46 || e.which == 8 || e.which == 9)
				return true;
			else
				return false;
		});
   $('.lgn-btn').click(function(e){
       $wrp = $('.lgn-wrp');
       switch($wrp.css('display')){
           case 'block':
               $wrp.slideUp();
               $(this).css('background-position', '0px 100%');
               break;
           default:               
               $('.reg-wrp').slideUp();
               $('.reg-btn').css('background-position', '0px 100%');
               $wrp.slideDown();
               $(this).css('background-position', '0px 0%');
               break;
       }
      
   });
   $('.reg-btn').click(function(e){
       $wrp = $('.reg-wrp');
       switch($wrp.css('display')){
           case 'block':
               $wrp.slideUp();
               $(this).css('background-position', '0px 100%');
               break;
           default:
               $('.lgn-wrp').slideUp();
               $('.lgn-btn').css('background-position', '0px 100%');
               $wrp.slideDown();
               $(this).css('background-position', '0px 0%');
               break;
       }
      
   }); 
   $('.footer_signup_submit').hover(function(){
       $(this).css('background-color', '#0192B5');
   },
    function(){
        $(this).css('background-color', '#55A4F2');
    });		
	$("#register-supplier-form, #register-buyer-form, #reset-form,#login-form,#reg-form,#forgot-pass-form,#register-login-form,#contact-support-form,#change-pass-form").each(
		function(){
			if($(this)!=undefined && $('.freediv').length == 0 ){
				$(this).validationEngine('attach');
			}
		}
	);
	if(typeof countryJSON != 'undefined'){
		
		$('.countries').bind('change', function(){
			var selectedId = $('.countries>option:selected').attr('rel');
			var regions = "";
			countryRegions = countryJSON[selectedId].regions;
			for(i=0; i<countryRegions.length;i++){
				regions += "<option value='" + countryRegions[i].id + "'>" + countryRegions[i].name + "</option>";
			}
			$('.regions').html(regions);			
			$('#country').val($('.countries>option:selected').val());
			$('#primaryRegion').val($('.regions>option:selected').val());
		});
		/*var selectedId = $('.countries>option:selected').val();
		var regions = "";
		var countryRegions = countryJSON[selectedId].regions;
		for(i=0; i<countryRegions.length;i++){
			regions += "<option value='" + countryRegions[i].id + "'>" + countryRegions[i].name + "</option>";
		}*/
		$('.regions').bind('change', function(){
			$('#primaryRegion').val($('.regions>option:selected').val());
		});
		$('#primaryCategorySelect').bind('change', function(){
			$('#primaryCategory').val($('#primaryCategorySelect>option:selected').val());
		});
		/*$('#country').val(selectedId+1);
		$('#primaryRegion').val($('.regions>option:selected').val());*/
	}
	$('.accountType').bind('click', function(){
		$('.golddiv,.freediv').toggle();
		//alert('booh');	
	});
});
function register(){
		var error = false;
		var message = "";
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		var emailVal = $('#email_reg').val();
		if($.trim(emailVal)==''){
			message+="Email Can't be empty";
			error = true;
		}
		else if(!emailReg.test(emailVal)){
			message+="Invalid Email";
			error = true;
		}
		if(!error){
			$.post(APP_URL + '/ajax/register.php', {email_reg : $('#email_reg').val()}, function(html){
				$('#reg_msg').html(html);
				window.setTimeout(function(){
					$('.reg-btn').click();
				}, 7000);
			});
		}
		else{
			$('#reg_msg').html("<p>" + message + "</p>");
		}
}
function login(){
	var error = false;
		var message = "";
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		var emailVal = $('#email').val();
		if($.trim(emailVal)==''){
			message+="Email Can't be empty";
			error = true;
		}
		else if(!emailReg.test(emailVal)){
			message+="Invalid Email";
			error = true;
		}
		if($.trim($('#password').val()) == ''){
			message+="<br/>Empty Password";
			error = true;
		}
		if(!error){
			$.post(APP_URL + '/ajax/login.php', {email : $('#email').val(), password: $('#password').val(), remember: $('#loginpermanent').prop('checked')}, function(html){
				if(html == "true"){
					$('#login_msg').html("<p>You have successfully logged in. System will now redirect you to your accounts page</p>");
					window.location.href = APP_URL + "/account.php";
				}
				else{
					$('#login_msg').html('Incorrect Email/Password or account banned.');
				}
				//$('#login_msg').html(html);
				//alert(html);
				//alert(APP_URL);
			});
		}
		else{
			$('#login_msg').html("<p>" + message + "</p>");
		}
}
/*.fbSettingsListLink*/


