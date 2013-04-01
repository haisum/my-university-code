$(document).ready(function(){
	$('#sendPrivateMessage').live('change',function(){
		if($(this).prop('checked')){
			$('#privateMessage').show('slow');
		}
		else{
			$('#privateMessage').hide('slow');
		}
	});			
	$('#tabs').tabs({
		cache : true,
		cookie: { expires: 1 },
		fx: [{opacity:'toggle', duration:'normal'},   // hide option
                        {opacity:'toggle', duration:'fast'}]		
						
	});
	if($('#bid-now').length  == 1){
		$('#tabs').tabs('add', '#bid-now', 'Bid Now');
		if(window.location.hash == '#bid-now')
			$('#tabs').tabs('select', 1);
	}
});

function showBidNow(){
	
}
