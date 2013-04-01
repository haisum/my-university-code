<?php
require_once 'config/config.php';
require_once 'includes/secureLogin.php';
require_once 'includes/securePasswordChange.php';
require_once 'includes/secureSupplierBuyer.php';
require_once 'includes/secureBuyer.php';
require_once 'classes/database/objects/class.database.php';
require_once 'classes/database/objects/class.buyer.php';
require_once 'classes/database/objects/class.category.php';
require_once 'classes/database/objects/class.wedding.php';
require_once 'classes/database/objects/class.weddingcategory.php';
require_once 'classes/Cipher.php';
$buyer = new Buyer();
$buyerId = $_SESSION['buyerId'];
$wedding = new Wedding();
$weddingList = $wedding->GetList(array(
	array('buyerid', '=', $buyerId)
), '', true, 1);
if(count($weddingList) == 0){
	$wedding->weddingDate = date('Y-m-d H:i:s', time());
	$wedding->bidDeadline = date('Y-m-d H:i:s', time());
	$wedding->regionId = '1';
	$wedding->guestCount = 0;
	$wedding->bridalPartySize = 0;
	$wedding->budgetFrom = 0;
	$wedding->budgetTo = 0;
	$wedding->additionalInfo = '';
	$wedding->status = 'OPEN';
	$wedding->postedDate = date('Y-m-d H:i:s', time());
	$wedding->buyerId = $buyerId;
	$wedding->lastModified = date('Y-m-d H:i:s', time());
	$wedding->title = ' (#) ';
	$wedding->Save();
}
else{
	$wedding = $weddingList[0];
}

$error = null;
if(isset($_FILES, $_POST['category'], $_POST['budgetFrom'], $_POST['bidDeadline'],  $_POST['budgetTo'], $_POST['detail'])){
	 
	  $error = '';
	  $hasPic = true;
	  if($_FILES['picture']['error'] != 0){
		$hasPic = false;
	  }
	  else if($_FILES['picture']['size'] > 5*1024*1024){
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
		$category = intval($_POST['category']);
		$from = intval($_POST['budgetFrom']);
		$to = intval($_POST['budgetTo']);
		$detail = trim($_POST['detail']);
		$deadline = date('Y-m-d H:i:s',  strtotime($_POST['bidDeadline']));
		if( $detail == '' || $to== 0 || $from == 0 || $category == 0  || $deadline == '1970-01-01 01:00:00'){
			$error .= '-Fields can\'t be empty or zero<br/>';
		}
		if($error == ''){
			$wedCat = new WeddingCategory();
			$wedCat->detail = $detail;
			$wedCat->budgetFrom = $from;
			$wedCat->budgetTo = $to;
			$wedCat->categoryId = $category;
			$wedCat->weddingId = $wedding->weddingId;
			$wedCat->status = 'PENDING';
			$wedCat->lastModified =  date('Y-m-d H:i:s', time());
			$wedCat->postedDate =  date('Y-m-d H:i:s', time());
			$wedCat->bidDeadline = date('Y-m-d H:i:s',  strtotime($deadline));
			$wedCat->Save();
			if($hasPic){
				include_once("classes/ResizeImage.php");		
				$rimg=new ResizeImage($_FILES['picture']['tmp_name']);
				$rimg->resize(30, 30, 'img/weddingcats/' . $wedCat->weddingcategoryId .  '_thumb.jpg');
				$rimg->resize_limitwh(120, 120, 'img/weddingcats/' . $wedCat->weddingcategoryId . '.jpg');
				$rimg->close();					 
				copy($_FILES['picture']['tmp_name'], "img/weddingcats/". $wedCat->weddingcategoryId . '_orig.jpg');
			}
			$cipher = new Cipher('lifebuoy');
			$link = URL . '/bid-wedding.php?token='  . urlencode($cipher->encrypt($wedCat->weddingcategoryId));	
			require_once 'classes/database/objects/class.emailtemplate.php';
			require_once 'classes/Mail.php';
			$mail = new Mail();
			$mail->requestInRegion($link, $wedding->regionId);
			$mail->requestInCategory($link, $wedCat->categoryId);
			$cipher = new Cipher('dirtoo');
			header('Location: ' . URL . '/show-request.php?token=' . urlencode($cipher->encrypt($wedCat->weddingcategoryId)));
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Wedding Price Buyer Account</title>
				
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
					<h1 class="myTitle">Add a Request</h1>
                    <div class="clear">
						<?php if($error!=null || $error != '') { ?>
						<p class='error'> 
							<?php echo $error; ?>
						</p>
						<?php  } ?>
					</div>
					<form action='<?php URL . '/add-request.php' ?>' method='post' enctype="multipart/form-data">
			<table class='etable ztable'>
				<tr>
					<td style="background:none;">
						<label>
							Category:
						</label>
					</td>
					<td style="background:none;">
						<select class='text' name='category'>
							<?php
								$categoryObj = new Category();
								$categoryList = $categoryObj->GetList(
									array(
										array(" categoryid NOT IN (select categoryid from weddingcategory where weddingid={$wedding->weddingId}) ")
									)
								);
								foreach($categoryList as $category){ ?>
									<?php 
										$categoryId = 0;
										if(isset($_POST['category'])){
											$categoryId = $_POST['category'];
										}
									?>
									<option value='<?php echo $category->categoryId; ?>' <?php if($category->categoryId == $categoryId) echo 'selected'; ?> ><?php echo ucfirst($category->name); ?></option>
								<?php }
							?>
						</select>	
					</td>
				</tr>
				<tr>
					<td style="background:none;">
						<label>
							Bid Deadline:
						</label>
					</td>
					<td style="background:none;">
						<input name='bidDeadline'   type='text' class='text datepicker' value='<?php if(isset($_POST['bidDeadline'])){ echo $_POST['bidDeadline'];} ?>'/>
					</td>
				</tr>
				<tr>
					<td style="background:none;">
						<label>
							Budget:
						</label>
					</td>
					<td style="background:none;">
						<span style='margin-top:5px;display:inline-block;' >From $</span><input name='budgetFrom' rel='<?php echo $wedding->weddingId;?>' type='text' class='text numberOnly ' value='<?php if(isset($_POST['budgetFrom'])){ echo $_POST['budgetFrom']; } ?>'/>
						<span style='margin-top:5px;display:inline-block;' >To $</span><input name='budgetTo' rel='<?php echo $wedding->weddingId;?>' type='text' class='text numberOnly ' value='<?php if(isset($_POST['budgetTo'])){ echo $_POST['budgetTo']; } ?>'/>
					</td>
				</tr>
				<tr>
					<td>
						<label>
							Details:
						</label>
					</td>
					<td>
						<textarea style='width:200px;height:110px;' class='text' name='detail'><?php if(isset($_POST['detail'])) echo $_POST['detail']; ?></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<label>
							Image:
						</label>
					</td>
					<td>
						<input name='picture' type='file' />
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type='submit' value='Add Request' class='btn' style='margin:0;float:none;clear:both;'/>												
					</td>
				</tr>
			</table>
		</form>
				
				<br style="clear: both;"/>
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

