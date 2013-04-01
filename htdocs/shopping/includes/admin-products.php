<div id='center'>
			<table>
				<thead>
					<tr>
						<th>Product Name</th>
						<th>Price</th>
						<th>Category</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php $result = mysql_query('select product.*, category.categoryname from product, category where product.categoryid = category.categoryid');
						while($row = mysql_fetch_array($result)){
					?>
					<tr>
						<td><?php echo $row['productname']; ?></td>
						<td><?php echo $row['price']; ?></td>
						<td><?php echo $row['categoryname']; ?></td>
						<td>
							<a href='edit-product.php?edit=<?php echo $row['productid']; ?>'>Edit</a> | 
							<a href='products.php?delete=<?php echo $row['productid']; ?>'>Delete</a>
						</td>
					</tr>			
					<?php } ?>
				</tbody>
			</table>
		</div>
		