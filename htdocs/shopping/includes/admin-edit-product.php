<?php  
 require_once('../includes/functions.php'); 
?>
<div id='center'>
	<form action='edit-product.php' method='post'>
			<table>
				<tbody>
					<tr>
						<td><label for='prodname'>Product Name</label></td>
						<td><input type='text' class='input' value='<?php if(isset($_GET['edit'])) 
						{
							echo getOne('productname', 'product', 'productid = ' . $_GET['edit']); 
						} ?>' id='prodname' name='prodname'/></td>
					</tr>										
					<tr>
						<td><label for='price'>Price</label></td>
						<td><input type='text' class='input' value='<?php if(isset($_GET['edit'])) 
						{
							echo getOne('price', 'product', 'productid = ' . $_GET['edit']); 
						} ?>' id='price' name='price'/></td>
					</tr>										
					<tr>
						<td><label for='category'>Category</label></td>
						<td>
							<?php 
							$data = array();
							$result = mysql_query('select * from category');
							while($row = mysql_fetch_array($result)){
								$data[$row[0]] = $row[1];
							}
							$selectedValue = 0;
							if(isset($_GET['edit'])){
								$selectedValue = getOne('categoryid', 'product', 'productid = ' . $_GET['edit']);
							}
							echo select($data, $selectedValue , 'categoryid', 'category', 'input'); 
						 ?>
						</td>
					</tr>										
					<tr>
						<td colspan='2' style='text-align:right;padding-right:40px;'>
							<input type='submit' value='<?php if(isset($_GET['edit'])) echo 'Update'; else echo 'Add'; ?>' class='button'/>
							<?php if(isset($_GET['edit'])){ ?>
								<input type='hidden' value='<?php echo $_GET['edit']; ?>' name='editid' />
							<?php } ?>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>