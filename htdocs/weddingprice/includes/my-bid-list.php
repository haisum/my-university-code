<?php 
$tempBids = null;
$cipher = null;
if(!isset($bids)){
	if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])){
		require_once '../classes/Cipher.php';
		$cipher = new Cipher('guysoap');
		$page = $_REQUEST['page'];
		$tempBids = require 'bidData.php';
		unset($tempBids['bidCount']);
		unset($tempBids['messageCount']);
	}
	else{
		die('I am dead!');
	}
}
else{	
	require_once 'classes/Cipher.php';
	$cipher = new Cipher('guysoap');
	$tempBids = $bids;
}
$bids = $tempBids;
foreach($bids as $bid){
?>
<tr id='listTr<?php echo $bid['bidId'];?>'>									
	<td>
		<span><?php echo date("d-M-Y", strtotime($bid['bidDate'])); ?></span>
	</td>
	<td>
		<span><?php echo $bid['title']; ?></span>
	</td>
	<td>
		<span><?php echo date("d-M-Y",strtotime($bid['weddingDate'])); ?></span>
	</td>	
	<td>
		<span><?php echo $bid['contactPerson'];?></span>
	</td>
	<td>
		<span><?php echo $bid['region']['name'];?></span>
	</td>
	<td>
		<span>$<?php echo $bid['bidAmount'];?></span>
	</td>
	<td>
		<span>
		<?php 
			echo $bid['category']['name'];
		?>
		</span>
	</td>
	<td style='width:65px;'>
		<span><?php echo $bid['lastModified'];?></span>
	</td>
	<td>
		<span><?php echo $bid['status'];?></span>
	</td>
	<td>
		<a class='bidLink'  href="<?php $token=urlencode($cipher->encrypt($bid['bidId'])); echo URL . '/bid-wedding-detail.php?token=' . $token;?>">View</a>
	</td>
</tr>
<?php } ?>