<?php 
	  require_once 'includes/config.php';
	  require_once 'includes/functions.php';
	  require_once 'includes/custom-functions.php';
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
			<title>SZABIST Time Table Scheduling</title>
			<script type='text/javascript' src='js/jquery.js' ></script>
			<script type='text/javascript' src='js/jquery-ui-1.8.16.custom.min.js' ></script>
			<script type='text/javascript' src='js/print.js' ></script>
			<script type='text/javascript' src='js/main.js' ></script>
			<link href='css/jquery-ui-1.8.16.custom.css' type='text/css' rel='stylesheet'/>
			<link href='css/main.css' type='text/css' rel='stylesheet'/>
		</head>
		<body>
			<!-- DON'T REMOVE -->
			<div class='error'>
				Test Error
			</div>
			<div class='success'>
				Test Success
			</div>
			<div class='loading'>
				
			</div>
			<input type='hidden' id='type' value='<?php if(isset($_SESSION['role'])) echo $_SESSION['role']; else echo 'Normal'; ?>' />			
			<input type='hidden' id='programid' value='<?php if(isset($_SESSION['programid'])) echo $_SESSION['programid']; else echo '0'; ?>' />
			<!-- DON'T REMOVE-->			
			<div id='navigation'>
				<ul class='menu'>
					<li class='menu-item'>
						<a class='menu-link' href='javascript:void(0);'>
							<span class='menu-head active'></span>
							<span class='menu-text active'>Time Table</span>
						</a>
					</li>
					<li class='menu-item'>
						<a class='menu-link print' href='javascript:void(0);'>
							<span class='menu-head'></span>
							<span class='menu-text'>Print</span>
						</a>
					</li>
					<li class='menu-item add-course-menu' style='display:none;'>
						<a class='menu-link add-course-link' href='javascript:void(0);'>
							<span class='menu-head'></span>
							<span class='menu-text'>Add Class</span>
						</a>
					</li>	
					<li class='menu-item add-course-menu' style='display:none;'>
						<a class='menu-link add-teacher-link' href='javascript:void(0);'>
							<span class='menu-head'></span>
							<span class='menu-text'>Add Teacher</span>
						</a>
					</li>
					<li class='menu-item add-course-menu' style='display:none;'>
						<a class='menu-link add-subject-link' href='javascript:void(0);'>
							<span class='menu-head'></span>
							<span class='menu-text'>Add Course</span>
						</a>
					</li>
					<li class='menu-item right logout-menu-item'>
						<a class='menu-link do-logout' href='javascript:void(0);'>
							<span class='menu-head'></span>
							<span class='menu-text active'>Logout</span>
						</a>
					</li>
					<li class='menu-item right logout-menu-item'>						
						<span class='menu-text user-text'>Hadi (Admin)</span>
					</li>	
					<li class='menu-item right login-menu-item'>
						<a class='menu-link do-login' href='javascript:void(0);'>
							<span class='menu-head'></span>
							<span class='menu-text active'>Login</span>
						</a>
					</li>
					<li class='menu-item right login-menu-item'>
						<form action='javascript:void(0);' id='login-form'>
							<input type='text' id='user' class='text login' placeholder='Username' />
							<input type='password' id='pass' class='text login' placeholder='Password' />
						</form>
					</li>	
					<li class='menu-item right'>
						<?=select(getPrograms(), 2, 'program', 'program', 'select text');?>
					</li>
				</ul>
			</div>
			<div id='content'>
				<?php require_once 'getTimeTable.php' ?>
			</div>
		</body>
	</html>
	