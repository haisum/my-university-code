<?
//print_r($_REQUEST);die();

include("includes/session.php");// database connection details stored here
include("includes/secure.php");
include("lefke/cleanGetPost.php");
include("includes/functions.php");
$filename2 = str_replace(".php","",basename($_SERVER['SCRIPT_FILENAME']));
$isEdit = false;
$row = array();
if(isset($_REQUEST['weddingcategoryid'])){
	$weddingcategoryid = intval($_REQUEST['weddingcategoryid']);
	$query = mysql_query("SELECT weddingcategory.* from weddingcategory where weddingcategoryid=$weddingcategoryid");
	$row = mysql_fetch_array($query);
	$isEdit = true; //if we need to pull the value in textbox or not
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
 
<!-- Website Title --> 
<title>HERTZ WEB ADMIN</title>

<!-- Meta data for SEO -->
<meta name="description" content=""/>
<meta name="keywords" content=""/>

<!-- Template stylesheet -->
<link rel="stylesheet" href="css/screen.css" type="text/css" media="all"/>
<link href="css/datepicker.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" href="css/tipsy.css" type="text/css" media="all"/>
<link rel="stylesheet" href="js/jwysiwyg/jquery.wysiwyg.css" type="text/css" media="all"/>
<link href="js/visualize/visualize.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.0.css" media="screen"/>
<style>
div.growlUI { margin-top:100px; background: url(images/check48.png) no-repeat 10px 10px }
div.growlUI h1, div.growlUI h2 {
	
	color: white; padding: 5px 5px 5px 75px; text-align: left
}
	
	</style>
<!--[if IE 7]>
	<link href="css/ie7.css" rel="stylesheet" type="text/css" media="all">
<![endif]-->

<!--[if IE]>
	<script type="text/javascript" src="js/excanvas.js"></script>
<![endif]-->

<!-- Jquery and plugins -->
<script type="text/javascript" src="js/validation.js"></script>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.img.preload.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.0.js"></script>
<script type="text/javascript" src="js/jwysiwyg/jquery.wysiwyg.js"></script>

<script type="text/javascript" src="js/hint.js"></script>
<script type="text/javascript" src="js/visualize/jquery.visualize.js"></script>
<script type="text/javascript" src="js/jquery.tipsy.js"></script>
<script type="text/javascript" src="js/browser.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/jblockui.js"></script>
<script>
$(document).ready(function() {
     //  $.growlUI('Growl Notification', 'Have a nice day!');
	$('#edit_email_template').click(function() 
	{
		var error = 0;
		

		if(document.getElementById("category").value == "")
		{
			error = error+1;
		}		

		if(error >=1)
		{
			$.blockUI({
				theme:     false,
				title:    'Error',
				message:  '<strong><font color=red><p><br>Fields marked with (*) are compulsory.<br><br></p></font</strong>',
				timeout:   2000
			});
			
			return false;
		}
		else
		{
			return true;
		}
	});
});
    
</script>
</head>
<body>
	
	<!-- Begin control panel wrapper -->
	<div id="wrapper">
	
		<!-- Begin top bar -->
		<? include("includes/header.php"); ?>
		<!--End top bar -->
		
		<!-- Begin main menu -->
		<?
		include("includes/menu.php");
		?>
		<!-- End main menu -->
		
		
		<!-- Begin shortcut menu -->
    <?
		include("includes/shortcut.php");
		?>
		<!-- End shortcut menu -->
		
		<br class="clear"/>
		
		<!-- Begin content -->
		<div id="content_wrapper">
		  <ul class="first_level_tab">
				<li>
<a href="" class="active">
						Edit Request details</a>
				</li>
				<li></li>
				<li></li>
			</ul>
            <br class="clear" /><div class="onecolumn">
				
		    <div class="header">
					<div class="description"></div>
					
					<!-- Begin 2nd level tab -->
				<ul class="second_level_tab">
					<li></li>
				</ul>
<!-- End 2nd level tab -->All fields marked with (<strong>*</strong>) are compulsory</div>
				
				<div class="content nomargin">
					
					<!-- Begin example table data -->
					<!-- End example table data -->
					
					
					<!-- Begin pagination -->
					<!-- End pagination -->
					
					<div class="content">
                    <form action="<?=$filename2;?>.pro.php" method="post" onsubmit="validate(this);" enctype="multipart/form-data">
                    <?
                    	if($isEdit){
					?>
                    	<input type="hidden" name="edit" value="edit" />
                    	<input type="hidden" name="weddingcategoryid" value="<?=$_GET['weddingcategoryid'];?>" />
					
					<?
						}
						else{
					?>
                    	<input type="hidden" name="add" value="add" />                    
                    <?
						}
					?>                    
					  <!-- Begin form elements -->
					    <label>Budget From:</label>
					    *<br/>
					    <input type="text" class="text numberOnly" size="60" id="budgetfrom"  name="budgetfrom" value="<? if($isEdit) echo $row['budgetfrom']; ?>" />
                        <span id="name-error"></span>
					  <br/>	
					  <br/>	
					  <label>Budget To:</label>
					    *<br/>
					    <input type="text" class="text numberOnly" size="60" id="budgetto"  name="budgetto" value="<? if($isEdit) echo $row['budgetto']; ?>" />
                        <span id="name-error"></span>
					  <br/>	
					  <br/>						  
					  
					  <label>Deadline:</label>
					    *dd-mm-yyyy format<br/>
					    <input type="text" class="text" size="60" id="biddeadline"  name="biddeadline" value="<? if($isEdit) echo normalDate($row['biddeadline']); ?>" />
                        <span id="name-error"></span>
					  <br/>	
					  <br/>	
					  
					  <label>Detail:</label>
					    *<br/>
					    <textarea class='text' id="detail"  name="detail"><? if($isEdit) echo $row['detail']; ?></textarea>
                        <span id="name-error"></span>
					  <br/>	
					   <label>Picture:</label>
					    <br/>
							<?php if($isEdit){ ?>
							*If you have just uploaded picture try reloading if it's not displaying<br/>
							<img src='../img/weddingcats/<?=$row['weddingcategoryid']?>.jpg' alt='image'/>
							<br/>
							<?php } ?>
							<input type='file' name='picture'/>
                        <span id="name-error"></span>
					  <br/>
					  <br/>	
					  
					  <input type="submit" id="edit_email_template" class="button_dark" value="<? if($isEdit) echo "Edit Request"; else echo "Add Request"; ?>"/>

					  <!-- End form elements -->
                      
                      </form>
				  </div>
				
			  </div>
				
			</div><!-- Begin one column box -->
			<!-- End one column box -->
			
	  </div>
		<!-- End content -->
		
		<br class="clear"/>
			
		<div id="footer">
			&copy; Copyright <?php echo date("Y") ?> by HERTZ WEB ADMIN All Right Reserved.
		</div>
	
	</div>
	<!-- End control panel wrapper -->
	
</body>
</html>