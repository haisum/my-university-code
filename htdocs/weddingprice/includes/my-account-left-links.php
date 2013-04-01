<?
$filename =  basename($_SERVER['SCRIPT_FILENAME']);
if($_SESSION['type'] == "Buyer"){	
?>
<div class="aside">
	<h2><strong><font color="#333333">My Weddingprice Buyer Account</font></strong></h2>
    <div style="margin-top:10px;margin-bottom:-10px;margin-left:15px">
    	<strong>Account Information</strong>
    </div>
    <ul>
		<li><a href="<?php echo URL;?>/account.php" <? if($filename == 'account.php') echo "class='leftlinks'"; ?>>My Account</a></li>      
	</ul>
   	<div style="margin-top:10px;margin-bottom:-10px;margin-left:15px">
    	<strong>My Wedding</strong>
    </div> 	
    <ul>
        <li><a href="<?php echo URL;?>/my-wedding.php" <? if($filename == 'my-wedding.php') echo "class='leftlinks'"; ?>>Wedding Detail</a></li>
        <li><a href="<?php echo URL;?>/add-request.php" <? if($filename == 'add-request.php') echo "class='leftlinks'"; ?>>Add A Request</a></li>	
	</ul>		
	<?php
		require_once 'classes/database/objects/class.weddingcategory.php';
		require_once 'classes/database/objects/class.wedding.php';
		require_once 'classes/database/objects/class.bid.php';
		$weddingId = null;		
		$w = new Wedding();		
		$buyerId = $_SESSION['buyerId'];
		if(isset($wedding->weddingId)){
			$weddingId = $wedding->weddingId;
		}
		else{
			$weddingList = $w->GetList(array(
				array('buyerid', '=', $buyerId)
			), '', true, 1);
			$weddingId = $weddingList[0]->weddingId;
		}
		$wl = $w->GetList(array(
			array('buyerid' , '=' , $buyerId)			
		), '', true, 1);
		$w = $wl[0];
		$wc = new WeddingCategory();
		$wcl = $wc->GetList(array(
			array('weddingid', '=' , $weddingId)
		));
		if(count($wcl) > 0){
			require_once 'classes/Cipher.php';
			$cipher = new Cipher('dirtoo');
	?>
	<div style="margin-top:10px;margin-bottom:-10px;margin-left:15px">
    	<strong>Requests</strong>
    </div> 	
    <ul>
		<?php foreach($wcl as $wc) {
			$bid = new Bid();
			$bidL = $bid->GetList(
				array(
					array('weddingcategoryid', '=' , $wc->weddingcategoryId)
				)
			);
			$count = count($bidL);
		?>
		<li>
			<a title='<?php if($count == 0) echo 'No bids on this category!'; else echo $count . 'bid(s) on this category'; ?>' href="<?php echo URL;?>/show-request.php?token=<?php echo urlencode($cipher->encrypt($wc->weddingcategoryId));?>" <? if(($filename == 'show-request.php' || $filename == 'show-bid-details.php')  && $cipher->decrypt(str_replace(' ', '+', $_GET['token'])) == $wc->weddingcategoryId) echo "class='leftlinks'"; ?>>
			<?php 
			require_once 'classes/database/objects/class.category.php';
			$category = new Category();
			$category->Get($wc->categoryId);
			echo ucwords($category->name);	
			if($count != 0){
				echo " ($count)";
			}
			?>
			</a>
		</li>		
		<?php } ?>
	</ul>
	<?php 
	} ?>
    <div style="margin-top:10px;margin-bottom:-10px;margin-left:15px">
    	<strong>Messages</strong>
    </div>
    <ul>
		<li><a href="<?php echo URL;?>/messages.php" <? if($filename == 'messages.php') echo "class='leftlinks'"; ?>  >Display Private Messages</a></li>             
	</ul>
</div>
<?php
}
else if($_SESSION['type'] == "Supplier"){
?>
<div class="aside">
	<h2><strong><font color="#333333">My Weddingprice Supplier Account</font></strong></h2>
    <div style="margin-top:10px;margin-bottom:-10px;margin-left:15px">
    	<strong>Account Information</strong>
    </div>
    <ul>
		<li><a href="<?php echo URL;?>/account.php" <? if($filename == 'account.php') echo "class='leftlinks'"; ?>>My Account</a></li>      
		<li><a href="<?php echo URL;?>/supplier-account-type.php" >Upgrade Membership</a></li>      
	</ul>
	<div style="margin-top:10px;margin-bottom:-10px;margin-left:15px">
		<strong>My Bids</strong>
	</div> 	
    <ul>
        <li>	
			<?php
				$hasBids = false;
				require_once 'classes/database/objects/class.bid.php';
				require_once 'classes/database/objects/class.category.php';
				require_once 'classes/database/objects/class.weddingcategory.php';
				require_once 'classes/database/objects/class.wedding.php';
				mysql_connect(SERVER, USER, DBNAME);
				mysql_select_db(DBNAME);
				$bid = new Bid();
				$supplierId = $_SESSION['supplierId'];
				$query = "select categoryid, name as cname from category where categoryid IN (select categoryid from categorysuppliermap where supplierid=$supplierId) OR categoryid IN (select primarycategoryid from supplier where supplierid = $supplierId)";
				$result = mysql_query($query);
	while($row = mysql_fetch_assoc($result)){
				$bl = $bid->GetList(array(
					array('supplierid', '=' , $supplierId),
					array('categoryid', '=' , $row['categoryid']),
					//array(" bidid IN (select bidid from bid where supplierid = $supplierid AND weddingcategoryid IN (select weddingcategoryid from weddingcategory where biddeadline < NOW())) ")
				));
				if(count($bl) > 0){
					$hasBids = true;
				?>
					
			<div style="margin-top:10px;margin-bottom:-10px;margin-left:15px">
				<strong><?php echo ucwords($row['cname']); ?></strong>
			</div> 	
			<ul>
				<?php
				foreach($bl as $b){
					$wedc = new WeddingCategory();
					$wedc->Get($b->weddingcategoryId);
			?>
				<li>
					<a <?php if($filename == 'show-bid.php' && $_GET['bid'] == $b->bidId) echo 'class="leftlinks"' ?> href='<?php echo URL . '/show-bid.php?bid=' . $b->bidId ;?>'><?php   $wedding= new Wedding(); $wedding->Get($wedc->weddingId); echo str_replace('(#)' , '&' , $wedding->title); ?></a>
				</li>			
			<?php } ?>
			
			</ul>
			<?php
				} 
			} if(!$hasBids){ ?>
				<a title="Either you haven't bid yet or requests you bid on have been completed! Click here to start bidding." href='<?php echo URL . '/list-weddings.php' ; ?>'>No active bids</a>
			<?php } ?>
		</li>		
	</ul>
    <div style="margin-top:10px;margin-bottom:-10px;margin-left:15px">
    	<strong>Messages</strong>
    </div>
    <ul>
		<li><a href="<?php echo URL;?>/messages.php" <? if($filename == 'messages.php') echo "class='leftlinks'"; ?>  >Display Private Messages</a></li>             
	</ul>
	<div style="margin-top:10px;margin-bottom:-10px;margin-left:15px">
    	<strong>Advertise on Home Page</strong>
    </div>
    <ul>
		<li><a href="<?php echo URL;?>/special-offers.php" <? if($filename == 'special-offers.php') echo "class='leftlinks'"; ?>>Add Advertisement</a></li>      
	</ul>
</div>
<?php
}
