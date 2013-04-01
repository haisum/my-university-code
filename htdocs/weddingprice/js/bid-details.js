$(document).ready(function(){
	
});
function showSuppliers(id){
		$link = $('#category' + id + ' a');
		if($link.hasClass('leftlinks')) 
			return;
		$('.leftMenuLink, .supplierLink').removeClass('leftlinks');
		$('#ajaxContent').hide('slow');
		$link.addClass('leftlinks');
		$('#suppliers' + id).toggle('slow');
		$('.bidSummaryCategory').not('#bidSummaryCategory' +id).hide('fast', function(){
			$('#bidSummaryCategory' +id + ', .summaryPerCategory').show('slow');
		});
}
function showSummary(){	
	$('.leftMenuLink, .supplierLink').removeClass('leftlinks');
	$('#ajaxContent').hide('slow');
	$('#summaryLink').addClass('leftlinks');
	$('.bidSummaryCategory, .summaryPerCategory').show('slow');	
}
function showSupplierBids(supplierId, bidId, weddingId, categoryId){
	$('#tabs').tabs('destroy');
	if(bidId == 0){
		$('.bidSummaryCategory, .summaryPerCategory').hide('slow');
	}else{
		$('.bidSummaryCategory').not('#bidSummaryCategory' +categoryId).hide('fast', function(){
			$('#bidSummaryCategory' + categoryId ).show('slow');
		});
	}
	$link = $('#supplier' + supplierId + 'c' + categoryId);
	$('.supplierLink').removeClass('leftlinks');
	$link.addClass('leftlinks');
	$link = $('#category' + categoryId + ' a');
	$('.leftMenuLink').removeClass('leftlinks');
	$link.addClass('leftlinks');
	data = {'supplierId' : supplierId, 'weddingId' : weddingId, 'bidId' : bidId, 'categoryId' : categoryId};
	$.ajax({
		url : APP_URL + '/ajax/bid-details/supplier-bid-details.php',
		async : false,
		'data' : data,
		success : function(data){
			$('#ajaxContent').html(data).show();
			 //$('#tabs').tabs();
			$('#tabs').tabs({
				load : function(){
				//alert('yo');
					if($('.stars').length>0){
						setStars();
					}
					unread = $('#unreadCount').val();
					$('#unreadCount').remove();
					messagesText = '';
					if(unread > 0){
						messagesText = ' (' + unread + ')';
					}				
					$('#messagesSpan').text('Messages' + messagesText);
				},
				fx: [{opacity:'toggle', duration:'normal'},   // hide option
								{opacity:'toggle', duration:'fast'}]
			});
			 
			//$('#ajaxContent').show('slow');
		},
	error: function(){
		alert('boo ha error');
	}
		
	});
}
function sendMessage(senderId, recieverId, weddingId){
	$.ajax({
		url : APP_URL + '/ajax/sendMessage.php',
		data : {'recieverId' : recieverId, 'weddingId' : weddingId, 'senderId' : senderId, 'content' : $('.myMessageTextArea').val()},
		async: false,		
		success: function(data){
			$('#tabs').tabs('load', $('#tabs').tabs('option', 'selected') );
		}
	});
}
function setStars(){
	$('.stars').each(function(){
		rating = $(this).attr('title');
		if(!isNaN(rating))
			$(this).attr('title', 'Rated ' + rating + ' out of 5');
		i=0;
		for(i;i<rating;i++){
			$(this).append("<img src='" + APP_URL + "/img/star-on.png' alt='rating'/>");
		}
		for(i;i<5;i++){
			$(this).append("<img src='" + APP_URL + "/img/star-off.png' alt='rating'/>");
		}
	});
}