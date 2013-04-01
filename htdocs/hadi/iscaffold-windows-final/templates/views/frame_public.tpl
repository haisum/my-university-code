<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <base href="{php}echo ADMINURL;{/php}/" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="content-language" content="en" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="styles/screen.css" type="text/css" media="screen, projection" /> 
    <link rel="stylesheet" href="styles/plugins/buttons/screen.css" type="text/css" media="screen, projection" /> 
    <link rel="stylesheet" href="styles/woo_form.css" type="text/css" />
    <link rel="stylesheet" href="styles/woo_theme_blue.css" type="text/css" />
    <!--[if lt IE 8]><link rel="stylesheet" href="styles/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]--> 
    <link href="favicon.ico" rel="shortcut icon" />
    <script type="text/javascript" src="js/wufoo.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script language="javascript" type="text/javascript" src="js/datetimepicker.js"></script>
</head>
<body>
    <div class="container showgrid-">
        <hr class="space" />
        <div class="span-17" id="header">
            <h1><a href="{php}echo ADMINURL;{/php}" style="text-decoration:none; color:black;">iScaffold</a></h1>
            <p>CRUD Operations</p>
        </div>
        <hr />
        <div class="span-5 colborder">
            <h3>Tables</h3>
            <ul id="top_menu">
	<!-- ALTER THIS PART------------------------ -->
				<li>&diams; <a href='index.php/schedule'>Schedule</a></li>
				<li>&diams; <a href='index.php/program'>Programs</a></li>
				<li>&diams; <a href='index.php/batch'>Batches</a></li>
				<li>&diams; <a href='index.php/course'>Courses</a></li>
				<li>&diams; <a href='index.php/teacher'>Teachers</a></li>
				<li>&diams; <a href='index.php/slot'>Slots</a></li>
				<li>&diams; <a href='index.php/user'>Users</a></li>
				<li>&diams; <a href='index.php/config'>Configuration Variables</a></li>
				<li>&diams; <a href='index.php/cord'>Coordinator Programs</a></li>				
	<!-- ALTER THIS PART------------------------ -->			
				
			</ul>
            <div class="notice">
                <h3>iScaffold</h3>
                This project is modified by Haisum.
            </div>
        </div>
		<div class="span-18 last" id="content">

			{ include file=$template.'.tpl' }

        </div>

        <hr />

        <div class="span-26" id="footer">
            <p>
                Copyright &copy; {php}echo date('Y', time());{/php} Haisum Bhatti
            </p>
        </div>
    </div> 
</body>
</html>