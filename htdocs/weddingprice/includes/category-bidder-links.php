<?php 
$menuArray = array();
$query = 'select b.weddingcategoryid, b.bidid, b.amount, b.supplierid, s.name as suppliername from bid b, supplier s where b.supplierid = s.supplierid AND b.weddingid=%d AND b.categoryid=%d';
foreach($categoryList as $category){
	$newQuery = sprintf($query, $weddingId, $category->categoryId );
	$result = mysql_query($newQuery);
	$bidArray = array();
	while($row = mysql_fetch_array($result)){
		$bidArray[] = array(
			'bidPerCategoryId'  => $row['bidpercategoryid'],
			'bidId' => $row['bidid'],
			'amount' => $row['amount'],
			'supplierId' => $row['supplierid'],
			'supplierName' => is_null($row['suppliername']) || trim($row['suppliername']) == '' ? 'Anonymous Supplier' : ucfirst($row['suppliername'])
		);
	}
	$menuArray[] = array(
		'categoryName' => ucfirst($category->name),
		'categoryId' => $category->categoryId,
		'bid' => $bidArray
	);
}
?>
<div class="aside">
	<h2><strong><font color="#333333">Bidding Details</font></strong></h2>
	<ul>
		<li><a id='summaryLink' href="javascript:showSummary();<?php// echo URL/bid-details.php;?>" class='leftMenuLink leftlinks'>Summary</a></li> 
	</ul>	
    <ul> 
		<?php foreach($menuArray as $menuItem){
			$count = count($menuItem['bid']);
			if($count == 0){
		?>
			<li>
				<a href="javascript:;" class='leftMenuLink' title='No bids on this category yet'><?php echo $menuItem['categoryName'];?></a>
			</li>  
		<?php 
			}
			else{		
		?>
			<li id='category<?php echo $menuItem['categoryId'];?>'><a href="javascript:showSuppliers(<?php echo $menuItem['categoryId'];?>);" class='leftMenuLink' title='<?php echo $count; ?> bid(s) on this category upto now'><?php echo $menuItem['categoryName'];?> (<?php echo $count; ?>)</a></li>  
			<li>
			<ul id='suppliers<?php echo $menuItem['categoryId'];?>' class='suppliers' style='display:none;' >
				<?php foreach($menuItem['bid'] as $bid){ ?>
				<li><a href='javascript:showSupplierBids("<?php echo $bid['supplierId']; ?>", "<?php echo $bid['bidId']; ?>", "<?php echo $weddingId; ?>", "<?php echo $menuItem['categoryId'];?>")' title='<?php echo $bid['supplierName']; ?> will complete your work in $<?php echo $bid['amount']; ?>!' id='supplier<?php echo $bid['supplierId'] . 'c' . $menuItem['categoryId']; ?>' class='supplierLink'><?php echo $bid['supplierName'];?> ($<?php echo $bid['amount'];?>)</a></li>
				<?php } ?>
			</ul>
		<?php } ?>
		</li>
		<?php } ?>
	</ul>
</div>