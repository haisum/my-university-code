<?php
    require 'config/config.php';
	require 'includes/securePasswordChange.php';
	mysql_connect(HOST, USER, PASSWORD);
	mysql_select_db(DBNAME);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

    <head>
   
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

   <title>Wedding Price</title>

   <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/main.css"/>


   <!--[if lte IE 7]>

  <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/lteie7.css"/>

  <script defer type="text/javascript" src="<?php echo URL;?>/js/pngfix.js"></script>

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

 <div id="steps_box">

<h2>Compare and Pick Quotes From Qualified Businesses.</h2>

<div class="step">

    <div class="step_title"><span class="step_no">1.</span>Chose a vendor</div>

    <p class="step_description">

   Find a photographer, DJ, Bridal Shop, <br/>

   Wedding venue and 100's of others

    </p>

</div>

<div class="step step_middle">

    <img src="img/cake.png" alt=""/>

</div>

<div class="step step_arrow">

    <img src="img/arrow.gif" alt=""/>

</div>

<div class="step">

    <div class="step_title"><span class="step_no">2.</span>Ask for a quote</div>

    <p class="step_description">

   Match your vendor<br/>
   to your budget

    </p>

</div>

<div class="step step_middle">

    <img src="img/note.gif" alt=""/>

</div>

<div class="step step_arrow">

    <img src="img/arrow.gif" alt=""/>

</div>

<div class="step">

    <div class="step_title"><span class="step_no">3.</span>Let's get it started!</div>

    <p class="step_description">

   Chose a vendor that<br/>
    best matches your needs

    </p>

</div>

<div class="clear"></div>

 </div>

 <div id="details_container">

