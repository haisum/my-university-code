$(document).ready(
	function(){
		
		if(totalRecords >0){
			paginate();
		}
		
		if($('.newMessage').length != 0){
			$('.newMessage').height(15);
			newMessage();
		}
	}
);
function newMessage(){
	var hasImage = (('url(' + APP_URL +  '/img/mail_new.png)') == $('.newMessage').css('background-image'));	
	if(!hasImage){
		$('.newMessage').css('background-image', 'url(' + APP_URL +  '/img/mail_new.png)');
	}
	else {
		$('.newMessage').css('background-image', 'none');
	}
	window.setTimeout(function(){
		newMessage();
	}, 500);
}
	
function paginate(){
	pagesDisplayedAtATime = 3;
		$("#paginationDiv").paginate({
				count 		: Math.ceil(totalRecords/limit),
				start 		: 1,
				display     : pagesDisplayedAtATime,
				border		: true,
				border_color : '#FFF',
				text_color  : '#FFF',
				background_color 	: '#56B4FE',	
				border_hover_color	: '#56B4FE',
				text_hover_color : '#56B4FE',
				background_hover_color : '#FFF', 
				images	: false,
				mouse	: 'press',
				onChange : function(page){
						$.ajax({
							'url' : APP_URL + '/includes/my-bid-list.php',
							'data' : {'page' : page},
							'async' : false,
							'success' : function(data){
								$('#lister').html(data);
								$('#startRecs').text((page*limit)-(limit-1));
								$('#endRecs').text(page*limit <= totalRecords ? page*limit : totalRecords);
							}
						});
				}
			});	
		if(Math.ceil(totalRecords/limit) == pagesDisplayedAtATime){
			$(".jPag-control-front").css('left', (pagesDisplayedAtATime *46) + 'px');
		}		
		$(".jPag-pages").width($(".jPag-pages").width()+6);		
		$("#totalRecs").text(totalRecords);		
		$('#startRecs').text(1);
		$('#endRecs').text(limit<= totalRecords ? limit : totalRecords);	
}