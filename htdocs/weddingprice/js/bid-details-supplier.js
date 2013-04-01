$(document).ready(function(){
	$('#tabs').tabs({
		cookie : {},
		load : function(){
			
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
});
function sendMessage(senderId, recieverId, weddingId){
	$.ajax({
		url : APP_URL + '/ajax/sendMessage.php',
		data : {'recieverId' : recieverId, 'weddingId' : weddingId, 'senderId' : senderId, 'content' : $('.myMessageTextArea').val()},
		async: false,		
		success: function(data){
			$('#tabs').tabs('select', $('#tabs').tabs('option', 'selected') );
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