<div id="left_details_column">

    <div id="left_title_box">

   <h2 class="left_title_box_h2">Design the Wedding of your dreams</h2>

    </div>

    <div id="left_detail_box">

   <h2>Why Choose Wedding Price?</h2>

   <p class="left_detail_box_p">

  Weddingprice is an intelligent system that saves you time and money by

  immediately matching your job request to the right service provider. We give customers the power to choose

  from the quotes provided and help businesses to find more work.

   </p>
   <div class='requests' style='float:left;'>
		<h2>Latest Requests</h2>
		<div class='vticker3' style='width: 530px;'>
			<ul style='float:left;'>
				<?php
				$result = mysql_query('select weddingcategory.weddingcategoryid, weddingcategory.detail, wedding.title, 
				category.`name`  
				from weddingcategory, wedding, category 
				where weddingcategory.weddingid = wedding.weddingid
				AND weddingcategory.categoryid = category.categoryid
				order by weddingcategory.posteddate desc limit 2');
				if(mysql_num_rows($result) > 0){
					while($row = mysql_fetch_array($result)) {
				?>
					<li style='float:left;'>
						<div style='float:left;'>
							<p style='float:left;margin:0px 25px 10px 10px;width:100px;'><img style='width:120px;height:100px;'  src='img/weddingcats/<?php echo $row['weddingcategoryid']; ?>.jpg' /></p>
							<strong><?php $title = str_replace('(#)', 'and', $row['title']); if(trim($title)!= '') echo $title . '\'s wedding'; else echo ''; ?> <?php echo $row['name'];?></strong><br/>	
							<p style='margin:0px 10px 10px 20px;display:inline;'>
								
								<?php echo $row['detail']; ?>				
							</p>			
							<div style='clear:both;'></div>
						</div>
					</li>
				<?php 
				} }
				else{
				?>
				<li style='float:left;'>
					<div  style='float:left;'>
						<p style='float:left;margin:0px 25px 10px 10px;width:100px;display:inline;'>
						<img  src='img/cake.png' />
						</p>
						
							<strong>Hani & Daniya's wedding cake</strong><br/>
						<p style='margin:0px 10px 10px 20px;display:inline;'>
							We want a vanilla cake with strawberry with strawberry topping.
						</p>			
						<div style='clear:both;'></div>
					</div>
				</li>
				<?php } ?>
			</ul>
			
						<div style='clear:both;'></div>
		</div>
		
						<div style='clear:both;'></div>
   </div>
   
	<div style='clear:both;'></div>
    </div>
	
	<div style='clear:both;'></div>
</div>

<div id="right_details_column">

    <h2>Special Offers and Advertisement</h2>
	<div class='vticker1'>
		<ul>
			<?php 			
			$result = mysql_query('select * from specialoffer where dateEnd >= NOW() AND status="ACTIVE" order by date desc'); 
			$num = mysql_num_rows($result);
			if($num > 0){
				while($row = mysql_fetch_array($result)){
			?>
			<li>
				<div class="latest_marriage">
				<h2 style='padding:0;padding-bottom:10px;margin:0px;'>
					<?php if($row['link'] != ''){ ?>
					<a href='<?php echo $row['link']; ?>'><?php echo $row['title']; ?></a>
					<?php } else { ?>
						<?php echo $row['title']; ?>
					<?php } ?>
				</h2>
				<?php if(file_exists('img/specialoffers/' . $row['specialofferid'] . '.jpg')){ ?>	
					<img class="latest_marriage_img" src="img/specialoffers/<?php echo $row['specialofferid']; ?>.jpg" alt=""/>
				<?php } ?>
			   <div class="latest_marriage_p">
					<?php echo $row['content']; ?>
				</div>
				<div style='clear:both;margin-bottom:10px;'></div>
				</div>
			</li>
			
			<?php  } } else { ?>
			<li>
				<div class="latest_marriage">
				<h2 style='padding:0;padding-bottom:10px;margin:0px;'><a href='http://www.food.com/recipe/moms-awesome-potato-pancakes-26121'>Mom's Awesome Potato Pancakes</a></h2>	
				<img class="latest_marriage_img" src="img/potatoes.jpg" alt=""/>
			   <div class="latest_marriage_p">My mom made these a lot, as they were one of my dad's favorites. Now I serve them to my family at breakfast, lunch or dinner! They are delicious with anything or all by themselves! Enjoy! And select my response to have home cooked food flavor in your wedding.
				</div>
				<div style='clear:both;margin-bottom:10px;'></div>
				</div>
			</li>
			<li>
				<div class="latest_marriage">
				<h2 style='padding:0;padding-bottom:10px;margin:0px;'><a href='http://www.exclusivelyweddings.com/'>Wedding Organizer</a></h2>	
			   <div class="latest_marriage_p">
					Planning your big day is a cinch when using the must have Organized Bride wedding organizer by Exclusively Weddings. This exclusive wedding organizer contains everything you need to plan your wedding, from checklists, to tips, to a 12 month planning calendar. Check out the other useful planning tools that Exclusively Weddings offers below.
				</div>
				<div style='clear:both;margin-bottom:10px;'></div>
				</div>
			</li>			
			<?php } ?>
		</ul>
	</div>
</div>

<div class="clear"></div>

 </div>


 <div id="social_contact">

<div id="tweets_container">

    <h2>Latest Responses</h2>
	<div class='vticker2'>
		<ul>
			<?php
				$result = mysql_query('select bid.biddescription, supplier.`name` as suppliername, wedding.title, 
				category.`name` as categoryname, bid.date
				FROM bid, supplier, wedding, category
				WHERE bid.categoryid = category.categoryid
				AND bid.weddingid = wedding.weddingid
				AND bid.supplierid = supplier.supplierid
				ORDER BY bid.date desc LIMIT 3');
				if(mysql_num_rows($result) > 0){
				while($row = mysql_fetch_array($result)){
			?>
				
			<li>
				<p  class="tweet_p">
				   <?php echo $row['biddescription']; ?><br/>
				   <span style='font-style:italic;'>by <?php echo ucwords($row['suppliername']); ?> on <?php echo str_replace('(#)', 'and', ucwords($row['title'])); ?>'s wedding <?php echo ucwords($row['categoryname']); ?></span>
				</p>
			</li>
			<?php  } } else { ?>
			
			<li>
				<p  class="tweet_p">
					<?php echo mysql_error(); ?>We can deliver you cake within 2 working days, check PM for details.<br/>
					<span style='font-style:italic;'>by ATMega on Dani & Mehdi's wedding cake</span>
				</p>
			</li>
			<li>
				<p  class="tweet_p">
				   We are experts on transport facilitation check message for details.<br/>
				   <span style='font-style:italic;'>by Codefreax on Michael and Rachael's wedding transport</span>
				</p>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>

<div id="connect_with_us">

    <h2>Connect With Us</h2>

    <div class="social_links">

   <div class="social_link_facebook">

  <a href="javascript:void(0);" class="social_link_a">Be a fan on Facebook</a>

   </div>

   <div class="social_link_twitter">

  <a href="javascript:void(0);"  class="social_link_a">Follow us on Twitter</a>

   </div>

    </div>

</div>

<div class="clear"></div>

 </div>

  </div>

  
   </div>

 <?php require 'includes/footer.php'; ?>
 
 
   <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>-->
   <script src="<?php echo URL;?>/js/jquery.js" type="text/javascript"></script>
   <script src="<?php echo URL;?>/js/vticker.js" type="text/javascript"></script>
   <script type="text/javascript" src="<?php echo URL;?>/js/main.js"></script>
    </body>

</html>

