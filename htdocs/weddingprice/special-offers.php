<?php
require_once 'config/config.php';
require_once 'includes/secureLogin.php';
require_once 'includes/securePasswordChange.php';
require_once 'includes/secureSupplier.php';

$supplierId  = $_SESSION['supplierId'];
function isValidUrl($url){
	return preg_match("/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i",$url);
}
	$error = '';
	if(isset($_POST['title'],$_POST['link'],$_POST['weeks'],$_POST['content'],$_FILES['picture'])){
		$title = htmlspecialchars(trim($_POST['title']), ENT_QUOTES);
		$content = htmlspecialchars(trim($_POST['content']), ENT_QUOTES);
		$link = trim($_POST['link']);
		$weeks = intval($_POST['weeks']);
		if($title == ''){
			$error .= '-Title can\'t be empty<br/>';
		}
		
		if($link != ''){
			if(!isvalidUrl($link))
				$error .= '-Invalid URL. Include full URL such as http://www.google.com<br/>';
		}
		if($content == '' || strlen($content) < 25){
			$error .= '-Content must at least contain 25 charachters!<br/>';
		}
		if($weeks == 0){
			$error .= '-Number of weeks can\'t be zero or empty<br/>';
		}
		if($_FILES['picture']['error'] == 0){			
			if($_FILES['picture']['size'] > 5 * 1024 * 1024){
				$error .= '-Picture size too big, maximum 5MB allowed<br/>';
			}			
			if($_FILES['picture']['type'] != "image/gif" && 
				$_FILES['picture']['type'] != "image/jpg" && 
				$_FILES['picture']['type'] != "image/jpeg" && 
				$_FILES['picture']['type'] != "image/pjpeg" && 
				$_FILES['picture']['type'] != "image/bmp" && 
				$_FILES['picture']['type'] != "image/png"
			){
				$error .= "-Only jpg, jpeg, png, gif and bmp formats of picture are allowed You uploaded: {$_FILES['picture']['type']}<br/>";
			}	
		}
		if($error == ''){
			require_once 'classes/database/objects/class.database.php';
			require_once 'classes/database/objects/class.specialoffer.php';
			$sp = new SpecialOffer();
			$sp->title = $title;
			$sp->link = $link;
			$sp->content = $content;
			$sp->days = $weeks * 7;
			$sp->status = 'INACTIVE';
			$sp->date = date('Y-m-d H:i:s', time());
			$sp->dateEnd = date('Y-m-d H:i:s', strtotime("+{$sp->days} days",time()));
			$sp->supplierId = $supplierId;
			$sp->Save();
			if($_FILES['picture']['error'] == 0){
				include_once("classes/ResizeImage.php");		
				$rimg=new ResizeImage($_FILES['picture']['tmp_name']);
				$rimg->resize(30, 30, 'img/specialoffers/' . $sp->specialofferId .  '_thumb.jpg');
				$rimg->resize_limitwh(120, 120, 'img/specialoffers/' . $sp->specialofferId . '.jpg');
				$rimg->close();					 
				copy($_FILES['picture']['tmp_name'], "img/specialoffers/". $sp->specialofferId . '_orig.jpg');
			}
			header('Location: ' . URL . '/proceed-ad-payment.php?token=' . $sp->specialofferId);
			exit();
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <title>Wedding Price | Add Special Offer</title>
				
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
                <div id="leftCol">
					<?
                    	include('includes/my-account-left-links.php');
					?>
				</div>
                <div id="rightCol">
					<h1 class="myTitle">Add a Special Offer</h1>
                    <div class="clear">
						<?php if($error != '') { ?>
						<p class='error'> 
							<?php echo $error; ?>
						</p>
						<?php  } ?>
					</div>
					<form action='<?php URL . '/special-offer.php' ?>' method='post' enctype="multipart/form-data">
			<table class='etable ztable'>
					
				<tr>
					<td style="background:none;">
						<label>
							Ad title:
						</label>
					</td>
					<td style="background:none;">
						<input name='title'   type='text' class='text' value='<?php if(isset($_POST['title'])){ echo $_POST['title'];} ?>'/>
					</td>
				</tr>
				<tr>
					<td style="background:none;">
						<label>
							Link: <span style='font-style:italic;'>(if any)</span>
						</label>
					</td>
					<td style="background:none;">
						<input name='link'   type='text' class='text' value='<?php if(isset($_POST['link'])){ echo $_POST['link'];} ?>'/>
					</td>
				</tr>
				<tr>
					<td>
						<label>
							Content:
						</label>
					</td>
					<td>
						<textarea style='width:200px;height:110px;' class='text' name='content'><?php if(isset($_POST['content'])) echo $_POST['content']; ?></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<label>
							Image: <span style='font-style:italic;'>(if any)</span>
						</label>
					</td>
					<td>
						<input name='picture' type='file' />
					</td>
				</tr>
				<tr>
					<td style="background:none;">
						<label>
							<?php require_once 'includes/function.getconfig.php'; ?>
							Weeks to display: <br/><span style='margin-left:10px;font-style:italic;'>$<?php echo getConfig('adperdaycost') * 7; ?> per week</span>
						</label>
					</td>
					<td style="background:none;">
						<input name='weeks'   type='text' class='numberOnly text' value='<?php if(isset($_POST['weeks'])){ echo $_POST['weeks'];} ?>'/>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type='submit' value='Proceed to Payment' class='btn' style='margin:0;float:none;clear:both;'/>												
					</td>
				</tr>
			</table>
		</form>
				
				<br style="clear: both;"/>
            </div>
            
                <br style="clear: both;"/>
            </div>
            </div>

        </div>
       
 <?php require 'includes/footer.php'; ?>
	<script src="<?php echo URL;?>/js/jquery.js" type="text/javascript"></script>
     <script type="text/javascript" src="<?php echo URL;?>/js/main.js"></script>
    </body>

</html>

