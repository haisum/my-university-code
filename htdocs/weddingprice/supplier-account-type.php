<?php
    require_once 'config/config.php';
	require 'includes/secureLogin.php';
	require 'includes/securePasswordChange.php';
	if($_SESSION['type'] != 'Supplier'){
		header("HTTP/1.0 404 Not Found");
		exit;
	}	
	require 'classes/database/objects/class.database.php';
	require 'classes/database/objects/class.supplier.php';
	require 'classes/database/objects/class.website.php';
	$supplierId = $_SESSION['supplierId'];
	$supplier = new Supplier();
	$supplier->Get($supplierId);	
	$web = new Website();
	$webList = $web->GetList(
		array(
			array('supplierid', '=' , $supplierId)
		)					
	);
	$error = null;
	if(isset($_POST['accountType'])){
		$type = intval($_POST['accountType']);
		if($type == 0 && $supplier->accountType != 'OUTOFFREEBIDS' && $supplier->accountType != 'FREE' && $supplier->accountType != 'GOLD')
		{
			$url = $_POST['link'];
			require_once 'includes/function.isvalidurl.php';
			if(isvalidurl($url)){
				require_once 'includes/function.checkurl.php';
				if(!checkurl($url, URL)){						
					$error .= '-Invalid URL to page that contains back link to Wedding Price site.<br/>';
				}
			}
			else{
				$error .= '-Invalid URL, URL should be full and must contain parts such as HTTP:// or HTTPS://.<br/>';
			}
			if($error == null){
				$supplier->accountType = 'FREE';
				$_SESSION['sAccountType'] = 'FREE';				
				$supplier->Save();
				if(count($webList) > 0){
					$web = $webList[0];
				}else{					
				  $web->name == 'Backlinking Website';
				  $web->supplierId = $supplierId;
				}
				$web->url = $url;
				$web->Save();
				header('Location: ' . URL . '/account.php');
				exit;
			}			
		}
		else if($type == 1){
			if($supplier->accountType != 'GOLD'){
				$supplier->accountType = 'PAYMENTNOTVERIFIED';
				$_SESSION['sAccountType'] = 'PAYMENTNOTVERIFIED';				
				$supplier->Save();
			}
			header('Location: ' . URL . '/proceed-gold-membership-payment.php?period=' . $_POST['period']);
			exit;
		}		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

    <head>
   
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

   <title>Wedding Price Sample - Supplier Account Type</title>

   <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/main.css"/>
   <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/account.css"/>
   <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>-->
   

   <!--[if lte IE 7]>

  <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/lteie7.css"/>

  <script defer type="text/javascript" src="<?php echo URL;?>/js/pngfix.js"></script>

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
		<div class="content" style="border: 2px solid #55B4FD;float:none;">	
			<div class="left_signup">
			<?php if ($error!=null){?>
				<div class="error_message" style="width:80%;margin:0px auto;"><?php echo $error;?></div>
			<?php } ?>
				<div class="topcap"><p class="signup_txt">
					<?php
					
						//echo $supplier->accountType . $_SESSION['sAccountType'] . 'asdf';
						switch($supplier->accountType){
							case 'OUTOFFREEBIDS':
								echo 'Seems like you have reached limit for free bids you must upgrade your account to Gold to continue bidding.';
								break;
							case 'PAYMENTNOTVERIFIED':
								echo 'You have registered as gold member but your payment could not be verified up to now. Select free account or make sure that you have done payment.';
								break;
							case 'JUSTREGISTERED':
								echo 'You have successfully registered as supplier. Please select one of supplier account types to start bidding.';
								break;
							case 'INVALIDURL':
								//die($_SESSION['sAccountType'] . 'asd'); 
								echo 'It appears that URL that you provided for page that back links to Wedding Price site has become invalid or no longer contains a back link. Verify URL for continuing your Free account or register as Gold member.';
								break;
							default:
								echo 'Current Account Type/Status: ' .  ucfirst(strtolower($supplier->accountType));
								break;
						}
					?>
				</p></div>
				  <table border="0" align="left" cellpadding="0" cellspacing="0">
					<tbody><tr>
					<td valign="top">
					<p class="formspace"></p>
					<form name="form1" id='register-supplier-form' method="post" action="<?php echo URL;?>/supplier-account-type.php" enctype="multipart/form-data">
						  <table class="signuptable">
						  <tbody>
						  <tr class="trd"> 
							  <td class="signuptable_txt">Account Type</td>
							  <td>
								  <div class="fm_input_wrapper" style='height:11px;'>
									<input <?php if($supplier->accountType == 'OUTOFFREEBIDS' || $supplier->accountType == 'FREE' || $supplier->accountType == 'GOLD') echo 'disabled="disabled"'; else echo ' checked="checked"'; ?> type='radio' value='0'  class='accountType' name='accountType'/>Free&nbsp;
									<input <?php if($supplier->accountType == 'OUTOFFREEBIDS' || $supplier->accountType == 'FREE'  || $supplier->accountType == 'GOLD') echo ' checked="checked"'; ?> value='1' type='radio' class='accountType' name='accountType'/>Gold
								  </div>
							  </td>
							</tr>
							</tbody>							
							<?php require_once 'includes/function.getconfig.php';  ?>
							<?php if($supplier->accountType != 'OUTOFFREEBIDS' && $supplier->accountType != 'FREE'  && $supplier->accountType != 'GOLD'){ ?>
							<tbody class='freediv'>
							
							<tr class="trd" style='height:200px;'> 
							  <td style='vertical-align:top;' class="signuptable_txt">Link <span style='font-size:9px;font-weight:normal;font-style:italic;'>(Only required for free users)</span></td>
							  <td>
								  <div class="fm_input_wrapper" style='height:115px;'>
									<input style='width: 510px;height: 30px;' class='text' type='text' value='<?php if(isset($_POST['link'])) echo $_POST['link']; else if(count($webList) > 0) echo $webList[0]->url; else echo "http://"; ?>' name='link'/><br/>
									<div class='info' style='width:455px; float:left;'>
										If you are registering for free membership, you must put a URL to <?php echo URL; ?> in your site.<br/>
										It should appear like <?php echo '<a href="' . URL . '">Wedding Price</a>'; ?> on your site. A free member can bid for only <?php getConfig('freebidsperuser'); ?> times. Gold members have no bid limit and don't need to put URL.										
									</div>
								  </div>
							  </td>
							</tr>
							</tbody>
							<?php } ?>	
							<tbody class='golddiv' style='<?php if($supplier->accountType != 'OUTOFFREEBIDS' && $supplier->accountType != 'FREE' && $supplier->accountType != 'GOLD') echo "display:none;" ;?>'>
							<tr class='trd' style='height:111px;'>  
							  <td style='vertical-align:top;' class="signuptable_txt">Period</td>
							  <td>
								  <div class="fm_input_wrapper" style='height:115px;'>
									<select name='period' style='margin-top:5px'>
										<option value='3'>3 Months</option>
										<option value='6'>6 Months</option>
										<option value='12'>Year (12 Months)</option>
									</select>
									<br/>
									<div class='warning' style='width:455px; float:left;'>
										Gold memebers have faster site response and no limit on number of bids. If you are registering for Gold membership select package that best suits you.
										Quaterly package will cost you $<?php echo getConfig('3monthpackage'); ?>, 
										6 month package will cost you $<?php echo getConfig('6monthpackage'); ?> and 
										a yearly package will cost you $<?php echo getConfig('12monthpackage'); ?>.										
									</div>
								  </div>
							  </td>
							</tr>
							</tbody>
							<tbody>
							<tr><td class="submitbuttnpd">&nbsp;</td>
							  <td class="submitbuttnpd"><input type="submit" value="Next" name="Submit" class="btn" style="margin-left:200px;float:left;clear:both; "></td>
							</tr>
						  </tbody></table>
					<br>
					</form>
				</td>
			  </tr>
			</tbody></table><p class="botcap">&nbsp;</p>
			</div>
			<br style="clear: both;">
		</div>
	</div>
 <?php require 'includes/footer.php'; ?>
   <script src="<?php echo URL;?>/js/jquery.js" type="text/javascript"></script>
   <script type="text/javascript" src="<?php echo URL;?>/js/main.js"></script>
 </body>

</html>