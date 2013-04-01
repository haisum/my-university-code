<div id='center'>
			<table>
				<thead>
					<tr>
						<th>Product</th>
						<th>Price</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$where = '';
						if(isset($_GET['category'])){
							$where = ' where categoryid= ' . intval($_GET['category']);
						}
						$result = mysql_query('select * from product ' . $where);
						while($row = mysql_fetch_array($result)){							
					?>
					<tr>
						<td><?php echo $row['productname'] ?></td>
						<td><?php echo $row['price'] ?></td>
						<td>
							<a href='index.php?addtocart=<?php echo $row['productid'] ?>'>Add to Cart</a>
						</td>
					</tr>			
					<?php } ?>
				</tbody>
			</table>
		</div>