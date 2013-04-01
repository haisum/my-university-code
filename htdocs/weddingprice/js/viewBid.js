$(document).ready(function(){
	$('.editAmount').click(function(){
		$link = $(this);
		currentEditAmount = $link.text();
		currentEditId = $link.attr('rel');
		$link.hide();		
		$link.after("<input type='text' value='" + currentEditAmount + "' class='editBox text numberOnly' style='width:70px;' />");
		$('.editBox').bind('blur', function(){
			$edit = $(this);
			editValue = $edit.val();
			if(currentEditAmount != editValue){
				$.ajax({
					url : APP_URL + '/ajax/updateBid.php',
					data : {'bidId' : $('#bidId').val(), 'bidCId' : $edit.prev('a').hasClass('totalAmount') ? 0 : $edit.prev('a').attr('rel'), 'amount' : editValue},
					async : false,
					success : function(data){
							if(data == 'success'){
								$edit.prev('a').text(editValue);
								$edit.hide('slow', function(){
								$edit.prev('a').show();
								$edit.remove();
								});
							}
							else{
								$edit.css('border', '1px dotted red');
								alert(data);	
							}
					}
					
				});
			}
			else{
				$edit.prev('a').text(editValue);
				$edit.hide('slow', function(){
					$edit.prev('a').show();
					$edit.remove();
				});	
			}
			
		});
			
	}).focus();
});