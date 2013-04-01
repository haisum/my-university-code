<?php
require_once 'config/config.php';
require_once 'includes/secureLogin.php';
require_once 'includes/securePasswordChange.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Wedding Price - Messages</title>		
        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/main.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/account.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/bidDetails.css"/>
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
                <div class="rgt c9d-srhf" id="search-bar">
                    <form action="javascript:;" method="post">
                        <div class="form-container">
                            <div id="search_click"><button class="lft" id="search_button" name="search" type="submit"></button></div>
                            <input type="text" id="searchbox" name="query" value="Search Keywords" class="sipt" onblur="javascript: if(this.value=='') { this.value='Search Keywords';}" onfocus="javascript: if(this.value=='Search Keywords'){this.value='';}"/>
                        </div>
                    </form>
                </div>
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
                    	include('includes/category-bidder-links.php');
					?>
                </div>
				<div id="rightCol">					
					<h1 class="myTitle">Codefreax</h1>
					<?php require_once 'includes/tabbed-navigation.php'; ?>
						<div class='supplierInfoContainer'>
					<table class='bidSummaryTable'>
						<tbody>
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Contact Person:</td>
								<td class='bidSummaryTdRight'>Pikachu</td>
							</tr>	
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Joined On:</td>
								<td class='bidSummaryTdRight'>23-Aug-2011</td>
							</tr>
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Last logged in at:</td>
								<td class='bidSummaryTdRight'>25-Aug-2011</td>
							</tr>
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Membership Type:</td>
								<td class='bidSummaryTdRight'>Gold</td>
							</tr>							
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Bids Completed:</td>
								<td class='bidSummaryTdRight'>4</td>
							</tr>							
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Average Rating:</td>
								<td class='bidSummaryTdRight'>3.6/5</td>
							</tr>						
							<tr class='bidSummaryTr'>
								<td class='bidSummaryTdLeft supplier'>Company Profile</td>
								<td class='bidSummaryTdRight'>asdafsf sadfsa fsdfsa fsdfsafd sadfsfd sadfsafdsf er szdfs fer zsxdsfsa erfsf ffsfsaff sfsafw sfasfw dgrre dsvv dgd</td>
							</tr>
						</tbody>
					</table>					
					<h2 class='reviewHeading'>Recent Reviews</h2>
					<table class='reviewTable'>
						<tbody>
							<tr class='reviewTr success'>
								<td class='reviewTdLeft'>XampMan</td>
								<td class='reviewTdRight'>Rating: 3/5</td>
							</tr>	
							<tr class='reviewSeparator'></tr>
							<tr class='reviewWordTr info'>
								<td class='reviewWordTd' colspan='2'>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. 
</td>
							</tr>
							<tr class='reviewSeparator'>
								
							</tr>
							<tr class='reviewTr success'>
								<td class='reviewTdLeft'>EchoEcho</td>
								<td class='reviewTdRight'>Rating: 5/5</td>
							</tr>	
							<tr class='reviewSeparator'></tr>
							<tr class='reviewWordTr info'>
								<td class='reviewWordTd' colspan='2'>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</td>
							</tr>
						</tbody>
					</table>
					<button class='btn acceptBtn'>Accept</button> <button class='btn rejectBtn'>Reject</button>
						</div>
                    <div style='clear:both;'></div>					
                </div><!-- rightCol -->
                <br style="clear: both;"/>
            </div>
            </div>
        </div>
		 <?php require 'includes/footer.php'; ?>
		
		
	</body>
</html>
