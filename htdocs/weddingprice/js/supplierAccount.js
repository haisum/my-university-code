$(document).ready(function(){
	/*$('#categories').tokenInput(APP_URL + '/ajax/categoryJson.php', {
					theme : 'facebook',
					preventDuplicates : 'true'
	});*/
});
function showEdit(linkObj, block){
	switch(block){
		case 'website':
			$('#websiteName').val(supplier.website.name);
			$('#websiteUrl').val(supplier.website.url);
		break;
		case 'address':
			var optionsHTML = "";
			for(i=0;i<supplier.primaryRegionOptions.length;i++){
				optionsHTML += "<option value='" + supplier.primaryRegionOptions[i].value + "' " + supplier.primaryRegionOptions[i].selected +">" + supplier.primaryRegionOptions[i].text +"</option>";
			}				
			$('#primaryRegion').html(optionsHTML);
			$('#address').val(supplier.address);
			$('#address2').val(supplier.address2);
			$('#zip').val(supplier.zip);
			$('#city').val(supplier.city);
		break;
		case 'regions':
			var optionsHTML = "";
			for(i=0;i<supplier.regionOptions.length;i++){
				optionsHTML += "<option value='" + supplier.regionOptions[i].value + "' " + supplier.regionOptions[i].selected +">" + supplier.regionOptions[i].text +"</option>";
				
			}
			$('#regions').html(optionsHTML);
		break;
		case 'categories':
			var optionsHTML = "";
			obj = new Array();
			for(i=0;i<supplier.categoryOptions.length;i++){
				optionsHTML += "<option value='" + supplier.categoryOptions[i].value + "' " + supplier.categoryOptions[i].selected +">" + supplier.categoryOptions[i].text +"</option>";
				/*
				if(supplier.categoryOptions[i].selected == 'selected'){
					obj = {id: supplier.categoryOptions[i].value,
					name: supplier.categoryOptions[i].text
					};
					$('#categories').tokenInput('add', obj);
				}*/
			}
			$('#categories').html(optionsHTML);
			
		break;
		case 'contactPerson':
			$('#contactPerson').val(supplier.contactPerson);
		break;
		case 'emails':
			$('#nonSalesEmail').val(supplier.nonSalesEmail);
			$('#salesEmail').val(supplier.salesEmail);
		break;
		case 'phone':
			$('#phone').val(supplier.phone);
		break;
		case 'companyProfile':
			$('#companyProfile').val(supplier.companyProfile);
		break;
		case 'name':
			$('#name').val(supplier.name);
		break;
	}
	$(linkObj).slideUp().next('.fbcontent').slideDown();
}
function saveEdit(formObj, block){
	$('.editErrorMessage').slideUp('fast',function(){$(this).remove();});
	updateObj = new Object();
	switch(block){
		case 'website':
			var newWebsiteName = $('#websiteName').val();		
			var newWebsiteUrl =	$('#websiteUrl').val();
			updateObj = {
				"action" : "website",
				"data" : {
					"websiteName" : newWebsiteName,
					"websiteUrl" : newWebsiteUrl
				}
			};
		break;
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
		case 'regions':
			var regions = [];
			$('#regions>option:selected').each(function(i,e){
				regions[i] = $(this).val();
			});
			updateObj = {
				"action" : "regions",
				"data" : {
					"regions" : regions,					
				}
			};
		break;
		case 'categories':
			var categories = [];
			$('#categories>option:selected').each(function(i,e){
				categories[i] = $(this).val();
			});
			updateObj = {
				"action" : "categories",
				"data" : {
					"categories" : categories
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
		case 'companyProfile':
			var companyProfile = $('#companyProfile').val();			
			updateObj = {
				"action" : "companyProfile",
				"data" : {
					"companyProfile" : companyProfile
				}
			};
		break;
		case 'emails':
			var newNonSalesEmail = $('#nonSalesEmail').val();
			var newSalesEmail = $('#salesEmail').val();
			updateObj = {
				"action" : "emails",
				"data" : {
					"nonSalesEmail" : newNonSalesEmail,
					"salesEmail" : newSalesEmail
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
		url : 'ajax/updateSupplier.php',
		type : 'post',
		async : 'false',
		data : {'updateJSON' : updateJSON},
		success : function(data){
			if(data == 'success'){
				loadJSON();
				$(formObj).parent().parent().slideUp().prev().slideDown('normal', function(){
					if(block == 'website'){
						window.location.reload();
					}
				});
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
				"action" : "recieveReqs",
				"data" : {
					"receiveRequests" : cb.checked ? 'Yes' : 'No'
				}
			};
	updateJSON = JSON.stringify(updateObj);
	$.ajax({
		url : 'ajax/updateSupplier.php',
		type : 'post',
		data : {'updateJSON' : updateJSON},
		success : function(data){
			$('.hiddenCb').html('Saved');
			//$('#doRecieveReqsText').text(data);
		},
		beforeSend : function(){
			$('.hiddenCb').html(loadingImg());
		}
	});
}
function setPrimaryCategory(){
	updateObj = {
				"action" : "primaryCat",
				"data" : {
					"pcid" : $('#primcat>option:selected').val()
				}
			};
	updateJSON = JSON.stringify(updateObj);
	$.ajax({
		url : 'ajax/updateSupplier.php',
		type : 'post',
		data : {'updateJSON' : updateJSON},
		success : function(data){
			$('.phiddenCb').html('Saved');
			//$('#doRecieveReqsText').text(data);
		},
		beforeSend : function(){
			$('.phiddenCb').html(loadingImg());
		}
	});
}
function loadingImg(){
	return '<img class="fbLoading" src="img/fbLoading.gif" alt="Loading" width="16" height="11">'
}
function loadJSON(){
	$.ajax({
		url : 'includes/supplierData.php?json=yes',
		type : 'post',
		async : 'false',
		success : function(data){
			//alert(data);
			supplier = $.parseJSON(data);
			setText();
		},
		error : function(){
			window.location.href = APP_URL;
		}
	});
}
function setText(){
	$('#companyProfileText').text(supplier.companyProfile);
	$('#websiteText').text(supplier.website.text);
	$('#addressText').text(supplier.address + ', ' + supplier.city + ', ' + supplier.primaryRegion + ', ' + supplier.countryName + ', ' + supplier.zip);
	$('#regionText').text(supplier.regionText);
	$('#categoryText').text(supplier.categoryText);
	$('#contactPersonText').text(supplier.contactPerson);
	$('#phoneText').text(supplier.phone);
	$('#emailText').text(supplier.salesEmail + ", " + supplier.nonSalesEmail);
	$('#nameText').text(supplier.name);
}