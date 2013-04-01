 <?php
	require_once '../config/config.php';
	require_once '../includes/secureLogin.php';
	require_once '../includes/securePasswordChange.php';
	require_once '../includes/secureBuyer.php';
	require_once '../classes/database/objects/class.database.php';
	require_once '../classes/database/objects/class.weddingcategory.php';
	require_once '../classes/database/objects/class.category.php';
	require_once '../classes/database/objects/class.wedding.php';
	//echo "hello" . $_POST['id'] . $_POST['categories'];
	if(is_nan($_POST['id'])){
		die('No data');
	}
	$obj = new WeddingCategory();
	$id = $_POST['id'];
	
	$currentCats = array();
	$list = $obj->GetList(array(array(
		'weddingid', '=' , $id
	)));
	?>
	<div id='tabs'>
		<ul>
		<?php foreach($list as $item){ ?>
			<li><a style='outline:none;' href='#tabs-<?php echo $item->categoryId; ?>'><?php $c = new Category(); $c->Get($item->categoryId); echo ucfirst($c->name); ?></a></li>	
		<?php } ?>
		</ul>	
		<?php 
		foreach($list as $category){
		?>
		<div class='tabs' id='tabs-<?php echo $category->categoryId; ?>'>
			<div class='input-container'>
				<label class='columnName'>Budget</label> 
				<label>From&nbsp;$</label><input id='cbudgetFrom<?php echo $category->weddingcategoryId; ?>' style='width:60px;' class='text numberOnly' type='text' id='' value='<?php echo $category->budgetFrom; ?>' /> 
				<label>to&nbsp;$</label>
				<input id='cbudgetTo<?php echo $category->weddingcategoryId; ?>' style='width:60px;' class='text numberOnly' type='text' id='' value='<?php echo $category->budgetTo; ?>' />
			</div>
			<div class='input-container'>
				<label class='columnName'>Detail</label>
				<textarea id='cdetail<?php echo $category->weddingcategoryId; ?>' class='text'><?php echo $category->detail; ?></textarea>
			</div>			
			<div class='input-container'>
				<label style='margin-right:10px;' class='columnName'>Picture</label>
				<input style='margin-left:10px;' class='uploadifyCats' rel='<?php  echo $category->weddingcategoryId; ?>' id='<?php  echo $category->weddingcategoryId; ?>' type='file'/>
				<img style='clear:both;margin-top:10px;' id='img<?php echo $category->weddingcategoryId; ?>' src='<?php if(file_exists(ABSOLUTE_PATH . '/img/weddingcats/' . $category->weddingcategoryId . '.jpg')) echo URL . '/img/weddingcats/' . $category->weddingcategoryId . '.jpg'; else echo URL . '/img/weddingcats/-1.jpg'; ?>' alt='picture'/>
			</div>
			<div class='input-container'>
				<button rel='<?php echo $category->weddingcategoryId; ?>' class='saveButton'>Save</button>
			</div>
		</div>
		<?php } ?>
		
	</div>