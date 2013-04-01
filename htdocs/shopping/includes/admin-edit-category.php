<div id='center'>
	<form action='edit-category.php' method='post'>
			<table>
				<tbody>
					<tr>
						<td><label for='catname'>Category Name</label></td>
						<td><input type='text' class='input' value='<?php if(isset($_GET['edit'])) 
						{
							require_once('../includes/functions.php');
							echo getOne('categoryname', 'category', 'categoryid = ' . $_GET['edit']); 
						} ?>' id='catname' name='catname'/>
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