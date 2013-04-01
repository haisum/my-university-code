<?php 
$tempWeds = null;
$filePath = 'img/weddings/';
$cipher = null;
	if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])){
		require_once '../classes/Cipher.php';
		$cipher = new Cipher('bodyguard');
		$page = $_REQUEST['page'];
		$tempWeds = require 'weddingData.php';
		$filePath = '../img/weddings/';
		unset($tempWeds['totalRecords']);
	}
	else{
		die('I am dead!');
	}
$weddings = $tempWeds;
foreach($weddings as $wedding){
?>
<tr id='listTr<?php echo $wedding['weddingId'];?>'>									
	<td style='width:40px;'>
	<div id="listWrap<?php echo $wedding['weddingId'];?>">
		<?php $file = file_exists( $filePath . $wedding['weddingId'] . '_thumb.jpg')?$wedding['weddingId'] . '_thumb.jpg':'-1_thumb.jpg';
		?>
		
		<img id='<?php echo $wedding['weddingId'];?>thumb' src='<?php echo URL;?>/img/weddings/<?php echo $file;?>' alt='image'/>
	</td>
	<td style='width:115px;'>
		<span id='weddingTitleText<?php echo $wedding['weddingId'];?>'><?php echo $wedding['title']; ?></span>
	</td>
	<td style='width:125px;'>
		<span id='bidDeadLineText<?php echo $wedding['weddingId'];?>'><?php echo date("d-M-Y",strtotime($wedding['bidDeadline'])); ?></span>
	</td>
	<td style='width:120px;'>
		<span id='regionText<?php echo $wedding['weddingId'];?>'><?php echo $wedding['region']['name'];?></span>
	</td>
	<td style='width:65px;'>
		<span id='guestCountText<?php echo $wedding['weddingId'];?>'><?php echo $wedding['guestCount'];?></span>
	</td>
	<td style='width:65px;'>
		<span id='bridalPartySizeText<?php echo $wedding['weddingId'];?>'><?php echo $wedding['bridalPartySize'];?></span>
	</td>
	<td style='width:95px;'>
		<span id='budgetFromText<?php echo $wedding['weddingId'];?>'>$<?php echo $wedding['budgetFrom'];?>-$<?php echo $wedding['budgetTo'];?></span>
	</td> 
	<td style='width:40px;'>
		<?php if($wedding['bidCount'] == 0) echo '0'; else{ ?>
		<a title='View Detail of Bids' class='wtable-a bidLinkDetails'  href="<?php echo URL . '/bid-details.php?token=' . urlencode($cipher->encrypt($wedding['weddingId']));?>"><?php echo $wedding['bidCount']; ?></a>
		<?php } ?>
	</td>
	<td style='width:35px;'>
		<a class='wtable-a'  href="javascript:editWedding(<?php echo $wedding['weddingId'];?>);"><img src='<?php echo URL;?>/img/edit.png' id='editImg<?php echo $wedding['weddingId'];?>' alt=''/></a>
	</td>
</tr>
<tr class='editTr' id="editTr<?php echo $wedding['weddingId'];?>" style='display:none;'>
	<td colspan='9' style="padding:0px;">
	<div id='editWrap<?php echo $wedding['weddingId'];?>' style='display:none;'>
	</div>
	</td>
	
</tr>
<?php } ?>