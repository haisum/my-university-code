<?php
require_once 'config/config.php';
require_once 'includes/secureLogin.php';
require_once 'includes/securePasswordChange.php';
require_once 'includes/secureSupplierBuyer.php';
require_once 'includes/secureBuyer.php';
require_once 'classes/database/objects/class.database.php';
require_once 'classes/database/objects/class.buyer.php';
require_once 'classes/database/objects/class.supplier.php';
require_once 'classes/database/objects/class.category.php';
require_once 'classes/database/objects/class.wedding.php';
require_once 'classes/database/objects/class.message.php';
require_once 'classes/database/objects/class.bid.php';
require_once 'classes/database/objects/class.weddingcategory.php';
require_once 'classes/Cipher.php';
$buyer = new Buyer();
$buyerId = $_SESSION['buyerId'];
if(!isset($_GET['token'])){
	header('Location: ' . URL . '/add-request.php' );
	exit;
}
$cipher = new Cipher('dirtoo');
$wedCId = $cipher->decrypt(str_replace(' ', '+', $_GET['token']));
if(!is_numeric($wedCId)){
 header('Location: ' . URL . '/add-request.php' );
 exit;
}
$wedC = new WeddingCategory();
$wedC->Get($wedCId);
$wedding = new Wedding();
$wedding->Get($wedC->weddingId);
if($wedding->buyerId != $buyerId){
 header('Location: ' . URL . '/add-request.php' );
 exit;
}
$error = null;
if(isset($_FILES,$_POST['budgetFrom'], $_POST['bidDeadline'],  $_POST['budgetTo'], $_POST['detail'])){
	 
	  $error = '';
	  $isFile = false;
	  if($_FILES['picture']['error'] == '0')
		{
			$isFile = true;
			if($_FILES['picture']['size'] > 5*1024*1024){
				$error .= "-Picture size too big! Maximum 5MB file allowed<br/>";
			}
			else if($_FILES['picture']['type'] != "image/gif" && 
				$_FILES['picture']['type'] != "image/jpg" && 
				$_FILES['picture']['type'] != "image/jpeg" && 
				$_FILES['picture']['type'] != "image/pjpeg" && 
				$_FILES['picture']['type'] != "image/bmp" && 
				$_FILES['picture']['type'] != "image/png"
			){
				$error .= "-Only jpg, jpeg, png, gif and bmp formats of picture are allowed You uploaded: {$_FILES['picture']['type']}<br/>";
			}
		}
		$from = intval($_POST['budgetFrom']);
		$to = intval($_POST['budgetTo']);
		$detail = trim($_POST['detail']);
		$deadline = date('Y-m-d H:i:s',  strtotime($_POST['bidDeadline']));
		if( $detail == '' || $to== 0 || $from == 0 || $deadline == '1970-01-01 01:00:00'){
			$error .= '-Fields can\'t be empty or zero<br/>';
		}
		if($error == ''){
			$wedC->detail = $detail;
			$wedC->budgetFrom = $from;
			$wedC->budgetTo = $to;
			$wedC->weddingId = $wedding->weddingId;
			$wedC->status = 'PENDING';
			$wedC->lastModified =  date('Y-m-d H:i:s', time());
			$wedC->bidDeadline = date('Y-m-d H:i:s',  strtotime($deadline));
			$wedC->Save();
			if($isFile){
				include_once("classes/ResizeImage.php");		
				$rimg=new ResizeImage($_FILES['picture']['tmp_name']);
				$rimg->resize(30, 30, 'img/weddingcats/' . $wedC->weddingcategoryId .  '_thumb.jpg');
				$rimg->resize_limitwh(120, 120, 'img/weddingcats/' . $wedC->weddingcategoryId . '.jpg');
				$rimg->close();					 
				copy($_FILES['picture']['tmp_name'], "img/weddingcats/". $wedC->weddingcategoryId . '_orig.jpg');
			}
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Wedding Price | Show Requests</title>
		
		
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/ui-lightness/jquery-ui-1.8.16.custom.css"/>		
        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/main.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/account.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/weddings.css"/>
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
                <!--<div class="top-nav">	  
                	
                </div>-->
                <div id="leftCol">
                    <?
                    	include('includes/my-account-left-links.php');
					?>
                </div>
				<div id="rightCol">
					<h1 class="myTitle"><?php $c = new Category(); $c->Get($wedC->categoryId); echo $c->name; ?> <a style='font-size:14px;' href='javascript:void(0);' title='Edit Details' onclick="$('#collapsable').show('slow');$(this).remove();"> (Edit Details) </a></h1> 	
                    <div class="clear">
					<?php if(strtotime($wedC->bidDeadline) < time()) { ?>
						<div class='error'>This request's bid deadline has passed. To receive further bids on this request extend it's deadline by <a href='javascript:void(0);' title='Edit Details' onclick="$('#collapsable').show('slow');$(this).remove();">editing details</a>
						</div>
					<?php } ?>
					<?php if($error!=null || $error != '') { ?>
						<p class='error'> 
							<?php echo $error; ?>
						</p>
						<?php  } ?>
					</div>
				
						<div id='collapsable' class='clear' style='display:none;'>						
					<form enctype="multipart/form-data" action='<?php echo URL . '/show-request.php?token=' . urlencode($_GET['token']);  ?>' method='post' >
					<div class='reqcontainer'>
						<div class='reqblock'> 
							<span class='reqlabel'>Request Posted On:</span>
							<span class='reqval'><?php echo date('d-m-Y H:i:s', strtotime($wedC->postedDate)); ?></span>
						</div>
						<div class='reqblock'> 
							<span class='reqlabel'>Last Modified On:</span>
							<span class='reqval'><?php echo date('d-m-Y H:i:s', strtotime($wedC->lastModified)); ?></span>
						</div>
				
							<div class='reqblock'> 
								<span class='reqlabel'>Bid Deadline:</span>
								<span class='reqval'><input name='bidDeadline'  type='text' class='text datepicker' value='<?php if(isset($_POST['bidDeadline'])){ echo $_POST['bidDeadline'];} else echo date('d-m-Y' , strtotime($wedC->bidDeadline)); ?>'/></span>
							</div>
							<div class='reqblock'> 
								<span class='reqlabel'>Budget:</span>
								<span class='reqval'>
									From $<input name='budgetFrom'  type='text' class='text numberOnly ' value='<?php if(isset($_POST['budgetFrom'])){ echo $_POST['budgetFrom']; } else echo $wedC->budgetFrom; ?>'/>
									To $<input name='budgetTo' type='text' class='text numberOnly ' value='<?php if(isset($_POST['budgetTo'])){ echo $_POST['budgetTo']; } else echo $wedC->budgetTo; ?>'/>
								</span>
							</div>
							<div class='reqblock'> 
								<span class='reqlabel'>Details:</span>
								<span class='reqval'><textarea style='width:200px;height:110px;' class='text' name='detail'><?php if(isset($_POST['detail'])) echo $_POST['detail']; else echo $wedC->detail; ?></textarea></span>
							</div>
							<div class='reqblock'> 
								<span class='reqlabel'>Image:</span>
								<span class='reqval'><img src='<?php echo URL . '/img/weddingcats/' . $wedC->weddingcategoryId . '.jpg?' . rand(); ?>' alt='image'/><br/><input d name='picture' type='file' /></span>
							</div>
							<div class='reqblock'> 
								<span class='reqlabel'><input style='float:none;clear:none;margin:0;' type='submit' value='Update' class='btn' /></span>
							</div>
						</div>
						
						<hr style='float:left;margin:20px 0px;clear:both;width:100%;'/>
					</form>
					
					</div>
				<br style="clear: both;"/>
				<?php
					$bid = new Bid();
					$bidList = $bid->GetList(array(
						array('weddingcategoryid' , '=',  $wedCId)
					));
				if(count($bidList)  != 0){ ?>
					<table class='wtable'>
					<thead>
						<tr>
							<th  style='width:20%;'>Supplier Name</th>
							<th  style='width:15%;'>Amount</th>
							<th  style='width:25%;'>Bid Date</th>
							<th style='width:40%;'>Description</th>
						</tr>
					</thead>
					<tbody class='hoverShow'>
				<?php
					foreach($bidList as $bid){
					?>				
						<tr>
							<td>
								<a class='detailsLink' href='<?php echo URL . '/show-bid-details.php?token=' . urlencode($_GET['token']) . '&bid=' . $bid->bidId; ?>'>
									<?php 
										$supplier = new Supplier();
										$supplier->Get($bid->supplierId);
										echo ucwords($supplier->name);
									?>
								</a>
							</td>
							<td>$<?php echo $bid->amount; ?></td>
							<td><?php echo date('d-m-Y' ,strtotime($bid->date)); ?></td>
							<td rel='<?php echo $bid->bidDescription; ?><br/><strong>Messages</strong> : <?php
							$message = new Message();$list =  $message->GetList(array(
								array('toid', '=', $supplier->supplierId),
								array('fromid', '=' , $buyerId),
								array('OR'),
								array('fromid', '=', $supplier->supplierId),
								array('toid', '=' , $buyerId)
							));
							$total = count($list);
							$list =  $message->GetList(array(
								array('toid', '=', $supplier->supplierId),
								array('fromid', '=' , $buyerId),
								array('OR'),
								array('fromid', '=', $supplier->supplierId),
								array('toid', '=' , $buyerId),
								array('isread', 'NO')
							));
							$unread = count($list);
							if($unread == 0){
								echo "$total";
							}
							else
								echo "$unread/$total";
							?><br/><strong>Response Status</strong>: <?php 
							switch($bid->status){
								case 'PENDING' : 
									echo 'Not Accepted Yet';
									break;
								case 'ACCEPTED' : 
									echo 'Accepted by you';
									break;
								case 'DISCARDED' : 
									echo 'Discarded by you';
									break;
								case 'REJECTED' : 
									echo 'Rejected by buyer';
									break;
								case 'CONFIRMED' : 
									echo 'Confirmed';
									break;
								case 'REVIEWDONE':	
									echo 'Completed';
									break;
								case 'REVIEWRESPONDED':	
									echo 'Completed';
									break;
								case 'COMPLETEDBUYER' : 
									echo 'Completed and Reviewed';
									break;
							}							
							?>' class='description'><?php echo substr($bid->bidDescription, 0, 40) . '...'; ?></td>
						</tr>
				<?php  } ?> 
				
					</tbody>
				</table>
				<?php } else { ?>
						<div class='info'>No responses for this request have been recieved yet.</div>
				<?php } ?>
            </div>
            </div>
        </div>
		 <?php require 'includes/footer.php'; ?>
		<script src="<?php echo URL;?>/js/jquery.js" type="text/javascript"></script>		
		<script type="text/javascript" src="<?php echo URL;?>/js/jquery-ui-1.8.16.custom.min.js"></script>	
		<script type="text/javascript" src="<?php echo URL;?>/js/main.js"></script>	
		<script type="text/javascript" src="<?php echo URL;?>/js/myWedding.js"></script>		
	</body>
</html>

