$(function(){
	
	$('.numberOnly').live('keydown', function(e){
			if((e.which>47 && e.which < 58) || (e.which>95 && e.which < 106)  || e.which == 46 || e.which == 8 || e.which == 9)
				return true;
			else
				return false;
	});
	
	$('.print').click(function(){
		$('#content').jqprint();
	});
	$('.add-course-link').click(function(){
		addDialogue();
	});
	$('.add-teacher-link').click(function(){
		$("<div id='add-teacher-div' title='Add Teacher'><form action='javascript:void(0);'>Teacher Name:<br/><input type='text' class='text' id='add-teacher-txt'/></form></div>").dialog({
			modal : true,
			width: 'auto',
			buttons : {
				'Add' : function(){
					$.post('addStuff.php', {'teachername' : $('#add-teacher-txt').val()}, function(message){
						if(message == 1){
							showSuccess('Teacher added successfully');	
							$(this).dialog('close');							
						}
						else{
							showError('Error adding teacher! ' + message);
						}
					});
				},
				'Close' : function(){
					$(this).dialog('close');
				}
			},
			'close' : function(){
				$(this).dialog('destroy');
				$('#add-teacher-div').remove();
			}
		});
	});
	$('.add-subject-link').click(function(){
		$("<div id='add-subject-div' title='Add Subject'><form action='javascript:void(0);'>Subject Name:<br/><input type='text' class='text' id='add-subject-txt'/></form></div>").dialog({
			modal : true,
			width: 'auto',
			buttons : {
				'Add' : function(){
					$.post('addStuff.php', {'subjectname' : $('#add-subject-txt').val()}, function(message){
						if(message == 1){
							showSuccess('Subject added successfully');
							$(this).dialog('close');
						}
						else{
							showError('Error adding subject! ' + message);
						}
					});
				},
				'Close' : function(){
					$(this).dialog('close');
				}
			},
			'close' : function(){
				$(this).dialog('destroy');
				$('#add-subject-div').remove();
			}
		});
	});
	$.post('login.php', {}, function(data){
		json = null;
		try{
			json = $.parseJSON(data);
		}
		catch(e){
			json = null;
		}
		if(json!= null && json.status == '1'){
			showLoggedIn(json.user + ' (' +  json.role + ')');
			if(json.role == 'Coordinator')				
					$('.add-course-menu').show();
		}
	});
	$('.do-login').click(function(){
		$.post('login.php', {'user':$('#user').val(), 'password':$('#pass').val()}, function(data){
			json = null;
			try{
			json = $.parseJSON(data);
			}
			catch(e){
				json = null;
			}
			if(json!= null && json.status == '1'){
				showSuccess('Successfully Logged In');
				showLoggedIn(json.user + ' (' +  json.role + ')');
				$('#type').val(json.role);
				if(typeof json.programid !== 'undefined'){
					$('#programid').val(json.programid);
					$('.add-course-menu').show();
				}
			}
			if(json == null){
				showError(data);
			}
			else{
				showError('Username password invalid!');
			}
		});
	});
	$('.do-logout').click(function(){
		$.post('logout.php', {}, function(data){
			if(data == '1'){
				showSuccess('Logged Out');
				showLoggedOut();
				$('#type').val('Normal');
				$('#programid').val('0');
			}
			else{
				showError(data);
			}
		});
	
	});	
	$('#program').change(function(){
		loadTimeTable();
	});
	$('td[id^="slot"]:not(.slot)').live('click', function(){
		data = $(this).attr('id');
		id = data.split('-');
		scheduleId = id[3];
		slotId = id[1];
		day = id[4];
		batchId = id[2];
		roomId = id[5];
		checkAvailability(scheduleId, slotId, day, batchId, roomId);
	});
});

function loadTimeTable(){
	$('.loading').show();
		$.post('getTimeTable.php', {programId:$('#program>option:selected').val()}, function(data){
			$('#content').html(data);
			$('.loading').hide();
		});	
}

