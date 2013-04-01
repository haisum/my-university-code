function filter(){
	region = $('#sortRegion>option:selected').val();
	category = $('#sortCat>option:selected').val();
	url = APP_URL + '/list-weddings.php';
	if(region != 0 && category ==  0){		
		url += '?region=' + region;
	}
	else if(category != 0 && region == 0){
		url += '?category=' + category;
	}
	else if(category != 0 && region != 0){
		url += '?category=' + category + '&region=' +region;
	}
	window.location.href=url;
}
