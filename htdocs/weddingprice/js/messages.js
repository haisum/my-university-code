$(document).ready(function(){
	$('.messageAnchor').hover(function(){
	//alert('yeh');
		$(this).children('div').css('background-color', '#eeeff4');
	}, function(){
		$(this).children('div').css('background-color', '#fff');
	});
});
function sendMessage(senderId, recieverId, weddingId){
	$.ajax({
		url : APP_URL + '/ajax/sendMessage.php',
		data : {'recieverId' : recieverId, 'weddingId' : weddingId, 'senderId' : senderId, 'content' : $('.myMessageTextArea').val()},
		async: false,		
		success: function(data){
			window.location.reload();
		}
	});
}