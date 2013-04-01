<?php
class Mail{
	
	public function sendPasswordResetMail($email, $ticket){
		$emailtpl = new EmailTemplate();
		$link = URL."/reset-password.php?email=".$email."&ticket=".$ticket;		
		$emailTemplateList = $emailtpl->GetList(array(array('type' , '=', 'passwordReset')));
		$emailbody = $emailTemplateList[0]->body;
		$emailbody = str_replace("[link]","<a href=$link>$link</a>",$emailbody);
		$subject = $emailTemplateList[0]->subject;
		$headers ="";
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n". "From: \"".$emailTemplateList[0]->fromName."\" <".$emailTemplateList[0]->from.">";
		@mail($email,$subject,$emailbody,$headers);
	}
	public function  requestInRegion($link, $regionId){
		mysql_connect(HOST, USER, PASSWORD);
		mysql_select_db(DBNAME);
		$result = mysql_query("SELECT supplierid, salesemail
								FROM supplier
								WHERE `recieverequests` = 'Yes' AND ( supplierid IN(
								SELECT supplierid
								FROM supplier
								WHERE primaryregionid=$regionId) OR supplierid IN(
								SELECT supplierid
								FROM regionsuppliermap
								WHERE regionid =$regionId))");
		
		$emailtpl = new EmailTemplate();
		$emailTemplateList = $emailtpl->GetList(array(array('type' , '=', 'requestInRegion')));
		$emailbody = $emailTemplateList[0]->body;
		$emailbody = str_replace("[link]","<a href=$link>$link</a>",$emailbody);
		$subject = $emailTemplateList[0]->subject;
		$headers ="";
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n". "From: \"".$emailTemplateList[0]->fromName."\" <".$emailTemplateList[0]->from.">";
		while($row = mysql_fetch_array($result)){
				@mail($row['salesemail'],$subject,$emailbody,$headers);
		}		
	}
	public function adPaymentReceived($email){
		$emailtpl = new EmailTemplate();
		$emailTemplateList = $emailtpl->GetList(array(array('type' , '=', 'adPaymentReceived')));
		$emailbody = $emailTemplateList[0]->body;
		$subject = $emailTemplateList[0]->subject;
		$headers ="";
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n". "From: \"".$emailTemplateList[0]->fromName."\" <".$emailTemplateList[0]->from.">";
		@mail($email,$subject,$emailbody,$headers);
	}
	public function goldPaymentReceived($email){
		$emailtpl = new EmailTemplate();
		$emailTemplateList = $emailtpl->GetList(array(array('type' , '=', 'goldPaymentReceived')));
		$emailbody = $emailTemplateList[0]->body;
		$subject = $emailTemplateList[0]->subject;
		$headers ="";
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n". "From: \"".$emailTemplateList[0]->fromName."\" <".$emailTemplateList[0]->from.">";
		@mail($email,$subject,$emailbody,$headers);
	}
	public function  requestInCategory($link, $categoryId){
		mysql_connect(HOST, USER, PASSWORD);
		mysql_select_db(DBNAME);
		$result = mysql_query("SELECT supplierid, salesemail
								FROM supplier
								WHERE `recieverequests` = 'Yes' AND ( supplierid IN(
								SELECT supplierid
								FROM supplier
								WHERE primarycategoryid=$categoryId) OR supplierid IN(
								SELECT supplierid
								FROM categorysuppliermap
								WHERE categoryid =$categoryId))");
		
		$emailtpl = new EmailTemplate();
		$emailTemplateList = $emailtpl->GetList(array(array('type' , '=', 'requestInCategory')));
		$emailbody = $emailTemplateList[0]->body;
		$emailbody = str_replace("[link]","<a href=$link>$link</a>",$emailbody);
		$subject = $emailTemplateList[0]->subject;
		$headers ="";
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n". "From: \"".$emailTemplateList[0]->fromName."\" <".$emailTemplateList[0]->from.">";
		while($row = mysql_fetch_array($result)){
				@mail($row['salesemail'],$subject,$emailbody,$headers);
		}		
	}
	public function sendContactSupportEmail($name, $email, $subject, $message){
		$emailtpl = new EmailTemplate();
		$emailTemplateList = $emailtpl->GetList(array(array('type' , '=', 'contactSupport')));
		$emailbody = $emailTemplateList[0]->body;
		$emailbody = str_replace("[name]", $name,$emailbody);
		$emailbody = str_replace("[email]", $email,$emailbody);
		$emailbody = str_replace("[message]", $message,$emailbody);
		$headers ="";
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n". "From: \"".$emailTemplateList[0]->fromName."\" <".$emailTemplateList[0]->from.">";
		@mail($emailTemplateList[0]->to,$subject,$emailbody,$headers);
	}
	
	public function sendRegisterationEmail($password, $linkUrl, $to){
		$emailtpl = new EmailTemplate();
		$emailTemplateList = $emailtpl->GetList(array(array('type' , '=', 'registeration')));
		$emailbody = $emailTemplateList[0]->body;
		$emailbody = str_replace("[password]", $password,$emailbody);
		$emailbody = str_replace("[linkUrl]", $linkUrl,$emailbody);
		$headers ="";
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n". "From: \"".$emailTemplateList[0]->fromName."\" <".$emailTemplateList[0]->from.">";
		@mail($to,$emailTemplateList[0]->subject,$emailbody,$headers);
	}
	
	public function bidStatusChange($email, $link){
		$emailtpl = new EmailTemplate();
		$emailTemplateList = $emailtpl->GetList(array(array('type' , '=', 'bidStatusChange')));
		$emailbody = $emailTemplateList[0]->body;
		$emailbody = str_replace("[link]", $link,$emailbody);
		$headers ="";
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n". "From: \"".$emailTemplateList[0]->fromName."\" <".$emailTemplateList[0]->from.">";
		@mail($email,$emailTemplateList[0]->subject,$emailbody,$headers);
	}	
	
	public function requestStatusChange($email, $link){
		$emailtpl = new EmailTemplate();
		$emailTemplateList = $emailtpl->GetList(array(array('type' , '=', 'requestStatusChange')));
		$emailbody = $emailTemplateList[0]->body;
		$emailbody = str_replace("[link]", $link,$emailbody);
		$headers ="";
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n". "From: \"".$emailTemplateList[0]->fromName."\" <".$emailTemplateList[0]->from.">";
		@mail($email,$emailTemplateList[0]->subject,$emailbody,$headers);
	}
}

?>