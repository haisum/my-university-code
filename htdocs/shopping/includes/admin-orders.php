<div id='center'>
		<?php $result = mysql_query('select * from `order` order by orderid desc');
			while($row = mysql_fetch_array($result)){
		?>
			<table>
				<tbody>	
					<tr>
						<td>Customer name:</td>
						<td><?php echo $row['customername']; ?></td>
					</tr>	
					<tr>
						<td>Address:</td>
						<td><?php echo $row['address']; ?></td>
					</tr>										
					<tr>
						<td>Credit Card Type:</td>
						<td><?php echo $row['cardtype']; ?></td>
					</tr>					
					<tr>
						<td>Credit Card Number:</td>
						<td><?php echo $row['cardnumber']; ?></td>
					</tr>					
					<tr>
						<td>Order date:</td>
						<td><?php echo date('d/m/Y', $row['date']); ?></td>
					</tr>						
					<tr>
						<td>Total Items:</td>
						<td><?php echo $row['totalitems']; ?></td>
					</tr>	
					<tr>
						<td colspan='2'>Products</td>
					</tr>	
					<tr>
						<td colspan='2'>
							<table>
								<thead>
									<tr>
										<th>Name</th>
										<th>Quantity</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$result2 = mysql_query('select * from orderproduct where orderid=' . $row['orderid']);
										while($row2 = mysql_fetch_array($result2)){
									?>
									<tr>
										<td><?php echo getOne('productname', 'product', 'productid = ' . $row2['productid']); ?></td>
										<td><?php echo $row2['quantity']; ?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>			
			<br/>
			<?php } ?>	
	</div>