<?php
    require_once 'config/config.php';
	require 'includes/secureLogin.php';
	require 'includes/securePasswordChange.php';
	require 'includes/secureNormal.php';
	require 'classes/database/objects/class.database.php';
	require 'classes/database/objects/class.region.php';
	require 'classes/database/objects/class.country.php';	
	$countryRegionsJSON = require 'includes/countryJSON.php';
	$error = null;
	if(isset($_POST['name'],$_POST['contactEmail'],$_POST['phone'],$_POST['contactPerson'],$_POST['country'],$_POST['primaryRegion'],$_POST['zip'],$_POST['address'])){
		$name = trim($_POST['name']);
		$contactEmail = trim($_POST['contactEmail']);
		$phone = trim($_POST['phone']);
		$contactPerson = trim($_POST['contactPerson']);
		$country = trim($_POST['country']);
		$primaryRegion = trim($_POST['primaryRegion']);
		$zip = trim($_POST['zip']);
		$address2 = trim($_POST['address2']);
		$city = trim($_POST['city']);
		$address = trim($_POST['address']);
		$recieveQuotes  = trim($_POST['recieveQuotes']) == 'on' ? 'Yes' : 'No';
		if($name == "" || $contactEmail  == "" || $phone  == "" || $contactPerson  == "" || $zip  == "" || $address  == ""){
			$error = "-Required Fields can't be empty.<br/>";
		}
		require 'classes/Validator.php';
		$validator = new Validator();
		if($contactEmail != "" && $contactEmail != "Required" && !$validator->isValidEmail($contactEmail)){
			$error .= "-Invalid Contact Email<br/>";
		}
		
		if(!isset($_FILES['picture'])){
			$error .= "-You must upload a picture<br/>";
		}
		else if($_FILES['picture']['size'] > 2*1024*1024){
			$error .= "-Picture size too big! Maximum 2MB file allowed<br/>";
		}
		else if($_FILES['picture']['type'] != "image/gif" && 
		$_FILES['picture']['type'] != "image/jpg"&& 
		$_FILES['picture']['type'] != "image/jpeg" && 
		$_FILES['picture']['type'] != "image/pjpeg" && 
		$_FILES['picture']['type'] != "image/bmp"&& 
		$_FILES['picture']['type'] != "image/png"
		){
			$error .= "-Only jpg, jpeg, png, gif and bmp formats of picture are allowed<br/>";
		}
		
		if($error == null){
			require 'classes/database/objects/class.user.php';		
			require 'classes/database/objects/class.buyer.php';
			$buyer = new Buyer();
			$buyer->userId = $_SESSION['userId'];
			$buyer->contactEmail = $contactEmail;
			$buyer->name = $name;
			$buyer->phone = $phone;
			$buyer->contactPerson = $contactPerson;
			$buyer->countryId = $country;
			$buyer->primaryregionId = $primaryRegion;
			$buyer->zip = $zip;
			$buyer->address = $address;
			$buyer->recieveQuotes = $recieveQuotes;			
			$buyer->city = $city;
			$buyer->address2 = $address2;
			$buyer->Save();
			
			include_once("classes/ResizeImage.php");		
			$rimg=new ResizeImage($_FILES['picture']['tmp_name']);
			$rimg->resize(30, 30, 'img/buyer/' . $buyer->buyerId . '_thumb.jpg');
			$rimg->resize_limitwh(120, 120, 'img/buyer/' . $buyer->buyerId . '.jpg');
			$rimg->close();					
			copy($_FILES['picture']['tmp_name'], "img/buyer/". $buyer->buyerId . '_orig.jpg');			
			
			$user = new User();
			$user = $user->Get($buyer->userId);
			$user->type = 'Buyer';//1 stands for Supplier, 2 for Buyer and 0 for Normal
			$user->Save();
			$_SESSION['type'] = 'Buyer';
			$_SESSION['buyerId'] = $buyer->buyerId;
			echo "<script type='text/javascript'>window.location.href='" . URL . "/buyer-account.php';</script>";
			exit();
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

    <head>
   
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

   <title>Wedding Price Sample - Register Type</title>

	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/main.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/account.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/validationEngine.jquery.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/template.css"/>
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
				<div class="topcap"><p class="signup_txt">You're just seconds away from your Wedding Price Sample Buyer account.</p></div>
				  <table border="0" align="left" cellpadding="0" cellspacing="0">
					<tbody><tr>
					<td valign="top">
					<p class="formspace"></p>
					<form name="form1" method="post" id='register-buyer-form' action="<?php echo URL;?>/register-buyer.php" enctype="multipart/form-data">
						  <table class="signuptable">
							<tbody><tr> 
							  <td class="signuptable_txt">Name</td>
							  <td>
								<div class="fm_input_wrapper">
									<input value="<?php if(isset($_POST['name'])) echo $_POST['name'];?>" name="name" type="text" id="name"  class="input_txt text validate[required,minSize[4],maxSize[30]]">
								</div>
							   </td>
							</tr>
							<tr class="trd"> 
							  <td class="signuptable_txt">Contact Email</td>
							  <td><div class="fm_input_wrapper"><input value="<?php if(isset($_POST['contactEmail'])) echo $_POST['contactEmail'];?>" name="contactEmail" type="text" id="email" class="input_txt text validate[required,custom[email]]"></div></td>
							</tr>
							<tr> 
							  <td class="signuptable_txt">Phone</td>
							  <td><div class="fm_input_wrapper"><input value="<?php if(isset($_POST['phone'])) echo $_POST['phone'];?>" name="phone" type="text" id="phone" maxlength="15" class="input_txt text validate[required]"></div></td>
							</tr>
							<tr>  
							  <td class="signuptable_txt">Contact Person</td>
							  <td><div class="fm_input_wrapper"><input name="contactPerson" value="<?php if(isset($_POST['contactPerson'])) echo $_POST['contactPerson'];?>" type="text" id="text" maxlength="15" class="input_txt text validate[required,minSize[4],maxSize[30]]"></div></td>
							</tr>								
							<tr class="trd"> 
							  <td class="signuptable_txt">Country</td>
							  <td>
								  <div class="fm_input_wrapper">
										<select name="countryList" type="text" class="input_txt text countries">
										<?php
											$needarray = true;
											$countryData = require 'includes/countryJSON.php';
											foreach($countryData as $key => $country){ ?>
												<option rel='<?php echo $key;?>' value='<?php echo $country['id'];?>' ><?php echo $country['name'];?></option>
											<?php }
										?>
									</select>
									<input type="hidden" id="country" name="country" value="<?php echo $countryData[0]['id'];?>"/>
								  </div>
							  </td>
							</tr>
							<tr class="trd"> 
							  <td class="signuptable_txt">Region</td>
							  <td>
								<div class="fm_input_wrapper">
									<select name="state" type="text" class="input_txt text regions">
										<?php for($i = 0; $i<count($countryData[0]['regions']);$i++){ ?>
												<option value='<?php echo $countryData[0]['regions'][$i]['id'];?>'>
													<?php echo $countryData[0]['regions'][$i]['name'];?>											
												</option>
											<?php } ?>
									</select>
									<input type="hidden" id="primaryRegion" name="primaryRegion" value="<?php echo $countryData[0]['regions'][0]['id'];?>"/>
								 </div>
							  </td>
							</tr>
							<tr class="trd"> 
							  <td class="signuptable_txt">City</td>
							  <td><div class="fm_input_wrapper"><input value="<?php if(isset($_POST['city'])) echo $_POST['city'];?>" name="city" type="text" id="city"  maxlength="255"  class="input_txt text validate[required,minSize[4],maxSize[20]]"></div></td>
							</tr>
							<tr class="trd"> 
							  <td class="signuptable_txt">Zip</td>
							  <td><div class="fm_input_wrapper"><input value="<?php if(isset($_POST['zip'])) echo $_POST['zip'];?>" name="zip" type="text" id="zip" maxlength="255" class="input_txt text validate[required]"/></div></td>
							</tr>	
							<tr class="trd"> 
							  <td class="signuptable_txt">Address Line 1</td>
							  <td><div class="fm_input_wrapper"><input value="<?php if(isset($_POST['address'])) echo $_POST['address'];?>" name="address" type="text" id="address" class="input_txt text validate[required,minSize[8]]"/></div></td>
							</tr>							
							<tr class="trd"> 
							  <td class="signuptable_txt">Address Line 2</td>
							  <td><div class="fm_input_wrapper"><input value="<?php if(isset($_POST['address2'])) echo $_POST['address2'];?>" name="address2" type="text" id="address2"  maxlength="500"  class="input_txt text"/></div></td>
							</tr>							
							<tr class="trd"> 
							  <td class="signuptable_txt">Picture</td>
							  <td><div class="fm_input_wrapper"><input value="<?php if(isset($_FILE['picture']['name'])) echo $_FILE['picture']['name'];?>" name="picture" type="file" id="picture" class='validate[required]'/></div></td>
							</tr>
							<tr> 
							<td class="nospacetd">&nbsp;</td>
							  <td class="nospacetd" style="margin-left:200px;width:300px;" ><p class="txti"><input name="recieveQuotes" type="checkbox" checked /></p><p class="txtp">Also Recieve Quotes by Email.</p></td>
							</tr>
							<tr><td class="submitbuttnpd">&nbsp;</td>
							  <td class="submitbuttnpd"><input type="submit" value="Update My Account" name="Submit" class="btn" style="margin-left:200px;" /></td>
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
   <script src="<?php echo URL;?>/js/jquery.validationEngine-en.min.js" type="text/javascript"></script>
   <script src="<?php echo URL;?>/js/jquery.validationEngine.min.js" type="text/javascript"></script>
    <script type="text/javascript">
		var countryJSON = $.parseJSON('<?php echo $countryRegionsJSON; ?>');	
	</script>
   <script type="text/javascript" src="<?php echo URL;?>/js/main.js"></script>
    </body>

</html>

