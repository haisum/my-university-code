<?php
require_once 'config/config.php';
require_once 'includes/secureLogin.php';
require_once 'includes/securePasswordChange.php';
require_once 'includes/secureSupplier.php';
require_once 'classes/database/objects/class.database.php';
require_once 'classes/database/objects/class.buyer.php';
require_once 'classes/database/objects/class.region.php';
require_once 'classes/Cipher.php';
$cipher = new Cipher('lifebuoy');

require 'includes/weddingDataRequired.php';
$supplierId = $_SESSION['supplierId'];

if(isset($_GET['category'])){
	$categoryId = intval($_GET['category']);
}
if(isset($_GET['region'])){
	$regionId = intval($_GET['region']);
}
$query = 'SELECT category.`name` AS catname, weddingcategory.categoryid, region.`name` AS regname, wedding.regionid, wedding.title, weddingcategory.weddingid, weddingcategory.posteddate, weddingcategory.biddeadline, weddingcategory.weddingcategoryid, weddingcategory.budgetto, weddingcategory.budgetfrom, weddingcategory.detail FROM weddingcategory, wedding, region, category WHERE category.categoryid = weddingcategory.categoryid AND wedding.weddingid = weddingcategory.weddingid AND region.regionid = wedding.regionid AND wedding.weddingdate >= NOW() AND weddingcategory.biddeadline >= NOW()';
$where = '';
if(is_numeric($categoryId) && is_numeric($regionId)){
	$where = ' AND weddingcategory.categoryid= ' . $categoryId . ' AND ' . ' weddingcategory.regionid= ' . $regionId  ; 
}
else if(!is_numeric($categoryId)  && is_numeric($regionId)){
	$where = ' AND weddingcategory.regionid= ' . $regionId; 
}
else if(!is_numeric($regionId) && is_numeric($categoryId)  ) {
	$where = ' AND weddingcategory.categoryid= ' . $categoryId; 
}
$query .= $where;
mysql_connect(HOST, USER, PASSWORD);
mysql_select_db(DBNAME);
$result = mysql_query($query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Wedding Price Current Requests</title>
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
               <!-- <div class="rgt c9d-srhf" id="search-bar">
                    <form action="javascript:;" method="post">
                        <div class="form-container">
                            <div id="search_click"><button class="lft" id="search_button" name="search" type="submit"></button></div>
                            <input type="text" id="searchbox" name="query" value="Search Keywords" class="sipt" onblur="javascript: if(this.value=='') { this.value='Search Keywords';}" onfocus="javascript: if(this.value=='Search Keywords'){this.value='';}"/>
                        </div>
                    </form>
                </div>-->
                <div id="navbar">
                   <?
                    	include('includes/main-navigation.php');
					?>
				</div>
            </div>
        </div>
        <div id="background">
            <div class="wrapper">
                <div class="content" style="background-image:none;">
                
				<div id="rightCol" style="float:none; width:920px; margin:0px auto;">
					<h1 style='width:300px;float:left;' class="myTitle">Currently Active Requests</h1>
					<?php if(isset($_SESSION['supplierId'])) { ?>					
					<div class='sortLinks'>
						<span style="color: #55B4FD;font-size:14px;">Filter by your&nbsp;</span>
							<label for='sortRegion'>Regions</label>		
							<select id='sortRegion' class='select' onchange='filter();'>
								<option value='0'>All</option>
								<?php
									$query = "SELECT * FROM region where regionid IN 
									( SELECT regionid from regionsuppliermap where supplierid=$supplierId ) OR regionid = 
									( SELECT primaryregionid from supplier where supplierid = $supplierId ) ";
									$regions = mysql_query($query);
									while($row = mysql_fetch_array($regions)){
								?>
								<option value='<?php echo $row['regionid'];?>' <?php if(isset($_GET['region']) && $_GET['region'] == $row['regionid']) echo ' selected ';?> >
									<?php echo ucwords($row['name']); ?>
								</option>
								
								<?php
								 }
								?>
							 </select>
							 <label for='sortCat'>Categories</label>		
							<select id='sortCat' onchange='filter();'>
								<option value='0'>All</option>
								<?php
									$query = "SELECT * FROM category where categoryid IN 
									( SELECT categoryid from categorysuppliermap where supplierid=$supplierId ) OR categoryid = 
									( SELECT primarycategoryid from supplier where supplierid = $supplierId ) ";
									$categorys = mysql_query($query);
									while($row = mysql_fetch_array($categorys)){
								?>
								<option value='<?php echo $row['categoryid'];  ?>' <?php if(isset($_GET['category']) && $_GET['category'] == $row['categoryid']) echo ' selected '; ?> >
									<?php echo ucwords($row['name']); ?>
								</option>
								
								<?php
								 }
								?>
							 </select>
					</div>
					<?php } ?>
					<div class="clear"></div>
					<div>
					
					</div>
					<div id="SettingsPage_Content">										
						<table class='wtable' border='0' style='width:920px;'>							
							<thead>								
								<tr>
									<th style='width:40px;'>										
									</th>
									<th style='width:65px;'>
										Request
									</th>
									<th style='width:100px;'>
										Region
									</th>
									<th style='width:100px;'>
										Bride & Groom
									</th>
									<th style='width:100px;'>
										Wedding Date
									</th>
									<th style='width:100px;'>										
										Response Deadline
									</th>
									<th style='width:80px;'>
										Budget
									</th>									
									<th style='width:150px;'>
										Detail
									</th>
									<th style='width:35px;'></th>
								</tr>
							</thead>
							<tbody>
                            							
							<?php 
								if(mysql_num_rows($result) == 0){
							?>
                            	<tr>
                                	<td colspan="9">
                                		<div class="signup_txt weddingNotice" style='width:95%;'>
											<?php if(isset($_SESSION['supplierId'])) { ?>
												No requests match your filter criteria! To change your preferred regions and categories visit your <a href='<?php echo URL;?>/account.php'>account settings</a> page.
											<?php } else{ ?>
												There are no requests currently active!
											<?php } ?>
										</div>
                                	</td>
                                </tr>
                            <?php		
								}
								else{
								while($row = mysql_fetch_array($result)){
									$id = $row['weddingcategoryid'];
							?>
								<tr>									
									<td >
									<div>
										<?php $file = file_exists('img/weddingcats/' . $id . '_thumb.jpg')?$id:'-1';
										?>
										
										<img src='<?php echo URL;?>/img/weddingcats/<?php echo $file;?>_thumb.jpg' alt='image'/>
									</td>									
									<td>
										<?php echo $row['catname'];  ?>
									</td>
									<td>
										<?php echo $row['regname']; ?>
									</td>
									<td>
										<?php echo str_replace('(#)' , '&amp;',  $row['title']);?>
									</td>
									<td>
										<?php echo date('d-m-Y' , strtotime($row['posteddate'])); ?>
									</td>
									<td>
										<?php echo date('d-m-Y' , strtotime($row['biddeadline'])); ?>
									</td>
									<td>
										<?php 
											echo $row['budgetfrom'] . ' to ' . $row['budgetto'];
										?>
									</td>
									<td>
										<?php echo $row['detail']; ?>
									</td>
									<td>
										<a class='bidLink' href="<?php echo URL . '/bid-wedding.php?token=' . urlencode($cipher->encrypt($row['weddingcategoryid']));?>">
											<?php if(isset($_SESSION['supplierId'])){
												echo "Bid";
											}
											else{
												echo "Details";
											}
											?>
										</a>
									</td>
									
								</tr>
							<?php } 
								}
							?>
							</tbody>
						</table>	
					</div>
                </div><!-- rightCol -->
                <br style="clear: both;"/>
            </div>
            </div>
        </div>
		 <?php require 'includes/footer.php'; ?>
		<script src="<?php echo URL;?>/js/jquery.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo URL;?>/js/jquery-ui-1.8.15.custom.min.js"></script>	
		<script type="text/javascript" src="<?php echo URL;?>/js/main.js"></script>	
		<script type="text/javascript" src="<?php echo URL;?>/js/listWeddings.js"></script>
	</body>
</html>