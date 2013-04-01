<div id='left'>
			<ul>
				<li>
					<a href='<?php echo URL; ?>index.php'>Home</a>
				</li>
				<li>
					<a href='<?php echo URL; ?>admin'>Admin Panel</a>
				</li>	
				<?php if(isset($_SESSION['admin']) && isset($admin)) { ?>
				<li>
					<a href='categories.php'>Categories</a>
				</li>
				<li>
					<a href='edit-category.php'>Add Category</a>
				</li>	
				<li>
					<a href='products.php'>Products</a>
				</li>
				<li>
					<a href='edit-product.php'>Add Product</a>
				</li>	
				<li>
					<a href='orders.php'>Orders</a>
				</li>
				<?php } ?>
			</ul>
			<strong>Categories</strong><br/>
			<ul>
				<?php $result = mysql_query('select * from category');
					while($row = mysql_fetch_array($result)){
				?>
				<li>
					<a href='index.php?category=<?php echo $row['categoryid']; ?>'><?php echo $row['categoryname']; ?></a>
				</li>
				<?php } ?>
			</ul>
		</div>