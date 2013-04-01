<?php $filename =  basename($_SERVER['SCRIPT_FILENAME']); ?>
<div class="aside">
	<h2><strong><font color="#333333">Your Messages</font></strong></h2>
	<ul>
		<li><a href="<?php echo URL . '/account.php';?>">My Account</a></li> 
		<li><a <?php if($filename == 'messages.php') echo 'class="leftlinks"'; ?> href="<?php echo URL . '/messages.php';?>"><strong>Inbox</strong></a></li>      
		     
	</ul>
	
	<?php
		$query = "select count(fromid) as count, fromid, `name` from message, " . strtolower($othertable)  . " where toid='{$userid}' AND isread='NO' AND message.fromid = " . strtolower($othertable)  . "." . strtolower($othertable) . "id group by fromid";
		$result = mysql_query($query);
		if (mysql_num_rows($result) > 0){ ?>
			<div style="margin-top:10px;margin-bottom:-10px;margin-left:15px">
				<strong>Unread</strong>
			</div> 	
		<ul>
		<?php 
		while($row = mysql_fetch_array($result)){
	?>
		<li><a <?php if(isset($otherid) && $otherid == $row['fromid']) echo 'class="leftlinks"'; ?> href="<?php echo URL . '/show-messages.php?token=' . urlencode($cipher->encrypt($row['fromid']));?>"><?php echo ucwords($row['name']) . ' (' . $row['count'] . ')';?></a></li>							
	<?php } ?>
		</ul>
	<?php } ?>
	<?php 
	$lothertable = strtolower($othertable);
	$query = "select DISTINCT `{$lothertable}id`, `name` from message, "  . $lothertable . " where message.fromid={$lothertable}.{$lothertable}id AND message.toid = {$userid} order by name";
	$result = mysql_query($query);						
	//echo $query;
	if (mysql_num_rows($result) > 0){ ?>
		<div style="margin-top:10px;margin-bottom:-10px;margin-left:15px">
			<strong><?php echo $othertable . 's';?> Dealing with you</strong>
		</div>							
	<ul>
		<?php 
		while($row = mysql_fetch_array($result)){
	?>
		<li><a <?php if(isset($otherid) && $otherid == $row[$lothertable . 'id']) echo 'class="leftlinks"'; ?> href="<?php echo URL . '/show-messages.php?token=' . urlencode($cipher->encrypt($row[$lothertable . 'id']));?>" ><?php echo ucwords($row['name']); ?></a></li>						
	<?php } ?>
	</ul>	
	<?php } ?>
</div>
