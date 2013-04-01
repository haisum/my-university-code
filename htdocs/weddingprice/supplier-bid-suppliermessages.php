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
					<h2 class='messagesHeading'>Messages between You and XampMan</h2>
					<table class='reviewTable'>
						<tbody>
							<tr class='reviewTr warning messageYouTr'>
								<td class='reviewTdLeft sendMessageTd messageTdLeft'>You</td>
								<td class='reviewTdRight sendMessageTd messageTdRight'><a class='bidLink' href='#'>Send</a></td>
							</tr>	
							<tr class='reviewWordTr info messageYouTr'>
								<td class='reviewWordTd messageTdLeft' colspan='2'>
									<textarea class='myMessageTextArea'></textarea>
								</td>
							</tr>							
							<tr class='reviewSeparator'>
								
							</tr>
							<tr class='reviewTr success messageHimTr'>
								<td class='reviewTdLeft messageTdLeft'>XampMan</td>
								<td class='reviewTdRight messageTdRight'>29-Aug-2010</td>
							</tr>	
							<tr class='reviewWordTr info messageHimTr'>
								<td class='reviewWordTd messageTdLeft' colspan='2'>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. 
</td>
							</tr>
							<tr class='reviewSeparator'>
								
							</tr>
							<tr class='reviewTr warning messageYouTr'>
								<td class='reviewTdLeft messageTdLeft messageTdLeft'>You</td>
								<td class='reviewTdRight messageTdRight'>28-Aug-2010</td>
							</tr>	
							<tr class='reviewWordTr info messageYouTr'>
								<td class='reviewWordTd messageTdLeft' colspan='2'>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</td>
							</tr>
							
							<tr class='reviewSeparator'>
								
							</tr>
							<tr class='reviewTr success messageHimTr'>
								<td class='reviewTdLeft messageTdLeft'>XampMan</td>
								<td class='reviewTdRight messageTdRight'>29-Aug-2010</td>
							</tr>	
							<tr class='reviewWordTr info messageHimTr'>
								<td class='reviewWordTd messageTdLeft' colspan='2'>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. 
</td>
							</tr>
							<tr class='reviewSeparator'>
								
							</tr>
							<tr class='reviewTr warning messageYouTr'>
								<td class='reviewTdLeft messageTdLeft'>You</td>
								<td class='reviewTdRight messageTdRight'>28-Aug-2010</td>
							</tr>	
							<tr class='reviewWordTr info messageYouTr'>
								<td class='reviewWordTd messageTdLeft' colspan='2'>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</td>
							</tr>
						</tbody>
					</table>
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
