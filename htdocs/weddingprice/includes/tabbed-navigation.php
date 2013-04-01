<?php 
$filename = basename($_SERVER['SCRIPT_FILENAME']);
?>
	<ul style='padding:0px;'>
		<li>
			<a id='summaryTab' href="<?php if($filename=='bid-wedding-detail.php') echo "#summaryContainer"; else echo '#tabs-1';?>"> 
				<span><?php if($filename=='bid-wedding-detail.php')echo 'Bid Summary'; else echo 'Supplier&#39;s Bid Summary';?></span>
			</a>
		</li>
		<li>
			<a id='messageTab' href="<?php if($filename=='bid-wedding-detail.php') echo URL . '/ajax/bid-details-supplier/messages.php?weddingId=' . $weddingId; else echo URL . "/ajax/bid-details/messages.php?weddingId=$weddingId&supplierId=$supplierId&categoryId=$categoryId&bidId=$bidId&recieverId=$recieverId&senderId=$senderId";?>">
				<span id='messagesSpan'>Messages <?php if($unreadCount > 0) echo '(' . $unreadCount . ')';?></span>
			</a>
		</li>
		<?php if( isset( $bid ) && $bid->status == 'COMPLETEDBUYER') { ?>
			
		<li>
			<a id='messageTab' href="#addReview">
				Add Review
			</a>
		</li>
		<?php } ?>
	</ul>