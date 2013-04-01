<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2010-09-19 11:57:36 Pakistan Standard Time */ ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <base href="http://localhost/elibrary/admincp" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="content-language" content="en" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="http://localhost/elibrary/admincp/styles/screen.css" type="text/css" media="screen, projection" /> 
    <link rel="stylesheet" href="http://localhost/elibrary/admincp/styles/plugins/buttons/screen.css" type="text/css" media="screen, projection" /> 
    <link rel="stylesheet" href="http://localhost/elibrary/admincp/styles/woo_form.css" type="text/css" />
    <link rel="stylesheet" href="http://localhost/elibrary/admincp/styles/woo_theme_blue.css" type="text/css" />
    <!--[if lt IE 8]><link rel="stylesheet" href="http://localhost/elibrary/admincp/styles/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]--> 
    <link href="favicon.ico" rel="shortcut icon" />
    <script type="text/javascript" src="http://localhost/elibrary/admincp/js/wufoo.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script language="javascript" type="text/javascript" src="http://localhost/elibrary/admincp/js/datetimepicker.js"></script>
</head>
<body>
    <div class="container showgrid-">
        <hr class="space" />
        <div class="span-17" id="header">
            <h1><a href="http://localhost/" style="text-decoration:none; color:black;">Elibrary</a> Admin CP</h1>
            <p>CRUD Operations</p>
        </div>
        <hr />
        <div class="span-5 colborder">
            <h3>Tables</h3>
            <ul id="top_menu"><li>&diams; <a href='http://localhost/elibrary/admincp/index.php/books'>Books</a></li>
<li>&diams; <a href='http://localhost/elibrary/admincp/index.php/categories'>Categories</a></li>

<li>&diams; <a href='http://localhost/elibrary/admincp/index.php/publishers'>Publishers</a></li>


<li>&diams; <a href='http://localhost/elibrary/admincp/index.php/users'>Users</a></li>
<li>&diams; <a href='http://localhost/elibrary/admincp/index.php/book_types'>Book_Types</a></li><li>&diams; <a href='http://localhost/elibrary/admincp/index.php/user_types'>User_Types</a></li><li>&diams; <a href='http://localhost/elibrary/admincp/index.php/departments'>Departments</a></li><li>&diams; <a href='http://localhost/elibrary/admincp/index.php/featured_books'>Featured Books</a></li></ul>
            <div class="notice">
                <h3>Usage notice</h3>
                Use Admin CP with care.
            </div>
        </div>
		<div class="span-18 last" id="content">

			<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['template'].'.tpl', array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

        </div>

        <hr />

        <div class="span-26" id="footer">
            <p>
                Copyright &copy; Haisum Bhatti
            </p>
        </div>
    </div> 
</body>
</html>