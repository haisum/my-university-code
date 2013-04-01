<?php
require_once 'config/config.php';
require_once 'includes/secureLogin.php';
require_once 'includes/securePasswordChange.php';
require_once 'includes/secureSupplier.php';
$supplierId = $_SESSION['supplierId'];
$supplier = require 'includes/supplierData.php';
if(isset($_FILES, $_POST['supplierId']) && is_numeric($_POST['supplierId'])){
	  if($_FILES['picture']['size'] > 2*1024*1024){
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
			include_once("classes/ResizeImage.php");		
			$rimg=new ResizeImage($_FILES['picture']['tmp_name']);
			$rimg->resize(30, 30, 'img/supplier/' . $_POST['supplierId'] . '_thumb.jpg');
			$rimg->resize_limitwh(120, 120, 'img/supplier/' . $_POST['supplierId'] . '.jpg');
			echo $rimg->error;
			$rimg->close();					
			copy($_FILES['picture']['tmp_name'], "img/supplier/". $_POST['supplierId'] . '_orig.jpg');			
		}
		else{
			echo $error;
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <title>Wedding Price</title>
		
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/token-input.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/token-input-facebook.css"/>		
        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/main.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/account.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/edit.css"/>
		
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
					<?
                    	include('includes/my-account-left-links.php');
					?>
				</div>
                <div id="rightCol">
                    <h1 class="myTitle">Account Settings</h1>
                    <div class="clear"></div>
					<div id="SettingsPage_Content">
						<ul class="uiList fbSettingsList" style="padding-left:0px;">
							<li class="fbSettingsListItem clearfix uiListItem uiListLight uiListVerticalItemBorder ">
								<a class="pvm phs fbSettingsListLink clearfix " href="javascript:;" onclick="javascript:showEdit(this, 'name');" rel="async">
									<span class="pls fbSettingsListItemLabel"><strong>Display Name</strong></span>
									<span style="padding-left: 23px;" class="uiIconText fbSettingsListItemEdit">
										<i class="img sp_3ihw8b sx_e26dca" style="top: -2px;"></i>Edit
									</span>
									<span class="fbSettingsListItemSaved hidden_elem"></span>
									<span class="fbSettingsListItemContent fcg"><strong id="nameText"><?php echo $supplier['name'];?></strong></span>
								</a>
								<div class="fbcontent">
									<div class="fbSettingsEditor uiBoxGray noborder">
										<form rel="async" class="show_label" action="javascript:;" onsubmit="saveEdit(this , 'name');" method="post">
											<div class="mam fbSettingsEditorLabel">
												<strong>Display Name</strong>
											</div>
											<div class="pbm fbSettingsEditorFields">
												<div class="ptm">
													<label> 
														<input type="text" class="inputtext" id="name" name="displayName" >							
													</label>
													<div class="mts uiP fsm fcg">
														Your name as displayed accross the site.
													</div>
												</div>
												<div class="mtm uiBoxGray topborder">
													<div class="mtm">
														<label class="submit uiButton uiButtonConfirm">
														<input value="Save Changes" type="submit" style="color:#fff;">
														</label>
														<label class="cancel uiButton" for="u804705_4"><input value="Cancel" onclick="cancelEdit(this);" type="button" id="u804705_4"></label>
														<img class="fbLoading" style="visibility:hidden;" src="img/fbLoading.gif" alt="" width="16" height="11"/>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</li>
							
							<!-- PROFILE PIC -->
							<li class="fbSettingsListItem clearfix uiListItem uiListLight uiListVerticalItemBorder ">
								<a class="pvm phs fbSettingsListLink clearfix " href="javascript:void(0);" onclick="javascript:showEdit(this, 'name');" rel="async">
									<span class="pls fbSettingsListItemLabel"><strong>Profile Picture</strong></span>
									<span style="padding-left: 23px;" class="uiIconText fbSettingsListItemEdit">
										<i class="img sp_3ihw8b sx_e26dca" style="top: -2px;"></i>Edit
									</span>
									<span class="fbSettingsListItemSaved hidden_elem"></span>
									<span class="fbSettingsListItemContent fcg"><img src='<?php echo URL . '/img/supplier/' . $supplier['supplierId'] . '_thumb.jpg?' . rand();?>' alt='profile picture' id='profilePic<?php echo $supplier['supplierId'];?>'/></span>
								</a>
								<div class="fbcontent">
									<div class="fbSettingsEditor uiBoxGray noborder">
										<form class="show_label" action="<?php echo URL;?>/supplier-account.php" method="post" enctype="multipart/form-data">
											<div class="mam fbSettingsEditorLabel">
												<strong>Profile Picture</strong>
											</div>
											<div class="pbm fbSettingsEditorFields">
												<div class="ptm">
													<label> 
														<img src='<?php echo URL . '/img/supplier/' . $supplier['supplierId'] . '.jpg?' . rand();?>' alt='profile picture' />
														<input type='file' name='picture' />
														<input type='hidden' value='<?php echo $supplier['supplierId'];?>' name='supplierId'/>
													</label>
													<div class="mts uiP fsm fcg">
														Your Profile Picture
													</div>
												</div>
												<div class="mtm uiBoxGray topborder">
													<div class="mtm">
														<label class="submit uiButton uiButtonConfirm">
														<input value="Save Changes" type="submit" style="color:#fff;">
														</label>
														<label class="cancel uiButton" for="u804705_4"><input value="Cancel" onclick="cancelEdit(this);" type="button" id="u804705_4"/></label>
														<img class="fbLoading" style="visibility:hidden;" src="img/fbLoading.gif" alt="" width="16" height="11"/>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</li>
							<!-- PROFILE PIC -->
							<!-- Company Profile -->
							<li class="fbSettingsListItem clearfix uiListItem uiListLight uiListVerticalItemBorder ">
								<a class="pvm phs fbSettingsListLink clearfix " href="javascript:void(0);" onclick="javascript:showEdit(this, 'companyProfile');" rel="async">
									<span class="pls fbSettingsListItemLabel"><strong>Company Profile</strong></span>
									<span style="padding-left: 23px;" class="uiIconText fbSettingsListItemEdit">
										<i class="img sp_3ihw8b sx_e26dca" style="top: -2px;"></i>Edit
									</span>
									<span class="fbSettingsListItemSaved hidden_elem"></span>
									<span id='companyProfileText' class="fbSettingsListItemContent fcg"><?php echo $supplier['companyProfile'] ;?></span>
								</a>
								<div class="fbcontent">
									<div class="fbSettingsEditor uiBoxGray noborder">
										<form class="show_label" action="javascript:;" onsubmit="saveEdit(this , 'companyProfile');" method="post">
											<div class="mam fbSettingsEditorLabel">
												<strong>Company Profile</strong>
											</div>
											<div class="pbm fbSettingsEditorFields">
												<div class="ptm">
													<label> 
														<textarea style='width:210px;height:110px;' class="text inputtext" id="companyProfile" name="companyProfile" ><?php echo $supplier['companyProfile']; ?></textarea>							
													</label>
													<div class="mts uiP fsm fcg">
														About your company
													</div>
												</div>
												<div class="mtm uiBoxGray topborder">
													<div class="mtm">
														<label class="submit uiButton uiButtonConfirm">
														<input value="Save Changes" type="submit" style="color:#fff;">
														</label>
														<label class="cancel uiButton" for="u804705_4"><input value="Cancel" onclick="cancelEdit(this);" type="button" id="u804705_4"/></label>
														<img class="fbLoading" style="visibility:hidden;" src="img/fbLoading.gif" alt="" width="16" height="11"/>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</li>
							<!-- Company Profiel -->
							
							<li class="fbSettingsListItem clearfix uiListItem uiListLight uiListVerticalItemBorder ">
								<a class="pvm phs fbSettingsListLink clearfix " href="javascript:;" onclick="javascript:showEdit(this, 'emails');" rel="async">
									<span class="pls fbSettingsListItemLabel"><strong>Emails</strong></span>
									<span style="padding-left: 23px;" class="uiIconText fbSettingsListItemEdit">
										<i class="img sp_3ihw8b sx_e26dca" style="top: -2px;"></i>Edit
									</span>
									<span class="fbSettingsListItemSaved hidden_elem"></span>
									<span class="fbSettingsListItemContent fcg">
										<strong id="emailText">
											<?php echo $supplier['salesEmail']; if($supplier['nonSalesEmail']!='') echo ', ' . $supplier['nonSalesEmail'];?>
										</strong>
									</span>
								</a>
								<div class="fbcontent showContent">
									<div class="fbSettingsEditor uiBoxGray noborder">
										<form rel="async" class="show_label" action="javascript:;" onsubmit="saveEdit(this, 'emails');" method="post">
											<div class="mam fbSettingsEditorLabel">
												<strong>Emails</strong>
											</div>
											<div class="pbm fbSettingsEditorFields">
												<div class="ptm">
													<table style="border:0px;" border="0">
														<tr>
															<td>Sales Email</td>
															<td>
																<input type="text" class="inputtext"  id="salesEmail" name="salesEmail" />
															</td>
														</tr>
														<tr>
															<td>Non-Sales Email</td>
															<td>
																<input type="text" class="inputtext" id="nonSalesEmail" name="nonSalesEmail"/>
															</td>
														</tr>
													</table>													
												</div>
												<div class="mtm uiBoxGray topborder">
													<div class="mtm">
														<label class="submit uiButton uiButtonConfirm">
														<input value="Save Changes" type="submit" style="color:#fff;">
														</label>
														<label class="cancel uiButton" for="u804705_4"><input value="Cancel" onclick="cancelEdit(this);" type="button" id="u804705_4"></label>
														<img class="fbLoading" style="visibility:hidden;" src="img/fbLoading.gif" alt="" width="16" height="11"/>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</li>
							<li class="fbSettingsListItem clearfix uiListItem uiListLight uiListVerticalItemBorder ">
								<a class="pvm phs fbSettingsListLink clearfix " href="javascript:;" onclick="javascript:showEdit(this, 'phone');" rel="async">
									<span class="pls fbSettingsListItemLabel"><strong>Phone</strong></span>
									<span style="padding-left: 23px;" class="uiIconText fbSettingsListItemEdit">
										<i class="img sp_3ihw8b sx_e26dca" style="top: -2px;"></i>Edit
									</span>
									<span class="fbSettingsListItemSaved hidden_elem"></span>
									<span class="fbSettingsListItemContent fcg"><strong id="phoneText"><?php echo $supplier['phone'];?></strong></span>
								</a>
								<div class="fbcontent">
									<div class="fbSettingsEditor uiBoxGray noborder">
										<form rel="async" class="show_label" action="javascript:;" onsubmit="saveEdit(this, 'phone');" method="post">
											<div class="mam fbSettingsEditorLabel">
												<strong>Phone</strong>
											</div>
											<div class="pbm fbSettingsEditorFields">
												<div class="ptm">
													<label> 
														<input type="text" class="inputtext" name="phone" id="phone"/>
													</label>
													<div class="mts uiP fsm fcg">
														Phone Number used to contact you.
													</div>
												</div>
												<div class="mtm uiBoxGray topborder">
													<div class="mtm">
														<label class="submit uiButton uiButtonConfirm">
															<input value="Save Changes" type="submit" style="color:#fff;">
														</label>
														<label class="cancel uiButton">
															<input value="Cancel" onclick="cancelEdit(this);" type="button" >
														</label>
														<img class="fbLoading" style="visibility:hidden;" src="img/fbLoading.gif" alt="" width="16" height="11"/>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</li>
							<li class="fbSettingsListItem clearfix uiListItem uiListLight uiListVerticalItemBorder ">
								<a class="pvm phs fbSettingsListLink clearfix " href="javascript:;" onclick="javascript:showEdit(this, 'contactPerson');" rel="async">
									<span class="pls fbSettingsListItemLabel"><strong>Contact Person</strong></span>
									<span style="padding-left: 23px;" class="uiIconText fbSettingsListItemEdit">
										<i class="img sp_3ihw8b sx_e26dca" style="top: -2px;"></i>Edit
									</span>
									<span class="fbSettingsListItemSaved hidden_elem"></span>
									<span class="fbSettingsListItemContent fcg"><strong id="contactPersonText"><?php echo $supplier['contactPerson'];?></strong></span>
								</a>
								<div class="fbcontent">
									<div class="fbSettingsEditor uiBoxGray noborder">
										<form rel="async" class="show_label" action="javascript:;" onsubmit="saveEdit(this, 'contactPerson');" method="post">
											<div class="mam fbSettingsEditorLabel">
												<strong>Contact Person</strong>
											</div>
											<div class="pbm fbSettingsEditorFields">
												<div class="ptm">
													<label>
														<input type="text" class="inputtext"  name="contactPerson" id="contactPerson" />	
													</label>
													<div class="mts uiP fsm fcg">
														Name of person to contact (You may also specify your own name)
													</div>
												</div>
												<div class="mtm uiBoxGray topborder">
													<div class="mtm">
														<label class="submit uiButton uiButtonConfirm">
														<input value="Save Changes" type="submit" style="color:#fff;">
														</label>
														<label class="cancel uiButton" >
															<input value="Cancel" onclick="cancelEdit(this);" type="button">
														</label>
														<img class="fbLoading" style="visibility:hidden;" src="img/fbLoading.gif" alt="" width="16" height="11"/>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</li>
							<!--Primary Category-->
							<li class="fbSettingsListItem clearfix uiListItem uiListLight uiListVerticalItemBorder ">
								<a class="pvm phs fbSettingsListLink clearfix " href="javascript:;" rel="async">
									<span class="pls fbSettingsListItemLabel"><strong>Primary Category</strong></span>
									<span style="padding-left: 23px;" class="uiIconText fbSettingsListItemEdit">
										<i class="img sp_3ihw8b sx_e26dca" style="top: -2px;"></i>										
									</span>
									<span class="fbSettingsListItemSaved hidden_elem phiddenCb"></span>
									<span class="fbSettingsListItemContent fcg">
										<select onchange='setPrimaryCategory();' id='primcat'>
											<?php
												require_once 'classes/database/objects/class.category.php';
												$cat = new Category();
												$categoryList = $cat->GetList(array(), 'name');
												foreach($categoryList as $item){
													$selected = '';
													if($item->categoryId == $supplier['primaryCategoryId']){
														$selected = 'selected';
													}
											?>
												<option value='<?php echo $item->categoryId;?>' <?php echo $selected;?>><?php echo ucfirst($item->name);?></option>
											<?php } ?>
											
										</select>	
									</span>
								</a>
								<div class="fbcontent">									
								</div>
							</li>
							<!--Primary Category-->
							<li class="fbSettingsListItem clearfix uiListItem uiListLight uiListVerticalItemBorder ">
								<a class="pvm phs fbSettingsListLink clearfix " href="javascript:;" onclick="javascript:showEdit(this, 'categories');" rel="async">
									<span class="pls fbSettingsListItemLabel"><strong>Other Categories</strong></span>
									<span style="padding-left: 23px;" class="uiIconText fbSettingsListItemEdit">
										<i class="img sp_3ihw8b sx_e26dca" style="top: -2px;"></i>Edit
									</span>
									<span class="fbSettingsListItemSaved hidden_elem"></span>
									<span class="fbSettingsListItemContent fcg">
										<strong id="categoryText">
											<?php
												echo $supplier['categoryText'];
											?>
										</strong>
									</span>
								</a>
								<div class="fbcontent">
									<div class="fbSettingsEditor uiBoxGray noborder">
										<form rel="async" class="show_label" action="javascript:;" onsubmit="saveEdit(this, 'categories');" method="post">
											<div class="mam fbSettingsEditorLabel">
												<strong>Categories</strong>
											</div>
											<div class="pbm fbSettingsEditorFields">
												<div class="ptm">
													<label> 
														<select multiple="true" id="categories">
														</select>
													</label>
													<div class="mts uiP fsm fcg">
														Hold CTRL/COMMAND to select multiple values
													</div>
												</div>
												<div class="mtm uiBoxGray topborder">
													<div class="mtm">
														<label class="submit uiButton uiButtonConfirm" id="u804705_2" for="u804705_3">
														<input value="Save Changes" type="submit" style="color:#fff;">
														</label>
														<label class="cancel uiButton" for="u804705_4"><input value="Cancel" onclick="cancelEdit(this);" type="button" id="u804705_4"></label>
														<img class="fbLoading" style="visibility:hidden;" src="img/fbLoading.gif" alt="" width="16" height="11"/>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</li>							
							<li class="fbSettingsListItem clearfix uiListItem uiListLight uiListVerticalItemBorder ">
								<a class="pvm phs fbSettingsListLink clearfix " href="javascript:;" onclick="javascript:showEdit(this, 'regions');" rel="async">
									<span class="pls fbSettingsListItemLabel"><strong>Regions</strong></span>
									<span style="padding-left: 23px;" class="uiIconText fbSettingsListItemEdit">
										<i class="img sp_3ihw8b sx_e26dca" style="top: -2px;"></i>Edit
									</span>
									<span class="fbSettingsListItemSaved hidden_elem"></span>
									<span class="fbSettingsListItemContent fcg">
										<strong id="regionText">
											<?php
												echo $supplier['regionText'];
											?>
										</strong>
									</span>
								</a>
								<div class="fbcontent">
									<div class="fbSettingsEditor uiBoxGray noborder">
										<form rel="async" class="show_label" action="javascript:;" onsubmit="saveEdit(this, 'regions');" method="post">
											<div class="mam fbSettingsEditorLabel">
												<strong>Regions</strong>
											</div>
											<div class="pbm fbSettingsEditorFields">
												<div class="ptm">
													<label> 
														<select multiple="true" id="regions">
														</select>
													</label>
													<div class="mts uiP fsm fcg">
														Hold CTRL/COMMAND to select multiple values
													</div>
												</div>
												<div class="mtm uiBoxGray topborder">
													<div class="mtm">
														<label class="submit uiButton uiButtonConfirm" id="u804705_2" for="u804705_3">
														<input value="Save Changes" type="submit" style="color:#fff;">
														</label>
														<label class="cancel uiButton" for="u804705_4"><input value="Cancel" onclick="cancelEdit(this);" type="button" id="u804705_4"></label>
														<img class="fbLoading" style="visibility:hidden;" src="img/fbLoading.gif" alt="" width="16" height="11"/>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</li>
							<li class="fbSettingsListItem clearfix uiListItem uiListLight uiListVerticalItemBorder ">
								<a class="pvm phs fbSettingsListLink clearfix " href="javascript:;" onclick="javascript:showEdit(this, 'address');" rel="async">
									<span class="pls fbSettingsListItemLabel"><strong>Address</strong></span>
									<span style="padding-left: 23px;" class="uiIconText fbSettingsListItemEdit">
										<i class="img sp_3ihw8b sx_e26dca" style="top: -2px;"></i>Edit
									</span>
									<span class="fbSettingsListItemSaved hidden_elem"></span>
									<span class="fbSettingsListItemContent fcg">
										<strong id="addressText">
											<?php $addressText = $supplier['address'] . ', ' . $supplier['city'] . ', ' . $supplier['primaryRegion'] . ', ' . $supplier['countryName'] .  ', ' . $supplier['zip'];
													preg_replace(' *, *, *', ', ', $addressText);
													echo $addressText;
											?>
										</strong>
									</span>
								</a>
								<div class="fbcontent">
									<div class="fbSettingsEditor uiBoxGray noborder">
										<form rel="async" id="addressForm" class="show_label" action="javascript:;" onsubmit="saveEdit(this, 'address');" method="post">
											<div class="mam fbSettingsEditorLabel">
												<strong>Address</strong>
											</div>
											<div class="pbm fbSettingsEditorFields">
												<div class="ptm">
													<table style="border:0px;" border="0">
														<tr>
															<td>Country</td>
															<td>
																<i id="countryName"><?php echo $supplier['countryName'];?></i>
															</td>
														</tr>
														<tr>														
															<td>Primary Region</td>
															<td>
																<select style="width:155px;padding: 1px;" id="primaryRegion">
																</select>
															</td>
														</tr>
														<tr>
															<td>City</td>
															<td><input type="text" class="inputtext" data-validate="validate(required,minlength(4))" name="city" id="city" ></td>
														</tr>
														<tr>
															<td>Address Line 1</td>
															<td><input type="text" class="inputtext" data-validate="validate(required,minlength(6))" name="address" id="address" ></td>
														</tr>
														<tr>
															<td>Address Line 2</td>
															<td><input type="text" class="inputtext" name="address2" id="address2" >	</td>
														</tr>
														<tr>
															<td>Zip</td>
															<td><input type="text" class="inputtext" name="zip" id="zip" ></td>
														</tr>
													</table>
												</div>												
												<div class="mtm uiBoxGray topborder">
													<div class="mtm">
														<label class="submit uiButton uiButtonConfirm" id="u804705_2" for="u804705_3">
														<input value="Save Changes" type="submit" style="color:#fff;">
														</label>
														<label class="cancel uiButton" for="u804705_4"><input value="Cancel" onclick="cancelEdit(this);" type="button" id="u804705_4"></label>
														<img class="fbLoading" style="visibility:hidden;" src="img/fbLoading.gif" alt="" width="16" height="11"/>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</li>
							<li class="fbSettingsListItem clearfix uiListItem uiListLight uiListVerticalItemBorder ">
								<a class="pvm phs fbSettingsListLink clearfix " href="javascript:;" onclick="javascript:showEdit(this, 'website');">
									<span class="pls fbSettingsListItemLabel"><strong>Website Information</strong></span>
									<span style="padding-left: 23px;" class="uiIconText fbSettingsListItemEdit">
										<i class="img sp_3ihw8b sx_e26dca" style="top: -2px;"></i>Edit
									</span>
									<span class="fbSettingsListItemSaved hidden_elem"></span>
									<span class="fbSettingsListItemContent fcg">
										<strong id="websiteText">
											<?php
												echo $supplier['website']['text'];
											?>
										</strong>
									</span>
								</a>
								<div class="fbcontent">
									<div class="fbSettingsEditor uiBoxGray noborder">
										<form rel="async" class="show_label" action="javascript:;" onsubmit="saveEdit(this, 'website');" method="post">
											<div class="mam fbSettingsEditorLabel">
												<strong>Website Information</strong>
											</div>
											<div class="pbm fbSettingsEditorFields">
												<div class="ptm">
													<table style="border:0px;" border="0">
														<tr>
															<td>Website Name</td>
															<td>
																<input class="inputtext" id="websiteName" />
															</td>
														</tr>
														<tr>
															<td>URL</td>
															<td>
																<input class="inputtext"  id="websiteUrl"/>
															</td>
														</tr>
													</table>
												</div>												
												<div class="mtm uiBoxGray topborder">
													<div class="mtm">
														<label class="submit uiButton uiButtonConfirm" id="u804705_2" for="u804705_3">
														<input value="Save Changes" type="submit" style="color:#fff;">
														</label>
														<label class="cancel uiButton" for="u804705_4"><input value="Cancel" onclick="cancelEdit(this);" type="button" id="u804705_4"></label>
														<img class="fbLoading" style="visibility:hidden;" src="img/fbLoading.gif" alt="" width="16" height="11"/>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</li>							
							<li class="fbSettingsListItem clearfix uiListItem uiListLight uiListVerticalItemBorder ">
								<a class="pvm phs fbSettingsListLink clearfix " href="javascript:;" onclick="javascript:showEdit(this, 'password');" rel="async"><span class="pls fbSettingsListItemLabel"><strong>Password</strong></span>
								<span style="padding-left: 23px;" class="uiIconText fbSettingsListItemEdit">
								<i class="img sp_3ihw8b sx_e26dca" style="top: -2px;"></i>Edit </span>
								<span class="fbSettingsListItemSaved hidden_elem"></span>
								<span class="fbSettingsListItemContent fcg"><strong>&#42;&#42;&#42;&#42;&#42;</strong></span>
								</a>
								<div class="fbcontent">
									<div class="fbSettingsEditor uiBoxGray noborder">
										<form rel="async" id="passwordForm" class="show_label" action="javascript:;" onsubmit="saveEdit(this, 'password');" method="post">
											<div class="mam fbSettingsEditorLabel">
												<strong>Password</strong>
											</div>
											<div class="pbm fbSettingsEditorFields">
												<div class="ptm">
													<table style="border:0px;" border="0">
														<tr>
															<td>
																Current Password
															</td>
															<td>
																<input type="password" class="inputtext" name="currentPassword" id="currentPassword"/>
															</td>
														</tr>
														<tr>
															<td>
																New Password
															</td>
															<td>
																<input type="password" class="inputtext" name="newPassword" id="newPassword"/>
															</td>
														</tr>
														<tr>
															<td>
																Confirm Password
															</td>
															<td>
																<input type="password" class="inputtext" name="confirmPassword" id="confirmPassword">
															</td>
														</tr>
													</table>
												</div>
												<div class="mtm uiBoxGray topborder">
													<div class="mtm">
														<label class="submit uiButton uiButtonConfirm" id="u804705_2" for="u804705_3"><input value="Save Changes" type="submit" style="color:#fff;"></label><label class="cancel uiButton" for="u804705_4"><input value="Cancel" onclick="cancelEdit(this);" type="button" id="u804705_4"></label><img class="fbLoading" style="visibility:hidden;" src="img/fbLoading.gif" alt="" width="16" height="11"/>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</li>
							<li class="fbSettingsListItem clearfix uiListItem uiListLight uiListVerticalItemBorder ">
								<a class="pvm phs fbSettingsListLink clearfix " href="javascript:;" rel="async">
									<span class="pls fbSettingsListItemLabel"><strong>Recieve Automated Emails</strong></span>
									<span style="padding-left: 23px;" class="uiIconText fbSettingsListItemEdit">
										<i class="img sp_3ihw8b sx_e26dca" style="top: -2px;"></i>										
									</span>
									<span class="fbSettingsListItemSaved hidden_elem hiddenCb"></span>
									<span class="fbSettingsListItemContent fcg">
										<input type="checkbox" style="margin:0px;" onchange='setRequest(this);' <?php echo $supplier['doRecieveReqs']['check'];?> />
										&nbsp;
										<strong id="doRecieveReqsText">
											YES
										</strong>										
									</span>
								</a>
								<div class="fbcontent">									
								</div>
							</li>
							<li class="fbSettingsListItem clearfix uiListItem uiListLight uiListVerticalItemBorder ">
								<a class="pvm phs fbSettingsListLink clearfix " href="javascript:;" rel="async">
									<span class="pls fbSettingsListItemLabel"><strong>Account Type</strong></span>
									<span style="padding-left: 23px;" class="uiIconText fbSettingsListItemEdit">
										<i class="img sp_3ihw8b sx_e26dca" style="top: -2px;"></i>										
									</span>
									<span class="fbSettingsListItemSaved hidden_elem"></span>									
									<span class="fbSettingsListItemContent fcg"><strong>
									<?php 
										switch($supplier['accountType']){
											case 'GOLD' :
												echo 'Gold';
												break;
											default:
												echo 'Free';
												break;
										} 
									?>										
									</strong></span>
								</a>
								<div class="fbcontent">									
								</div>
							</li>
							<li class="fbSettingsListItem clearfix uiListItem uiListLight uiListVerticalItemBorder ">
								<a class="pvm phs fbSettingsListLink clearfix " href="javascript:;" rel="async">
									<span class="pls fbSettingsListItemLabel"><strong>Account Status</strong></span>
									<span style="padding-left: 23px;" class="uiIconText fbSettingsListItemEdit">
										<i class="img sp_3ihw8b sx_e26dca" style="top: -2px;"></i>										
									</span>
									<span class="fbSettingsListItemSaved hidden_elem"></span>									
									<span class="fbSettingsListItemContent fcg"><strong><?php
										switch($supplier['accountType']){
											case 'GOLD' :
												echo 'Gold membership expires on ' . date('d-m-Y' ,strtotime($supplier['expireDate']));
												break;
											case 'FREE':
												require_once 'includes/function.getconfig.php';
												mysql_connect(HOST, USER, PASSWORD);
												mysql_select_db(DBNAME);
												$result = mysql_query('SELECT count(*) as count from bid where supplierid=' . $supplierId);
												$row = mysql_fetch_array($result);
												$count = $row[0];
												$peruserbids = getConfig('freebidsperuser');
												$remaining = $peruserbids - $count;
												echo "You have done $count free bids. You can bid for $remaining more times. After that you must upgrade your account to Gold membership to continue bidding.";												
												break;
											case 'INVALIDURL':
												echo 'URL you have provided of backlinking website doesn\'t seem to contain URL to wedding price. You can\'t bid until you give correct URL';
												break;
											case 'OUTOFFREEBIDS':
												echo 'You have run out of free bids. You must upgrade your account to Gold membership to continue bidding.';
												break;
											default:
												echo $supplier['accountType'];												
												break;
										}
									?></strong></span>
								</a>
								<div class="fbcontent">									
								</div>
							</li>							
						</ul>	
					</div>
                </div><!-- rightCol -->
                <br style="clear: both;"/>
            </div>
            </div>

        </div>
       
 <?php require 'includes/footer.php'; ?>
	<script src="<?php echo URL;?>/js/jquery.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo URL;?>/js/jquery.tokeninput.js"></script>
	<script type="text/javascript">
		supplier = <?php echo json_encode($supplier);?>;
	</script>	
     <script type="text/javascript" src="<?php echo URL;?>/js/main.js"></script>
	 <script type="text/javascript" src="<?php echo URL;?>/js/supplierAccount.js"></script>
    </body>

</html>

