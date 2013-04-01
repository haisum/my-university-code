  <div id="footer_container" style='margin-top:30px;'>

 <div id="footer">

<div id="legal">

    <p class="legal_p">

   Use of this website constitutes acceptance of our Terms of Use. We care about your Privacy.<br/>

   Copyright &copy; 2011 Wedding Price Sample Pvt Ltd. All Rights Reserved.

    </p>

    <p class="legal_p">

   Designated trademarks, logos and brands are property of their respective owners. Use of this web site constitues acceptance of the Wedding Price Sample User Agreement and Privacy Policy.

    </p>

</div>

<div id="footer_right">

    <div id="footer_navigation">

   <ul class="footer_navigation_ul">

  <li class="footer_navigation_li"><a class="footer_navigation_a" href="<?php echo URL;?>">Home</a></li>

  <li class="footer_navigation_li">|</li>

  <li class="footer_navigation_li"><a class="footer_navigation_a" href="<?php echo URL;?>/faq.php">FAQ</a></li>
  <li class="footer_navigation_li">|</li>

  <li class="footer_navigation_li"><a class="footer_navigation_a" href="<?php echo URL;?>/contact-support.php">Contact</a></li>

   </ul>

    </div>
<?php if(!isset($_SESSION['userId'])) { ?>
    <div id="footer_signup">

   <h2 class="footer_signup_h2">Join the club!</h2>

   <form action="<?php echo URL;?>/login.php" method="post">

  <input type="text" name="email_reg" placeholder="Please Type Your Email Address" class="footer_signup_text input-text"/> 

  <input type="submit" value="Sign Me Up" class="footer_signup_submit"/>

   </form>

    </div>
<?php } ?>
</div>

 </div>

  </div>
