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
	if(isset($_POST['name'],$_POST['salesEmail'],$_POST['phone'],$_POST['contactPerson'],$_POST['country'],$_POST['primaryRegion'],$_POST['zip'],$_POST['address'])){		
		$name = trim($_POST['name']);
		$salesEmail = trim($_POST['salesEmail']);
		$phone = trim($_POST['phone']);
		$contactPerson = trim($_POST['contactPerson']);
		$country = trim($_POST['country']);
		$primaryRegion = trim($_POST['primaryRegion']);
		$state = trim($_POST['state']);
		$zip = trim($_POST['zip']);
		$address = trim($_POST['address']);
		$nonSalesEmail = trim($_POST['nonSalesEmail']);
		$address2 = trim($_POST['address2']);
		$city = trim($_POST['city']);
		$cprofile = trim($_POST['cprofile']);
		$type = intval($_POST['accountType']);
		$recieveRequests  = trim($_POST['recieveRequests']) == 'on' ? 'Yes' : 'No';
		if($name == "" || $salesEmail  == "" || $phone  == "" || $contactPerson  == "" || $zip  == "" || $address  == "" || $cprofile == ''){
			$error = "-Required Fields can't be empty.<br/>";
		}
		require 'classes/Validator.php';
		$validator = new Validator();
		if($salesEmail != "" && !($validator->isValidEmail($salesEmail))){
			$error .= "-Invalid Sales Email<br/>";
		}
		if($nonSalesEmail != "" && !$validator->isValidEmail($nonSalesEmail)){
			$error .= "-Invalid Non Sales Email<br/>";
		}
		//print_r($_FILES);
		//exit;
		if(!isset($_FILES['picture'])){
			$error .= "-You must upload a picture<br/>";
		}
		else if($_FILES['picture']['size'] > 2*1024*1024){
			$error .= "-Picture size too big! Maximum 2MB file allowed<br/>";
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
		if($error == null){
			require 'classes/database/objects/class.user.php';
			require 'classes/database/objects/class.supplier.php';
			$supplier = new Supplier();
			$supplier->userId = $_SESSION['userId'];
			$supplier->salesEmail = $salesEmail;
			$supplier->nonSalesEmail = $nonSalesEmail;
			$supplier->name = $name;
			$supplier->phone = $phone;
			$supplier->contactPerson = $contactPerson;
			$supplier->countryId = $country;
			$supplier->primaryregionId = $state;
			$supplier->zip = $zip;
			$supplier->address = $address;
			$supplier->primaryCategoryId = $_POST['primaryCategory'];
			$supplier->city = $city;
			$supplier->address2 = $address2;
			$supplier->recieveRequests = $recieveRequests;
			$region = new Region();
			$region->Get($supplier->primaryregionId);
			$supplier->AddRegion($region);
			$supplier->companyProfile = $cprofile;			
			$supplier->accountType = 'JUSTREGISTERED';					
			$supplier->Save();
			include_once("classes/ResizeImage.php");		
			$rimg=new ResizeImage($_FILES['picture']['tmp_name']);
			$rimg->resize(30, 30, 'img/supplier/' . $supplier->supplierId . '_thumb.jpg');
			$rimg->resize_limitwh(120, 120, 'img/supplier/' . $supplier->supplierId . '.jpg');
			$rimg->close();					
			copy($_FILES['picture']['tmp_name'], "img/supplier/". $supplier->supplierId . '_orig.jpg');			
			
			$user = new User();
			$user = $user->Get($supplier->userId);
			$user->type = 'Supplier';
			$user->Save();			
			$_SESSION['type'] = 'Supplier';//1 stands for Supplier, 2 for Buyer and 0 for Normal
			$_SESSION['supplierId'] = $supplier->supplierId;
			$_SESSION['sAccountType'] = 'JUSTREGISTERED';
			echo "<script type='text/javascript'>window.location.href='" . URL . "/supplier-account-type.php';</script>";
			exit;			
			
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
				<div class="topcap"><p class="signup_txt">You're just seconds away from your Wedding Price Supplier account.</p></div>
				  <table border="0" align="left" cellpadding="0" cellspacing="0">
					<tbody><tr>
					<td valign="top">
					<p class="formspace"></p>
					<form name="form1" id='register-supplier-form' method="post" action="<?php echo URL;?>/register-supplier.php" enctype="multipart/form-data">
						  <table class="signuptable">
							<tbody><tr> 
							  <td class="signuptable_txt">Name</td>
							  <td>
								<div class="fm_input_wrapper">
									<input value="<?php if(isset($_POST['name'])) echo $_POST['name'];?>" name="name" type="text" id="name"  maxlength="255"  class="input_txt text validate[required,minSize[4],maxSize[30]]">
								</div>
							   </td>
							</tr>
							<tr class="trd"> 
							  <td class="signuptable_txt">Sales Email</td>
							  <td><div class="fm_input_wrapper"><input value="<?php if(isset($_POST['salesEmail'])) echo $_POST['salesEmail'];?>" name="salesEmail" type="text" id="email"  class="input_txt text validate[required,custom[email]]"></div></td>
							</tr>
							<tr> 
							  <td class="signuptable_txt">Phone</td>
							  <td><div class="fm_input_wrapper"><input value="<?php if(isset($_POST['phone'])) echo $_POST['phone'];?>" name="phone" type="text" id="phone" maxlength="15" class="input_txt text validate[required]"  ></div></td>
							</tr>
							<tr>  
							  <td class="signuptable_txt">Contact Person</td>
							  <td><div class="fm_input_wrapper"><input value="<?php if(isset($_POST['contactPerson'])) echo $_POST['contactPerson'];?>" name="contactPerson" type="text" id="contactPerson"  maxlength="255"   class="input_txt text validate[required,minSize[4],maxSize[30]]"></div></td>
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
							  <td class="signuptable_txt">Primary Region</td>
							  <td>
								<div class="fm_input_wrapper">
									<select name="state" type="text" class="input_txt text regions">
										<?php for($i = 0; $i<count($countryData[0]['regions']);$i++){ ?>
												<option value='<?php echo $countryData[0]['regions'][$i]['id'];?>'>
													<?php echo $countryData[0]['regions'][$i]['name'];?>											
												</option>
											<?php }
										?>
									</select>
									<input type="hidden" id="primaryRegion" name="primaryRegion" value="<?php echo $countryData[0]['regions'][0]['id'];?>"/>
								 </div>
							  </td>
							</tr>							
							<tr class="trd"> 
							  <td class="signuptable_txt">Primary Category</td>
							  <td>
								<div class="fm_input_wrapper">
									<select id="primaryCategorySelect" type="text" class="input_txt text regions">
										<?php
											require_once 'classes/database/objects/class.category.php';
											$category = new Category();
											$catList = $category->GetList();
											foreach($catList as $cat){ ?>
												<option value='<?php echo $cat->categoryId;?>'>
													<?php echo ucfirst(htmlspecialchars($cat->name, ENT_QUOTES));?>											
												</option>
										
										<?php }
										?>
									</select>
									<input type="hidden" id="primaryCategory" name="primaryCategory" value="<?php echo $catList[0]->categoryId; ?>"/>
								 </div>
							  </td>
							</tr>
							<tr class="trd"> 
							  <td class="signuptable_txt">City</td>
							  <td><div class="fm_input_wrapper"><input value="<?php if(isset($_POST['city'])) echo $_POST['city'];?>" name="city" type="text" id="city"  maxlength="255"  class="input_txt text validate[required,minSize[4],maxSize[20]]"></div></td>
							</tr>
							<tr class="trd"> 
							  <td class="signuptable_txt">Zip</td>
							  <td><div class="fm_input_wrapper"><input value="<?php if(isset($_POST['zip'])) echo $_POST['zip'];?>" name="zip" type="text" id="zip"  maxlength="255"  class="input_txt text validate[required]"></div></td>
							</tr>	
							<tr class="trd"> 
							  <td class="signuptable_txt">Address Line 1</td>
							  <td><div class="fm_input_wrapper"><input value="<?php if(isset($_POST['address'])) echo $_POST['address'];?>" name="address" type="text" id="address"  maxlength="500"  class="input_txt text validate[required,minSize[8]]"></div></td>
							</tr>
							<tr class="trd"> 
							  <td class="signuptable_txt">Address Line 2</td>
							  <td><div class="fm_input_wrapper"><input value="<?php if(isset($_POST['address2'])) echo $_POST['address2'];?>" name="address2" type="text" id="address2"  maxlength="500"  class="input_txt text"></div></td>
							</tr>
							<tr class="trd"> 
							  <td class="signuptable_txt">Non-Sales Email</td>
							  <td><div class="fm_input_wrapper"><input value="<?php if(isset($_POST['nonSalesEmail'])) echo $_POST['nonSalesEmail'];?>" name="nonSalesEmail" type="text" id="nonSalesEmail"  maxlength="255"  class="input_txt text validate[custom[email]]"></div></td>
							</tr>													
							<tr class="trd"> 
							  <td class="signuptable_txt">Picture</td>
							  <td><div class="fm_input_wrapper"><input value="<?php if(isset($_FILE['picture']['name'])) echo $_FILE['picture']['name'];?>" name="picture" type="file" id="picture" class='validate[required]'/></div></td>
							</tr>								
							<tr class="trd"> 
							  <td class="signuptable_txt">Company Profile</td>
							  <td><div class="fm_input_wrapper" style='height:115px;'><textarea style='width:295px;height:110px;' name="cprofile" id="cprofile"  maxlength="1000"  class="text validate[required,minSize[15]]"><?php if(isset($_POST['cprofile'])) echo $_POST['cprofile'];?></textarea></div></td>
							</tr>
							<tr> 
							<td class="nospacetd">&nbsp;</td>
							  <td class="nospacetd" style="margin-left:200px;width:300px;vertical-align:baseline;" ><p class="txti"><input name="recieveRequests" type="checkbox" checked></p><p class="txtp">Also Recieve Requests by Email.</p></td>
							</tr>				
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
   <script src="<?php echo URL;?>/js/jquery.validationEngine-en.min.js" type="text/javascript"></script>
   <script src="<?php echo URL;?>/js/jquery.validationEngine.min.js" type="text/javascript"></script>
   <script type="text/javascript">
		var countryJSON = $.parseJSON('<?php echo $countryRegionsJSON; ?>');	
	</script>
   <script type="text/javascript" src="<?php echo URL;?>/js/main.js"></script>
 </body>

</html>