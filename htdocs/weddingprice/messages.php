<?php
require_once 'config/config.php';
require_once 'includes/secureLogin.php';
require_once 'includes/securePasswordChange.php';
require_once 'includes/secureSupplierBuyer.php';
require_once 'classes/database/objects/class.database.php';
require_once 'classes/database/objects/class.supplier.php';
require_once 'classes/database/objects/class.buyer.php';
$userid = 0;
$usertable = 'Supplier';
$othertable = 'Buyer';
if($_SESSION['type'] == 'Buyer'){
	$userid = $_SESSION['buyerId'];
	
	$usertable = 'Buyer';
	$othertable = 'Supplier';
	}
else{
	$userid = $_SESSION['supplierId'];
	}
	
mysql_connect(HOST, USER, PASSWORD);
mysql_select_db(DBNAME);
$query = 'select DISTINCT toid, fromid from message WHERE toid IN 
			(select DISTINCT toid from message WHERE fromid=' . $userid . ' ORDER BY messageid DESC)
			  AND (toid = ' . $userid . ' or fromid = ' . $userid . ') UNION 
			select DISTINCT fromid, toid from message WHERE fromid IN 
			(select DISTINCT fromid from message WHERE toid=' . $userid . ' ORDER BY messageid DESC)
			 AND (toid = ' . $userid . ' or fromid = ' . $userid . ')';
//echo $query;			 
$result = mysql_query($query);
$messages = array();
while($row = mysql_fetch_array($result)){
		$query = 'select message.* from message, ' . strtolower($usertable) . ' where (toid = ' . $row['toid'] . ' 
		AND fromid = ' . $row['fromid'] . ') OR (toid = ' . $row['fromid'] . ' 
		AND fromid = ' . $row['toid'] . ') AND status=\'SHOW\'
		order by date desc LIMIT 1';
//echo $query;		
		$result2= mysql_query($query);
		if(mysql_num_rows($result2) > 0){
			$messages[] =  mysql_fetch_array($result2);
		}
}	
for($i=0; $i<count($messages); $i++){
	if($messages[$i]['fromid'] == $userid){
		$messages[$i]['username'] = 'You';
		$other = new $othertable();
		$other->Get($messages[$i]['toid']);
		$messages[$i]['othername'] = $other->name;		
		$id = strtolower($othertable). 'Id';
		$messages[$i]['otherid'] = $other->$id;
	}
	else{
		$other = new $othertable();
		$other->Get($messages[$i]['fromid']);
		$messages[$i]['username'] = $other->name;
		$messages[$i]['othername'] = 'You';
		$id = strtolower($othertable). 'Id';
		$messages[$i]['otherid'] = $other->$id;
		$messages[$i]['messages'] = $temp;
	}		
}
require_once 'classes/Cipher.php';
$cipher = new Cipher('weddingpricemessages');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Wedding Price - Messages</title>		
        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/main.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/account.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/messages.css"/>
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>-->	
        <!--[if lte IE 7]>
            <link rel="stylesheet" type="text/css" href="css/lteie7.css"/>
            <script defer type="text/javascript" src="js/pngfix.js"></script>
            <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script>
        <![endif]-->
	</head>
	<body>
		<?php require_once 'includes/header.php';?>
        <div id="main_navigation_container">
            <div id="main_navigation">
                <div id="navbar">
                    <?
                    	include('includes/main-navigation.php');
					?>
                </div>
            </div>
        </div>
        <div id="background">
            <div class="wrapper">
                <div class="content">
                <div id="leftCol">
						<?php require_once 'includes/messages-menu.php';?>
				</div>
				<div id="rightCol">
					<h1 class="myTitle" style='margin-bottom:10px;'>Inbox</h1>
                    <div style='clear:both;'></div>
					<div class='messagesContainer'>
					
					<?php
						if (count($messages) == 0){
							echo 'You haven\'t yet started communicating with any one! Go to your accounts page to start conversation with others.';
						}
						foreach($messages as $message){
							$query ='select count(fromid) as count from message where fromid = ' . $message['fromid'] . ' AND toid = ' . $message['toid'] . ' AND isread="NO"';
							//echo $query;
							$result = mysql_query($query);
							$row = mysql_fetch_assoc($result);
							$hasUnread = $row['count'] > 0 && $row['count'] !== null;
							//echo $row['count'];
					?>
						
						<a class='messageAnchor' href='<?php echo URL . '/show-messages.php?token=' . urlencode($cipher->encrypt($message['username'] == 'You' ? $message['toid'] : $message['fromid']));?>'>
							<div class='messageDiv <?php if ($hasUnread && $message['username'] != 'You') echo 'unread';?>'>
								<div class='fromPic'><img src='img/<?php echo strtolower($othertable); ?>/<?php echo  $message['otherid']; ?>_thumb.jpg'></img></div>
								<div class='messageDetail'>
									<div class='fromName'>
										<?php if($message['username'] == 'You'){ ?>
											You to <?php echo $message['othername']; ?>
										<?php } else { ?>
											
											<?php echo $message['username']; ?> to You
										<?php } ?>
										
									</div>
									<div class='messageContent'><?php echo substr($message['content'], 0 , 20); ?></div>
								</div>
								<div class='dateRecieved'><?php if ($message['username'] == 'You') echo 'Sent '; else echo 'Received '; ?>on<br/><?php echo date('d/m/Y',strtotime($message['date'])); ?></div>
							</div>
						</a>
					<?php } ?>
					</div>
                </div><!-- rightCol -->
                <br style="clear: both;"/>
            </div>
            </div>
        </div>
		 <?php require 'includes/footer.php'; ?>
		 <script src="<?php echo URL;?>/js/jquery.js" type="text/javascript"></script>
		 <script src="<?php echo URL;?>/js/messages.js" type="text/javascript"></script>
		
	</body>
</html>
