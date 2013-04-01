<?php
require_once 'config/config.php';
require_once 'includes/secureLogin.php';
require_once 'includes/securePasswordChange.php';
require_once 'includes/secureSupplier.php';
require_once 'includes/secureBid.php';
//require_once '../includes/secureSupplier.php';
require_once 'classes/database/objects/class.database.php';
require_once 'classes/database/objects/class.category.php';
require_once 'classes/database/objects/class.region.php';
require_once 'classes/database/objects/class.buyer.php';

require_once 'classes/database/objects/class.bid.php';
require_once 'classes/database/objects/class.wedding.php';
require_once 'classes/database/objects/class.weddingcategory.php';
require_once 'classes/database/objects/class.message.php';
require_once 'classes/Cipher.php';
$cipher = new Cipher('lifebuoy');
if (!isset($_GET['token'])){
	echo "<script type='text/javascript'>window.location.href='" . URL . '/list-weddings.php' . "';</script>";
	exit();
}
else{


	$wcId = $cipher->decrypt(str_replace(' ', '+',$_GET['token']));
	$wcObj = new WeddingCategory();
	$wcList = $wcObj->GetList(array(
		array('weddingcategoryid' , '=' , $wcId),
	));
	if(count($wcList)!=1){
		echo "<script type='text/javascript'>window.location.href='" . URL . '/list-weddings.php' . "';</script>";
		exit();
	}
	$supplierId = $_SESSION['supplierId'];
	$wc = $wcList[0];	
	$wedding = new Wedding();
	$wedding->Get($wc->weddingId);
	$category = new Category();
	$categories = $category->GetList(array(
		array(" categoryid IN (select categoryid from weddingcategory where weddingid={$wedding->weddingId}) ")
	));
	mysql_connect(HOST, USER, PASSWORD);
	mysql_select_db(DBNAME);	
	
	$query = "select categoryid from category where categoryid IN (select categoryid from categorysuppliermap where supplierid=$supplierId) OR categoryid IN (select primarycategoryid from supplier where supplierid = $supplierId)";
	$result = mysql_query($query);
	$myCats = array();
	while($row = mysql_fetch_assoc($result)){
		$myCats[] = $row['categoryid'];
	}
	
	$query = "select regionid from region where regionid IN (select regionid from regionsuppliermap where supplierid=$supplierId) OR regionid IN (select primaryregionid from supplier where supplierid = $supplierId)";
	$result = mysql_query($query);
	$myRegs = array();
	while($row = mysql_fetch_assoc($result)){
		$myRegs[] = $row['regionid'];
	}
	$cat = new Category(); $cat->Get($wc->categoryId);
	$canBid = false;
	$error = '';
	if(isset($_POST['amount'],  $_POST['description'])){
    //////////////////////////	
		$amount = $_REQUEST['amount'];
		$description = $_REQUEST['description'];
		$messageC = $_REQUEST['message'];
		$domessage = $_REQUEST['doMessage'];
		$weddingcatObj = $wc;
		if($amount == 0 || !is_numeric($amount)){
			$error .= 'Invalid Amount<br/>';
		}
		if(trim($description) == ''){
			$error .= 'Give a little description of your bid!';
		}
		if($error == ''){
			$categoryId = $weddingcatObj->categoryId;
			$weddingId = $weddingcatObj->weddingId;
			$supplierId = $_SESSION['supplierId'];
			$bidObj = new Bid();
			$bidObj->weddingId = $weddingId;
			$bidObj->weddingcategoryId = $wc->weddingcategoryId;
			$bidObj->amount = intval($amount);
			$bidObj->supplierId = $supplierId;
			$bidObj->categoryId = $categoryId;
			$bidObj->bidDescription = htmlspecialchars($description, ENT_QUOTES);
			$bidObj->date = strftime('%Y-%m-%d %H:%M:%S', time());
			$bidObj->lastModified = strftime('%Y-%m-%d %H:%M:%S', time());
			$bidObj->status = 'PENDING';
			$bidObj->Save();
			if($domessage == 'on' && trim($messageC) != ''){
				$buyer = new Buyer();
				$buyer->Get($wedding->buyerId);	
				$message = new Message();
				$message->weddingId = intval($weddingId);
				$message->toId = $buyer->buyerId;
				$message->fromId = $supplierId;
				$message->isRead = 'NO';
				$message->from = 'Supplier';
				$message->content = htmlspecialchars($messageC, ENT_QUOTES);
				$message->status = 'SHOW';
				$message->date = date('y-m-d H:i:s' , time());
				$message->Save();
			}
		}
		else
			echo $error;
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Wedding Price | Bid on Request</title>
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/ui-lightness/jquery-ui-1.8.16.custom.css"/>		
        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/main.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/account.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/weddings.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/bid.css"/>
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
                <div class="content" style="background-image:none;border:none;margin-top:0px;">
					<div id="tabs">
						<ul>
							<li><a href='#tabs-1'><?php echo ucwords($cat->name) . ' for ' . str_replace('(#)', '&', ucwords($wedding->title));  ?></a></li>
							
						</ul>
						<div id='tabs-1' style="float:none; width:920px; margin:0px auto;">						
						<div class="clear"></div>
						<div class='ui-widget'>
							<div class='smallDetails'>
								<div class='detailBox'><strong>Request for:</strong><span><?php  echo $cat->name; ?></span><div style='clear:both;line-height:1px;'></div></div>
								<div class='detailBox'><strong>Groom Name:</strong><span><?php $temp = explode(' (#) ', $wedding->title); echo $temp[0];?></span><div style='clear:both;line-height:1px;'></div></div>
								<div class='detailBox'><strong>Bride Name:</strong><span><?php echo $temp[1];?></span><div style='clear:both;line-height:1px;'></div></div>
								<div class='detailBox'><strong>Wedding Date:</strong><span><?php echo date('d-M-Y' , strtotime($wedding->weddingDate));?></span><div style='clear:both;line-height:1px;'></div></div>
								<div class='detailBox'><strong>Bid Deadline:</strong><span><?php echo date('d-M-Y' , strtotime($wc->bidDeadline));?></span><div style='clear:both;line-height:1px;'></div></div>
								<div class='detailBox'><strong>Region:</strong><span><?php echo $wedding->GetRegion()->name;?></span><div style='clear:both;line-height:1px;'></div></div>
								<div class='detailBox'><strong>Guest Count:</strong><span><?php echo $wedding->guestCount; ?></span><div style='clear:both;line-height:1px;'></div></div>
								<div class='detailBox'><strong>Bridal Party Size:</strong><span><?php echo $wedding->bridalPartySize; ?></span><div style='clear:both;line-height:1px;'></div></div>							
								<div class='detailBox'><strong>Posted By:</strong><span><?php echo $wedding->GetBuyer()->contactPerson; ?></span><div style='clear:both;line-height:1px;'></div></div>
								<div class='detailBox'><strong>Budget:</strong><span><?php echo $wc->budgetFrom; ?> to <?php echo $wc->budgetTo; ?></span><div style='clear:both;'></div></div>
								<div class='detailBox'><strong>Posted On:</strong><span><?php echo date('d-M-Y' , strtotime($wc->postedDate));?></span><div style='clear:both;'></div></div>
								<div class='detailBox'><strong>Last Modified On:</strong><span><?php echo date('d-M-Y' , strtotime($wc->lastModified));?></span><div style='clear:both;'></div></div>
								<?php
									$query = "SELECT IFNULL(count(amount),0) as count, IFNULL(min(amount),0) as min, IFNULL(max(amount),0) as max, ROUND(IFNULL(avg(amount),0),0) as avg from bid where weddingcategoryid=(select weddingcategoryid from weddingcategory where weddingid={$wedding->weddingId} AND categoryid={$cat->categoryId})";
									$result = mysql_query($query);
									if($row = mysql_fetch_assoc($result)){
									$count = $row['count'];
									if($count != 0){
									?>										
									<div class='detailBox'><strong>Total Bids:</strong><span><?php echo $row['count']; ?></span><div style='clear:both;'></div></div>
									<div class='detailBox'><strong>Average Bid Amount:</strong><span><?php echo $row['avg']; ?></span><div style='clear:both;'></div></div>
									<div class='detailBox'><strong>Minimum Bid:</strong><span><?php echo $row['min']; ?></span><div style='clear:both;'></div></div>
									<div class='detailBox'><strong>Maximum Bid:</strong><span><?php echo $row['max']; ?></span><div style='clear:both;'></div></div>
								<?php } else { ?>
									<br style='clear:both;'/><p style='margin-bottom:10px;'>No bids on this request yet!</p>
								<?php } } 
								
								$bid = new Bid();
				$bidList = $bid->GetList(array(
					array('supplierid', '=' , $supplierId),
					array('weddingid', '=', $wc->weddingId),
					array('categoryid', '=', $wc->categoryId)
				));
				if(count($bidList) > 0){
				?>
				<p>You have bid on this category. Go to <a href='<?php echo URL . '/show-bid.php?bid=' . $bidList[0]->bidId; ?>' style='color: #0486C9;'>your bids page</a> to monitor your bid.</p>
				<?php }
				else if (!(in_array($wedding->regionId, $myRegs))){ ?>
				<p>You haven't yet selected this wedding's region as your preferred region in <a href='<?php echo URL;?>/account.php' style='color: #0486C9;'>account settings</a>. Change your <a href='<?php echo URL;?>/account.php'  style='color: #0486C9;'>account settings</a> to bid on this category.</p>
				<?php }
				else if(!in_array($wc->categoryId, $myCats)){
				?>
				<p>You haven't yet selected this category as your preferred category in <a href='<?php echo URL;?>/account.php' style='color: #0486C9;'>account settings</a>. Change your <a href='<?php echo URL;?>/account.php'  style='color: #0486C9;'>account settings</a> to bid on this category.</p>
				<?php }
				else{ $canBid = true; ?>
					<a href='javascript:void(0);' onclick='$("#tabs").tabs("select", 1);' style='margin:0;color:#fff;float:none;width:100px;' class='btn'>Bid Now</a>
				<?php } 
			 ?>
							</div>
							<div class='additionalInfo'>
								<img src="<?php echo URL . "/img/weddingcats/{$wcId}.jpg";?>" alt= 'image' class='weddingImg' />
								<p>								
								<strong>Details</strong><br/>
								<?php echo $wc->detail; ?>
								</p>
							</div>
							<div style='clear:both;line-height:1px;'></div>
							<div class='bidCounts'>
								
							</div>
							
							</div> 
						</div><!-- rightCol -->
						<?php if($canBid){ ?>
						<div id='bid-now'>
							<form action='bid-wedding.php?<?php echo $_SERVER['QUERY_STRING']; ?>#bid-now' method='post'>
								<input name='weddingcategory' type='hidden' value='<?php echo $wcId; ?>' id='weddingcategory'/>
								<?php if($error != ''){ ?>
								<div class='error'>
									<?php echo $error; ?>
								</div>
								<?php } ?>
								<div class='inputContainer'>
									<label>Amount</label>
									<input value="<?php if(isset($_POST['amount'])) echo $_POST['amount']; ?>" name='amount' type='text' class='text numberOnly'/>
								</div>
								<div class='inputContainer'>
									<label>Description</label>
									<textarea name='description' class='text'><?php if(isset($_POST['description'])) echo $_POST['description']; ?></textarea>
								</div>
								<div class='inputContainer'>
									<input id='sendPrivateMessage' checked='checked'  name='doMessage' type='checkbox'/>
									<label style='width:135px;'  for='sendPrivateMessage'>Send Private Message</label>
								</div>	
								<div class='inputContainer'>
									<textarea style='margin-left:80px;' id='privateMessage'  name='message' class='text'><?php if(isset($_POST['message'])) echo $_POST['message']; ?></textarea>
								</div>		
								
								<div class='inputContainer'>
									<input type='submit' class='btn bidNowButton' value='Bid Now' />
								</div>
							</form>
						</div>
						<?php } ?>
						
					</div>
					<br style="clear: both;"/>
				</div>
            </div>
        </div>
		 <?php require 'includes/footer.php'; ?>
		<script src="<?php echo URL;?>/js/jquery.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo URL;?>/js/jquery-ui-1.8.16.custom.min.js"></script>	
		<script type="text/javascript" src="<?php echo URL;?>/js/jquery.cookie.js"></script>			
		<script src="<?php echo URL;?>/js/tooltip.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo URL;?>/js/main.js"></script>	
		<script type="text/javascript" src="<?php echo URL;?>/js/bid.js"></script>
	</body>
</html>
<?php 
}
?>