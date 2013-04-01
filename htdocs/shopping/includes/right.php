
		<div id='right' style='<?php if(isset($admin)) echo "height:30px;background-color:#fff;border:none;";?>'>
			<?php if(!isset($_SESSION['admin'], $admin)){ ?>
			<p style='margin-top:10px;margin-left:10px;'><strong>Total Products in cart:</strong><?php if(!isset($_SESSION['total_products'])) echo 0; else echo $_SESSION['total_products']; ?><br/><br/></p>
			<form action='index.php'>
				<a href='checkout.php' style='text-decoration:none;color:#000;margin-left:10px;padding-left:5px;padding-right:5px;' class='button'>Checkout</a>
				<input type='submit' class='button' name='clearcart' value='Clear Cart'/>
			</form>
			<?php } else{ ?>
				<a style='margin-left:10px;margin-top:20px;clear:both;' href='logout.php'>Logout from admin</a>
			<?php } ?>
			
		</div>
	