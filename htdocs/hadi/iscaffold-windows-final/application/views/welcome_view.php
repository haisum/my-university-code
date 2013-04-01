<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>application/styles/reset.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>application/styles/styleGenerator.css" type="text/css" />
		<!-- jQuery -->
		<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function() {
				$('.message').hide();
				$('.message').fadeIn(1000);
			});
		</script>		
		<title><?php echo "$app_name $app_version"; ?></title>
	</head>
	<body>
		
		<!-- The main container -->
		<div id="container">
			
			<!-- The header -->
			<div id="header">
				<h1 id="title"><?php echo "$app_name $app_version"; ?></h1>
				<p id="version-codename">Codename: <?php echo $app_codename; ?></p>
			</div>
			<!-- The Container -->
			<div id="content">
				<div id="welcome">
					<!-- Welcome message -->
					<?php echo strftime("%Y-%m-%d %H:%M:%S", strtotime("13-Jan-2010 00:13:19"));
					?>
					<h2>Welcome</h2>
					<p>Welcome to <acronym class="yellow" title="This application"><?php echo $app_name;?></acronym>, iScaffold is a <acronym class="red" title="A tool which is meant to result in high-quality, defect-free, and maintainable software products.">CASE</acronym> application built using <acronym class="green" title="An Open Source PHP framework">CodeIgniter</acronym> that lets you generate your basic <acronym class="blue" title="Files that handle the incoming and outgoing data">Models</acronym>, <acronym class="brown" title="These files show the actual data or output.">Views</acronym> and <acronym class="pink" title="Controllers handle the incoming requests, call models etc">Controllers</acronym> based on a given database table.</p>

					<?php if ( $info_message == 'success' ): ?>
						<div id="<?php echo $message_id; ?>" class="message">
							<p><?php echo 'The CRUD-Application has been generated. <br /><br />
                                           Please take the code from <b>/output</b> directory and copy it to your application directory.'; ?></p>
						</div>						
					<?php endif ?>
					
					<!-- Configure -->
					<h2<?php if ( $info_message == 'step2' || $info_message == 'success' ): ?> class="lined"<?php endif ?>>Step 1: Configuration</h2>
					
					<p>Before <acronym class="yellow" title="This application">iScaffold</acronym> creates your code <?php echo anchor('index.php/configurator', 'Configure table data',array('title' => 'Generate the data','id' => 'generate-link')) ?>.</p>
					<p>You can set up diffrent types of inputs for each table fileds.</p>

					<!-- How to use -->
					<h2<?php if ( $info_message == 'success' ): ?> class="lined"<?php endif ?>>Step 2: Generate source code</h2>
					
					<?php if( $is_config ): ?>
					   <p>Using <acronym class="yellow" title="This application">iScaffold</acronym> is very simple, simple click <?php echo anchor('index.php/generate/create', 'Generate',array('title' => 'Generate the data','id' => 'generate-link')) ?>.</p>
                    <?php endif; ?>
                    					
					<!-- Important notice -->
					<h2>Important</h2>

					<div id="<?php echo $message_id; ?>" class="message">
						<p><?php echo $dir_message; ?></p>	
					</div>
				
				</div>
			</div>
			<!-- The footer -->
			<div id="footer">
				<p>&#169;Copyright 2009 -  &#214;m&#252;r Yolcu &#73;skender, Tibor Szász and Yorick Peterse. All rights reserved<br />This application is powered by CodeIgniter</p>
			</div>
		</div>
	</body>
</html>