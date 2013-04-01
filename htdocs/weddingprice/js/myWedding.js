$(document).ready(
	function(){
		$('.datepicker').datepicker({
			changeMonth: true,
			changeYear: true,
			minDate: 0,
			dateFormat: 'dd-mm-yy',
			beforeShow : function(){
				//$( this ).datepicker( "option", "minDate", getDate($("#postedOn" + $(this).attr('rel')).text()) );
			}
		});
		$('.numberOnly').live('keydown', function(e){
			if((e.which>47 && e.which < 58) || e.which == 46 || e.which == 8 || e.which == 9)
				return true;
			else
				return false;
		});	
		init();
		$('.hoverShow>tr').css('cursor', 'pointer').hover(function(){
			$this = $(this).css('background-color', '#F3F5D5').children('.description');
			temp = $this.attr('rel');
			$this.attr('rel', $this.html());
			$this.html(temp);
		}, function(){
			$this = $(this).css('background-color', '#F3F5F7').children('.description');
			temp = $this.attr('rel');
			$this.attr('rel', $this.html());
			$this.html(temp);
		}).click(function(){
			link = $(this).find('.detailsLink').attr('href');
			window.location.href = link;
		});
		
		$('#tabs').tabs({
		cookie : {},
		load : function(){
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
		
	if($('.stars').length>0){
				setStars();
			}
			if($('.rStars').length>0)
				setratableStars();
	}
);
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
function sendMessage(senderId, recieverId, weddingId){
	$.ajax({
		url : APP_URL + '/ajax/sendMessage.php',
		data : {'recieverId' : recieverId, 'weddingId' : weddingId, 'senderId' : senderId, 'content' : $('.myMessageTextArea').val()},
		async: false,		
		success: function(data){
			$('#tabs').tabs('load', 1);
		}
	});
}
function init(){

		/*$('.categories').tokenInput(APP_URL + '/ajax/categoryJson.php', {
					theme : 'facebook',
					preventDuplicates : 'true'
				});*/
		/*$('.uploadify').each(function(){
			$obj = $(this);
			id = $obj.siblings('input[type=hidden]').val();
			$obj.uploadify({
			'uploader'  : 'uploadify.swf',
			'script'    : 'uploadify.php',
			'cancelImg' : 'img/cancel.png',
			'folder'    : 'img/weddings',
			'auto'      : false,
			'buttonText' : 'Change Image',
			'expressInstall' : 'expressInstall.swf',
			'multi' : false,
			'queueSizeLimit' : 1,
			'scriptData' : {'id' : id},
			'fileExt'     : '*.jpg;*.gif;*.png;*.jpeg;*.bmp;',
			'fileDesc'    : 'Image Files',
			'onComplete' : function(event, ID, fileObj, response, data){
				json = $.parseJSON(response);
				if(json.error != ''){
					alert("error: " +  json.error);
					return;
				}
				else if(json.resizeError != ''){
					alert("resize error: " +  json.resizeError);
					return;
				}
				else{
					$('#' + json.id+"thumb").attr('src', APP_URL + "/img/weddings/" + json.thumb + "?" + Math.random());
					$('#img' + json.id).attr('src', APP_URL + "/img/weddings/" + json.image + "?" + Math.random());
				}
			},
			'onError'     : function (event,ID,fileObj,errorObj) {
				alert(errorObj.type + ' Error: ' + errorObj.info);
			},
			'sizeLimit' : 7340032,
			'auto' : true
			
		  });
		
		});
		  $('.uploadify-1').uploadify({
				'uploader'  : 'uploadify.swf',
				'script'    : 'uploadify.php',
				'cancelImg' : 'img/cancel.png',
				'folder'    : 'img/weddings',
				'scriptData' : {'id' : '-1'},
				'auto'      : false,
				'buttonText' : 'Add Image',
				'expressInstall' : 'expressInstall.swf',
				'multi' : false,
				'queueSizeLimit' : 1,
				'fileExt'     : '*.jpg;*.gif;*.png;*.jpeg;*.bmp;',
				'fileDesc'    : 'Image Files',
				'onComplete' : function(event, ID, fileObj, response, data){
					json = $.parseJSON(response);
					if(json.error != ''){
						alert("error: " +  json.error);
						return;
					}
					else if(json.resizeError != ''){
						alert("resize error: " +  json.resizeError);
						return;
					}
					else{
						$('#' + json.id+"thumb").attr('src', APP_URL + "/img/weddings/" + json.thumb + "?" + Math.random());
						$('#img' + json.id).attr('src', APP_URL + "/img/weddings/" + json.image + "?" + Math.random());
					}
					try{
					$('.uploadify-1').uploadifyClearQueue();
					}
					catch(err){
					}
				},
				'onError'     : function (event,ID,fileObj,errorObj) {
					alert(errorObj.type + ' Error: ' + errorObj.info);
				},
				'sizeLimit' : 7340032,
				'auto' : false			
			  });*/
		
}


/*function getCatHTML(id){
$.post(APP_URL + '/ajax/updateCategoryDetails.php', {'id' : id }, function(data){
			$('<div>').html(data).dialog({
				modal : true,
				autoResize : true,
				width : '420px',
				close : function(){
					$(this).remove();
				},
				open : function(){					
					
					$('body, html').animate({scrollTop : $(this).offset().top}, 'fast');
					$('.saveButton').button().click(function(){
						$button = $(this);
						id = $button.attr('rel');
						var obj = {
							id : id,
							budgetTo : $('#cbudgetTo'+id).val(),
							budgetFrom : $('#cbudgetFrom'+id).val(),
							detail : $('#cdetail'+id).val()
						};
						$(this).button('disable');
						$.ajax({
							url : APP_URL + '/ajax/saveWeddingCat.php',
							data : obj,
							success : function(data){
									$button.after('<span id="msg">saved!</span>' + data);
									$('#msg').fadeOut('slow', function(){
										$(this).remove();
									});
									$button.button('enable');
								//alert(data);
							}
						});
					});
					$('#tabs').tabs({
					 fx : [{opacity:'toggle', duration:'normal'},   // hide option
                        {opacity:'toggle', duration:'fast'}]
					});
					$div = $(this);
					$('.uploadifyCats').each(function(){
					//alert('hi');
					$upload = $(this);
					$(this).uploadify({
						'uploader'  : 'uploadify.swf',
						'script'    : 'uploadCatPics.php',
						'cancelImg' : 'img/cancel.png',
						'folder'    : 'img/weddingcats',
						'buttonText' : 'Upload',
						'expressInstall' : 'expressInstall.swf',
						'multi' : false,
						'queueSizeLimit' : 1,
						'scriptData' : {'id' : $upload.attr('rel')},
						'fileExt'     : '*.jpg;*.gif;*.png;*.jpeg;*.bmp;',
						'fileDesc'    : 'Image Files',
						'onComplete' : function(event, ID, fileObj, response, data){
							j = $.parseJSON(response);							
							$(this).after("<p>" + j.error + "</p>");
							if(j.image){								
								randUrl = APP_URL + '/img/weddingcats/' + j.image + '?r=' + Math.random();
								$('#img' + j.id).attr('src', randUrl);
							}
							else{
								alert(j.error);
							}
						},
						'onError'     : function (event,ID,fileObj,errorObj) {
							alert(errorObj.type + ' Error: ' + errorObj.info);
						},
						'sizeLimit' : 7340032,
						'auto' : true
					
					});	});
				},
				buttons : {
					'Close' : function(){
						$(this).dialog('close').remove();
					}
				}
			});
		});
}*/
