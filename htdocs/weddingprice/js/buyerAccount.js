function showEdit(linkObj, block){
	switch(block){
		case 'address':
			var optionsHTML = "";
			for(i=0;i<buyer.primaryRegionOptions.length;i++){
				optionsHTML += "<option value='" + buyer.primaryRegionOptions[i].value + "' " + buyer.primaryRegionOptions[i].selected +">" + buyer.primaryRegionOptions[i].text +"</option>";
			}				
			$('#primaryRegion').html(optionsHTML);
			$('#address').val(buyer.address);
			$('#address2').val(buyer.address2);
			$('#zip').val(buyer.zip);
			$('#city').val(buyer.city);
		break;
		case 'contactPerson':
			$('#contactPerson').val(buyer.contactPerson);
		break;
		case 'emails':
			$('#contactEmail').val(buyer.contactEmail);
		break;
		case 'phone':
			$('#phone').val(buyer.phone);
		break;
		case 'name':
			$('#name').val(buyer.name);
		break;
	}
	$(linkObj).slideUp().next('.fbcontent').slideDown();
}
function saveEdit(formObj, block){	
	$('.editErrorMessage').slideUp('fast',function(){$(this).remove();});
	updateObj = new Object();
	switch(block){
		case 'address':			
			var primaryRegionId = $('#primaryRegion>option:selected').val();
			var address = $('#address').val();
			var address2 = $('#address2').val();
			var zip = $('#zip').val();
			var city = $('#city').val();
			updateObj = {
				"action" : "address",
				"data" : {
					"primaryregionId" : primaryRegionId,
					"address" : address,
					"address2" : address2,
					"zip" : zip,
					"city" : city
				}
			};
		break;
		case 'contactPerson':
			var newContactPerson = $('#contactPerson').val();			
			updateObj = {
				"action" : "contactPerson",
				"data" : {
					"contactPerson" : newContactPerson
				}
			};
		break;
		case 'emails':
			var newEmail = $('#contactEmail').val();
			updateObj = {
				"action" : "emails",
				"data" : {
					"contactEmail" : newEmail
				}
			};			
		break;
		case 'phone':
			var newPhone = $('#phone').val();
			updateObj = {
				"action" : "phone",
				"data" : {
					"phone" : newPhone
				}
			};	
		break;
		case 'name':
			var newName = $('#name').val();
			updateObj = {
				"action" : "name",
				"data" : {
					"name" : newName
				}
			};	
		break;
		case 'password':
			var currentPassword = $('#currentPassword').val();
			var newPassword = $('#newPassword').val();
			var confirmPassword = $('#confirmPassword').val();
			updateObj = {
				"action" : "password",
				"data" : {
					"currentPassword" : currentPassword,
					"newPassword" : newPassword,
					"confirmPassword" : confirmPassword,
				}
			};	
		break;
	}
	updateJSON = JSON.stringify(updateObj);
	$.ajax({
		url : 'ajax/updateBuyer.php',
		type : 'post',
		async : 'false',
		data : {'updateJSON' : updateJSON},
		success : function(data){
			if(data == 'success'){
				loadJSON();
				$(formObj).parent().parent().slideUp().prev().slideDown();
			}
			else{
				$(formObj).parent().prepend('<p style="display:none;" class="editErrorMessage">' + data +  '</p>');
				$('.editErrorMessage').slideDown();
			}			
			$('.fbLoading').css('visibility', 'hidden');
		},
		beforeSend : function(){
			$(formObj).find('.fbLoading').css('visibility', 'visible');
		}
	});
}
function cancelEdit(buttonObj){	
	$('.editErrorMessage').slideUp('fast',function(){$(this).remove();});
	$(buttonObj).parents('.fbcontent:first').slideUp().prev().slideDown();
	$('.fbLoading').css('visibility', 'hidden');
}

function setRequest(cb){
	updateObj = {
				"action" : "recieveQuotes",
				"data" : {
					"receiveQuotes" : cb.checked ? 'Yes' : 'No'
				}
			};
	updateJSON = JSON.stringify(updateObj);
	$.ajax({
		url : 'ajax/updateBuyer.php',
		type : 'post',
		data : {'updateJSON' : updateJSON},
		success : function(data){
			$('.hiddenCb').html('Saved');
			
		},
		beforeSend : function(){
			$('.hiddenCb').html(loadingImg());
		}
	});
}
function loadingImg(){
	return '<img class="fbLoading" src="img/fbLoading.gif" alt="Loading" width="16" height="11">'
}
function loadJSON(){
	$.ajax({
		url : 'includes/buyerData.php?json=yes',
		type : 'post',
		async : 'true',
		success : function(data){
			buyer = $.parseJSON(data);
			setText();
		},
		error : function(){
			window.location.href = APP_URL;
		}
	});
}
function setText(){
	$('#addressText').text(buyer.address + ', ' + buyer.city + ', ' + buyer.primaryRegion + ', ' + buyer.countryName + ', ' + buyer.zip);
	$('#contactPersonText').text(buyer.contactPerson);
	$('#phoneText').text(buyer.phone);
	$('#emailText').text(buyer.contactEmail);
	$('#nameText').text(buyer.name);
}