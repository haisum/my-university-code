 <script type="text/javascript">
	var APP_URL = '<?php echo URL; ?>';
 </script> 
 <noscript>
	 <div class="noscript">
		<p>Seems Like Javascript on your browser is turned off. This site uses Javascript to function correctly. Kindly turn it on or change your current	browser. You may also <a href="<?php echo URL;?>/login.php">Login</a> or <a href="<?php echo URL;?>/login.php">Register</a> and continue using site.</p>
	 </div>
 </noscript>
 <div id="header_container">

  <div id="header">

 <div id="logo">

<img src="img/logo.png" alt="Wedding Price" title="Wedding Price"/>

 </div>

 <div class="login-grid">

<div class="rgt">

    <div id="loginFl">

   <div class="lgn-hd">
  <?php if(isset($_SESSION['userId'])){ ?>
  <div class="logout"><a href="<?php echo URL; ?>/logout.php">Logout</a></div>
  <?php if(isset($_SESSION['supplierId'])){?>
	<div class="post-job" style='width:85px;'><a  href="<?php echo URL; ?>/list-weddings.php">Weddings</a></div>
	<?php }
	else if(isset($_SESSION['buyerId'])){
	?>
	<div class="post-job"><a href="<?php echo URL; ?>/add-request.php">Make Request</a></div>
	<?php }
	else {
	?>
	<div class="post-job"><a href="<?php echo URL; ?>/account.php">My Account</a></div>
	<?php }?>
  <?php }  else {?>
  <div class="reg-btn" style="background-position: 0px 100%; "></div>
  <div class="lgn-btn" style="background-position: 0px 100%; "></div>
	<?php } ?>
   </div>
   <div class="lgn-wrp">

  <div class="lgn-top">

  </div>

  <div class="lgn-mdl">

 <form name="login_form" action="javascript:void(0);" method="post" onsubmit='login();return false;'>

<input class="lgn_input text" maxlength="150" type="text" name="email" id="email" value="Email Id" onblur="javascript: if(this.value=='') { this.value='Email Id';}" onfocus="javascript: if(this.value=='Email Id') {this.value='';};"/>

<p></p>

<input class="lgn_input text" maxlength="150" type="password" name="password" id="password" value="Password" onblur="javascript: if(this.value=='') { this.value='Password';}" onfocus="javascript: if(this.value=='Password') {this.value='';};"/>

<table style="vertical-align:top">

    <tbody>

   <tr>

  <td style="vertical-align:top">

 <input class="lgn_btn_sbmt" type="submit" value="Login"/>

  </td>

  <td style="vertical-align:top">

 <!--<input id="loginpermanent" type="checkbox" name="remember" tabindex="3" class="text"/>&nbsp;<label class="lgn-text" for="loginpermanent">Remember me</label>-->

 <div>

<a href="javascript:void(0);" onclick="$('.reg-btn').click();return false;">Register Account?</a><span style="color: black;"><br/> <a href="<?php echo URL; ?>/forgot-password.php" class="lgn-fgt">Forgot details?</a>

 </div>

  </td>

   </tr>
   <tr>   
	<td colspan="2" style="vertical-align:top" class='ajaxMessage' id="login_msg"></td>
   </tr>
   

    </tbody>

</table>

 </form>

  </div>

  <div class="lgn-btm">

  </div>

   </div>

   <div class="">

   </div>

   <div class="reg-wrp">

  <div class="lgn-top">

  </div>

  <div class="reg-mdl">

 <form name="reg_form" id="reg_form" action="javascript:void(0);" method="post" onsubmit="register();return false;">

<input class="lgn_input text" id="email_reg" maxlength="150" type="text" name="email_reg" value="Email Id" onblur="javascript: if(this.value=='') { this.value='Email Id';}" onfocus="javascript: if(this.value=='Email Id'){this.value='';}"/>

<table style="vertical-align:top">

    <tbody>

<tr>
	  <td style="vertical-align:top">
		<input class="lgn_btn_sbmt" type="submit" value="Register"/>
	  </td>

   </tr>
   <tr>   
	<td style="vertical-align:top" class='ajaxMessage' id="reg_msg"></td>
   </tr>

    </tbody>

</table>

 </form>

  </div>

  <div class="lgn-btm">

  </div>

   </div>

   <div class="">

   </div>

    </div>

</div>

 </div>

  </div>

   </div>