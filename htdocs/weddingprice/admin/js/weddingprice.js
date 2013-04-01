function ajaxUpdate(table, name, value, primary, pvalue){
/*
sample php for this funnction
' onchange="ajaxUpdate(\'supplier\', \'recieverequests\', $(\'#recieveReqs' . $row['supplierid'] .
							  '>option:selected\').val(), \'supplierid\', \'' . $row['supplierid'] . '\')"'

*/
	$.ajax({
		url : 'ajaxUpdate.php',
		data : {'table' : table, 'name' : name, 'value' : value, 'primary' : primary, 'pvalue' : pvalue},
		success : function(data){
			if(data == 1){
				$.growlUI('Notification', 'Updated successfully!');
			 }
			 else{
				$.growlUI('Notification', data);
			 }
		}
	});
}