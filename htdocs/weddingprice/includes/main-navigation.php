<?php $filename =  basename($_SERVER['SCRIPT_FILENAME']); ?>
<ul class="main-nav">
	<li id="post_project_menu_button" style="" class="submenu <?php if($filename=='index.php') { echo "c9d-curpg";}?>"><a href="<?php echo URL;?>/index.php">Home</a></li>
    <li class="c9d-nl">&nbsp;|&nbsp;</li>
<?php
if(isset($_SESSION['supplierId'])){
$senderId = $_SESSION['supplierId'];
require_once 'classes/database/objects/class.database.php';	
	require_once 'classes/database/objects/class.message.php';
	$messageObj = new Message();
	$messageList = $messageObj->GetList(array(
			array('toid','=', $senderId),
			array('isread', '=' , 'NO')
	));	
	$unreadCount = count($messageList);
?>    	
    <li class="submenu mwidt  <?php if($filename=='account.php' || $filename == 'show-bid.php') { echo "c9d-curpg";}?>"><a href="<?php echo URL;?>/account.php"><span></span>My Account</a></li>
    <li class="c9d-nl">&nbsp;|&nbsp;</li>
	<li class="submenu  <?php if($filename=='list-weddings.php' || $filename=='bid-wedding.php') { echo "c9d-curpg";}?>"><a href="<?php echo URL;?>/list-weddings.php"><span></span>Current Requests</a></li>	
	<li class="c9d-nl">&nbsp;|&nbsp;</li>
	<li class="submenu <?php if($filename=='messages.php'  || $filename== 'show-messages.php') { echo "c9d-curpg";}?>"><a href="<?php echo URL;?>/messages.php">Messages <?php if($unreadCount > 0) echo '(' . $unreadCount . ')'; ?></a></li>
<?php }
else if(isset($_SESSION['buyerId'])){
	$senderId = $_SESSION['buyerId'];
require_once 'classes/database/objects/class.database.php';	
	require_once 'classes/database/objects/class.message.php';
	$messageObj = new Message();
	$messageList = $messageObj->GetList(array(
			array('toid','=', $senderId),
			array('isread', '=' , 'NO')
	));	
	$unreadCount = count($messageList);
?>
	<li class="submenu mwidt <?php if($filename=='account.php') { echo "c9d-curpg";}?>"><a href="<?php echo URL;?>/account.php"><span></span>My Account</a></li>
    <li class="c9d-nl">&nbsp;|&nbsp;</li>
	<li class="submenu <?php if($filename=='my-wedding.php' || $filename=='add-request.php' || $filename=='show-request.php' ) { echo "c9d-curpg";}?>"><a href="<?php echo URL;?>/my-wedding.php">My Wedding</a></li>
	<li class="c9d-nl">&nbsp;|&nbsp;</li>
	<li class="submenu <?php if($filename=='messages.php' || $filename== 'show-messages.php') { echo "c9d-curpg";}?>"><a href="<?php echo URL;?>/messages.php">Messages <?php if($unreadCount > 0) echo '(' . $unreadCount . ')'; ?></a></li>
<?php }
else if(isset($_SESSION['userId'])){
 ?>
	<li class="submenu mwidt <?php if($filename=='account.php') { echo "c9d-curpg";}?>"><a href="<?php echo URL;?>/account.php"><span></span>My Account</a></li>
    <li class="c9d-nl">&nbsp;|&nbsp;</li>
	<li class="submenu mwidt <?php if($filename=='contact-support.php') { echo "c9d-curpg";}?>"><a href="<?php echo URL;?>/contact-support.php"><span></span>Contact Us</a></li>
 <?php } else{ ?> 
	<li class="submenu mwidt <?php if($filename=='contact-support.php') { echo "c9d-curpg";}?>"><a href="<?php echo URL;?>/contact-support.php"><span></span>Contact Us</a></li> 
 <?php } ?>
    <li class="c9d-nl">&nbsp;|&nbsp;</li>
	<li class="submenu mwidt <?php if($filename=='help.php' || $filename=='faq.php' || $filename=='faq-detail.php' || $filename=='contact-support.php') { echo "c9d-curpg";}?>"><a href="<?php echo URL;?>/help.php"><span></span>Help</a></li>
</ul>