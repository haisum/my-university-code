<?php
require_once '../config/config.php';
require_once '../classes/database/objects/class.database.php';
require_once '../classes/database/objects/class.weddingcategory.php';
require_once '../classes/database/objects/class.category.php';
require_once '../classes/database/objects/class.wedding.php';
require_once '../classes/database/objects/class.supplier.php';

if(!isset($_GET['source'], $_GET['request']) || !is_numeric($_GET['source']) || !is_numeric($_GET['request'])){
	die('Not Authorized');
}
$weddingId = intval($_GET['source']);
$categoryId = intval($_GET['request']);

$wedObj = new WeddingCategory();
$wedList = $wedObj->GetList(array(
	array('weddingid','=', $weddingId),
	array('categoryid','=', $categoryId)
));
if(count($wedList) != 1){
	die('No such source or request');
}
$wed = $wedList[0];
$cat = new Category();
$cat->Get($wed->categoryId);
$canBid = false;
?>
<div class="clear"></div>
<div class='ui-widget' style='border:0px;'>
	<img style='float:right;' src="<?php echo URL . "/img/weddingcats/{$wed->weddingcategoryId}.jpg";?>" alt= 'image' class='weddingImg' />
	<div style='float:left;'>
		<div class='detailBox'><strong>Budget:</strong><span><?php echo $wed->budgetFrom; ?> to <?php echo $wed->budgetTo; ?></span><div style='clear:both;'></div></div>	
		<?php
			
			mysql_connect(HOST, USER, PASSWORD);
			mysql_select_db(DBNAME);
			$query = "SELECT IFNULL(count(amount),0) as count, IFNULL(min(amount),0) as min, IFNULL(max(amount),0) as max, ROUND(IFNULL(avg(amount),0),0) as avg from bid where weddingcategoryid={$wed->weddingcategoryId}";
			$result = mysql_query($query);
			$row = mysql_fetch_assoc($result);
			$count = 0;
			$min = 0;
			$max = 0;
			$avg = 0;
			if($row){
				$count = $row['count'];
				$min = $row['min'];
				$max = $row['max'];
				$avg = $row['avg'];
			}
		?>		
		<div class='detailBox'><strong>Total Bids:</strong><span><?php echo $count;?></span><div style='clear:both;'></div></div>
		<div class='detailBox'><strong>Maximum Bid:</strong><span>$<?php echo $max;?></span><div style='clear:both;'></div></div>	
		<div class='detailBox'><strong>Minimum Bid:</strong><span>$<?php echo $min;?></span><div style='clear:both;'></div></div>
		<div class='detailBox'><strong>Average Bid:</strong><span>$<?php echo $avg;?></span><div style='clear:both;'></div></div>
		<div class='detailBox'><strong>Details:</strong><div style='clear:both;'></div></div>
		<div class='detailBox' style='width:400px;'>
			<?php echo trim($wed->detail) == '' ? 'No details given yet' : trim($wed->detail); ?>
		</div>
		<?php if(isset($_SESSION['supplierId'])){
			$supplier = new Supplier();
			$supplierId = $_SESSION['supplierId'];
			$query = "SELECT DISTINCT categoryid from categorysuppliermap where supplierid=$supplierId 
			AND categoryid IN(SELECT categoryid from weddingcategory where weddingid=$weddingId) 
			OR categoryid=(select primarycategoryid from supplier where supplierid=$supplierId)
";
			$result = mysql_query($query);
			$myCats = array();
			while( $row = mysql_fetch_array($result)){
				$myCats[] = $row['categoryid'];
			}
			$myRegs = array();
			$query = "SELECT regionid from region where regionid IN(select regionid from regionsuppliermap where supplierid=$supplierId) OR regionid = (select primaryregionid from supplier where supplierid=$supplierId)";
			$result = mysql_query($query);
			while( $row = mysql_fetch_array($result)){
				$myRegs[] = $row['regionid'];
			}
			$wedding = new Wedding();
			$wedding->Get($weddingId);
			?>
			<div class='detailBox' style='width:400px;'>
			<?php			
			require_once '../classes/database/objects/class.bid.php';
				$bid = new Bid();
				$bidList = $bid->GetList(array(
					array('supplierid', '=' , $supplierId),
					array('weddingid', '=', $weddingId),
					array('categoryid', '=', $categoryId)
				));
				if(count($bidList) > 0){
					require_once '../classes/Cipher.php';
					$cipher = new Cipher('guysoap');
					$token = urlencode($cipher->encrypt($bidList[0]->bidId));
				?>
				<p>You have already bid on this category. Go to <a href='<?php echo URL . '/bid-wedding-detail.php?token=' .$token; ?>' style='color: #0486C9;'>your bids page</a> to modify or monitor your bid.</p>
				<?php }
				else if (!(in_array($wedding->regionId, $myRegs))){ ?>
				<p>You haven't yet selected this wedding's region as your preferred region in <a href='<?php echo URL;?>/account.php' style='color: #0486C9;'>account settings</a>. Change your <a href='<?php echo URL;?>/account.php'  style='color: #0486C9;'>account settings</a> to bid on this category.</p>
				<?php }
				else if(!in_array($categoryId, $myCats)){
				?>
				<p>You haven't yet selected this category as your preferred category in <a href='<?php echo URL;?>/account.php' style='color: #0486C9;'>account settings</a>. Change your <a href='<?php echo URL;?>/account.php'  style='color: #0486C9;'>account settings</a> to bid on this category.</p>
				<?php }
				else{
					$canBid = true;
				} 
			 ?>
			<div style='clear:both;'></div></div>
		 
			
		<?php }  ?>
	</div>
	<div style='clear:both;width: 100%;float: left;' >
		<?php if($canBid){ ?>
				<div class='inputContainer'>
					<label>Bid Amount</label>
					<input id='<?php echo $wed->weddingcategoryId;?>amount' class='text numberOnly' type='text' />
				</div>
				<div class='inputContainer'>
					Bid Description<br/>
					<textarea id='<?php echo $wed->weddingcategoryId;?>description' class='text'></textarea>
				</div>
				<div class='inputContainer'>
					<input class='doMessage' rel='<?php echo $wed->weddingcategoryId;?>message' id='<?php echo $wed->weddingcategoryId;?>doMessage' type='checkbox'/><label for='<?php echo $wed->weddingcategoryId;?>doMessage' style='float:none;clear:none;width:auto;margin:0px;'>Send Private Message</label><br/>
					<textarea style='display:none;' id='<?php echo $wed->weddingcategoryId;?>message' class='text'></textarea>
				</div>
				<div class='inputContainer'>
					<button rel='<?php echo $wed->weddingcategoryId;?>' class='button' style='clear:both;'>Bid Now</button>
				</div>
			<?php } ?>
	</div>
	
<div style='clear:both;line-height:1px;'></div>
</div> 