function checkAvailability(scheduleId, slotId, day, batchId, roomId){
	type = $('#type').val();	
	if(type == 'Admin'){		
		if(scheduleId != 0)
			updateSchedule(scheduleId, slotId, day, batchId, roomId);
	}
	else if(type == 'Coordinator'){
			program = $('#program').val();
			if(program == $('#cProgramId').val() && scheduleId != 0){
				updateSchedule(scheduleId, slotId, day, batchId, roomId);			
			}
	}
}

/*function changeSchedule(scheduleId, slotId, day, batchId, roomId){
	type = $('#type').val();
	switch(type){
		case 'Normal':
			showReservationDialog();
			break;
		case 'Admin':
			updateSchedule(scheduleId, slotId, day, batchId, roomId);
			break;
		case 'Coordinator':
			updateSchedule(scheduleId, slotId, day, batchId, roomId);
			break;
	}
}

function showReservationDialog(){
	alert('reserving');
}*/



function updateSchedule(scheduleId, slotId, day, batchId, roomId){
	$.post('getUpdateScheduleHtml.php', {slotId : slotId, day : day, roomId : roomId, batchId : batchId, scheduleId : scheduleId}, function(data){
		$(data).dialog({
			modal: true,
			width:'auto',
			buttons : {
				'Update' : function(){
					type = $('#type').val();
					if(type == 'Admin'){
						$.post('updateSchedule.php', {slotId : $('#update-slot>option:selected').val(), day : $('#update-day>option:selected').val(), roomId : $('#update-room').val(), batchId : batchId, scheduleId : scheduleId}, function(message){
							//alert(message);
							if(message == 1){
								showSuccess('Updated Successfully');
								loadTimeTable();
							}
							else{
								showError(message);
							}
						});
					}
					else if(type == 'Coordinator'){
						$.post('updateSchedule.php', {teacherId : $('#update-teacher').val() , courseId : $('#update-course').val(), slotId : $('#update-slot>option:selected').val(), day : $('#update-day>option:selected').val(), batchId : $('#update-batch').val(), scheduleId : scheduleId}, function(message){
							//alert(message);
							if(message == 1){
								showSuccess('Updated Successfully');
								loadTimeTable();
							}
							else{
								showError(message);
							}
						});
					}					
				},
				'Close' : function(){
					$('#update-dialog').remove();
				}				
			},
			'close' : function(){			
				$(this).dialog('destroy');
				$('#update-dialog').remove();
			}
		});
	});
}

function addDialogue(){
	$.post('addScheduleHtml.php', {programId:$('#programid').val()}, function(message){
		$(message).dialog({
			modal: true,
			width:'auto',
			buttons : {
				'Add' : function(){
					data = {
						teacherid : $('#add-teacher>option:selected').val(),
						courseid : $('#add-course>option:selected').val(),
						batchid : $('#add-batch>option:selected').val(),						
						slotid : $('#add-slot>option:selected').val(),
						day : $('#add-day>option:selected').val()
					};					
					$.post('addSchedule.php', data, function(response){
						if(response == 1){
							showSuccess('Course Added');
							loadTimeTable();
							$(this).dialog('close');
						}
						else{
							alert(response);
							showError('Error Adding Course: '  +  response);	
						}
					});
				},
				'Close' : function(){
					$(this).dialog('close');
					$('#add-dialog').remove();
				}
			},
			'close' : function(){			
				$(this).dialog('destroy');
				$('#add-dialog').remove();
			}
		});
	});
}

function showError(message){		
		$('.error').html(message).slideDown('slow', function(){
			$('#navigation').css('top', '35');
			window.setTimeout(function(){
				$('.error').slideUp();
				$('#navigation').css('top', '0');
			}, 1000);
		});
}
function showSuccess(message){		
		$('.success').html(message).slideDown('slow', function(){
			$('#navigation').css('top', '35');
			window.setTimeout(function(){
				$('.success').slideUp();
				$('#navigation').css('top', '0');
			}, 1000);
		});
}

function showLoggedIn(userMessage){
	$('.login-menu-item').hide();
	$('.user-text').text(userMessage);
	$('.logout-menu-item').show();
}

function showLoggedOut(){	
	$('#pass').val('');
	$('#user').val('');
	$('.add-course-menu').hide();
	$('.logout-menu-item').hide();
	$('.login-menu-item').show();
}