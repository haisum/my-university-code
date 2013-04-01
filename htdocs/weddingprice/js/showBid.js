$(document).ready(function(){
	$('#tabs').tabs({
		fx: [{opacity:'toggle', duration:'normal'},   // hide option
                        {opacity:'toggle', duration:'fast'}],
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
		}
	});
	unread = $('#unreadCount').val();
	$('#unreadCount').remove();
	messagesText = '';
	if(unread > 0){
		messagesText = ' (' + unread + ')';
	}				
	$('#messagesSpan').text('Messages' + messagesText);
	if($('.rStars').length>0)
		setratableStars();
	if($('.stars').length>0){
						setStars();
					}
});

function setStars(){
	$('.stars').each(function(){
		if($(this).html()!='')
			return;
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
function setratableStars(){
	$('.rStars').each(function(){
		for(i=1;i<6;i++){
				$(this).append("<img id='ratableImg" + i + "' class='ratableImg' rel='" + i + "' src='" + APP_URL + "/img/star-off.png' alt='rating' style='cursor:pointer;'/>");
			}
	});
	$('.ratableImg').bind('mouseover', function(){
		id = parseInt($(this).attr('rel'));
		$('.ratableImg').attr('src', APP_URL + "/img/star-off.png");
		for(i=1;i<id+1;i++){
			$('#ratableImg' + i).attr('src', APP_URL + "/img/star-on.png");
		}
		$('#rating').val(id);
	});
}