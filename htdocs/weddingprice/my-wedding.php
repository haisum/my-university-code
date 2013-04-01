<?php
require_once 'config/config.php';
require_once 'includes/secureLogin.php';
require_once 'includes/securePasswordChange.php';
require_once 'includes/secureSupplierBuyer.php';
require_once 'includes/secureBuyer.php';
require_once 'classes/database/objects/class.database.php';
require_once 'classes/database/objects/class.buyer.php';
require_once 'classes/database/objects/class.region.php';
require_once 'classes/database/objects/class.wedding.php';
$buyer = new Buyer();
$buyerId = $_SESSION['buyerId'];
$buyer->Get($buyerId);
$regionObj = new Region();
$regionList = $regionObj->GetList(array(
		array('countryid','=',$buyer->countryId)
));
$regions = '';
foreach($regionList as $region){
	$regions .= "<option value='" . $region->regionId . "'>" . $region->name . "</option>";
}
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
	$wedding->title = 'Unknown groom (#) Unknown bride';
	$wedding->Save();
}
else{
	$wedding = $weddingList[0];
}

$error = null;
if(isset($_POST['groomName'],$_POST['brideName'],$_POST['weddingDate'],$_POST['region'],$_POST['guestCount'],$_POST['bridalPartySize'])){
	$groomName = trim($_POST['groomName']);
	$brideName = trim($_POST['brideName']);
	$weddingDate = trim($_POST['weddingDate']);
	$region = intval($_POST['region']);
	$guestCount = intval($_POST['guestCount']);
	$bridalPartySize = intval($_POST['bridalPartySize']);
	$error = '';
	if($groomName == '' || $brideName == '' || $weddingDate == '' || $region == '' || $guestCount == '' || $bridalPartySize == '' || $guestCount == 0 || $bridalPartySize == 0 || $region == 0){
		$error .= 'Fields can\'t be empty or zero<br/>';
	}
	else{
		$wedding->title = $groomName . ' (#) ' . $brideName;
		$wedding->weddingDate = date('Y-m-d H:i:s', strtotime($weddingDate));
		$wedding->regionId = $region;
		$wedding->guestCount = $guestCount;
		$wedding->bridalPartySize = $bridalPartySize;
		$wedding->Save();
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Wedding Price Buyer Account</title>
		
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/token-input.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/token-input-facebook.css"/>		
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/ui-lightness/jquery-ui-1.8.16.custom.css"/>		
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/uploadify.css"/>
		
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
					<h1 class="myTitle">My Wedding</h1>
                    <div class="clear">
					<?php if(strtotime($wedding->weddingDate) < time()){ ?>
						<div class='error'>This wedding's date has passed and it's requests are no more listed as bidable.
						<br/>Edit details to extend wedding date
						</div>
					<?php } ?>
						<?php if($error!=null &&  $error != '') { ?>
						<p class='error'> 
							<?php echo $error; ?>
						</p>
						<?php  } ?>
					</div>
					<form action='<?php URL . '/my-wedding.php' ?>' method='post'>
			<table class='etable ztable'>
				<tr>
					<td style="background:none;">
						<label>
							Groom Name:
						</label>
					</td>
					<td style="background:none;">
						<input name='groomName' rel='<?php echo $wedding->weddingId;?>' id='groomName' type='text' class='text' value='<?php if(isset($_POST['groomName'])){ echo $_POST['groomName']; } else { $title = explode('(#)', $wedding->title);  echo trim($title[0]);} ?>'/>
					</td>
				</tr>
				<tr>
					<td style="background:none;">
						<label>
							Bride Name:
						</label>
					</td>
					<td style="background:none;">
						<input name='brideName' rel='<?php echo $wedding->weddingId;?>' id='brideName' type='text' class='text' value='<?php if(isset($_POST['brideName'])){ echo $_POST['brideName']; } else { echo trim($title[1]); } ?>'/>
					</td>
				</tr>
				<tr>
					<td style="background:none;">
						<label>
							Wedding Date:
						</label>
					</td>
					<td style="background:none;">
						<input name='weddingDate' rel='<?php echo $wedding->weddingId;?>' id='weddingDate' type='text' class='text datepicker' value='<?php if(isset($_POST['weddingDate'])){ echo $_POST['weddingDate']; } else{ echo date('d-m-Y', strtotime($wedding->weddingDate)); }?>'/>
					</td>
				</tr>
				<tr>
					<td>
						<label>
							Region:
						</label>
					</td>
					<td>
						<select class='text' id="region" name='region'>
							<?php
								$regionObj = new Region();
								$regionList = $regionObj->GetList();
								foreach($regionList as $region){ ?>
									<?php 
										$regionId = $wedding->regionId;
										if(isset($_POST['region'])){
											$regionId = $_POST['region'];
										}
									?>
									<option value='<?php echo $region->regionId; ?>' <?php if($region->regionId == $regionId) echo 'selected'; ?> ><?php echo $region->name; ?></option>
								<?php }
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label>
							Guest Count:
						</label>
					</td>
					<td>
						<input name='guestCount' type='text' id="guestCount" class='text numberOnly'  value='<?php if(isset($_POST['guestCount'])){ echo $_POST['guestCount']; } else{  echo $wedding->guestCount; } ?>'/>
					</td>
				</tr>
				<tr>
					<td>
						<label>
							Size of bridal party:
						</label>
					</td>
					<td>
						<input name="bridalPartySize" id="bridalPartySize" type='text' class='text numberOnly'  value='<?php if(isset($_POST['bridalPartySize'])){ echo $_POST['bridalPartySize']; } else{   echo $wedding->bridalPartySize; } ?>'/>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type='submit' value='Update' class='btn' style='margin:0;float:none;clear:both;'/>												
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
		<script type="text/javascript" src="<?php echo URL;?>/js/jquery.tokeninput.js"></script>
		<script src="<?php echo URL;?>/js/jquery.paginate.js" type="text/javascript"></script>		
		<script type="text/javascript" src="<?php echo URL;?>/js/swfobject.js"></script>
		<script type="text/javascript" src="<?php echo URL;?>/js/uploadify.min.js"></script>
		<script type="text/javascript" src="<?php echo URL;?>/js/myWedding.js"></script>		
	</body>
</html>
