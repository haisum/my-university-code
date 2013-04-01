<?
include("includes/session.php");// database connection details stored here
include("includes/secure.php");
include("lefke/cleanGetPost.php");
include("includes/functions.php");
$tbl_name ="review";
$limit = 20; 								//how many items to show per page

	/*
		Place code to connect to your DB here.
	*/

	// How many adjacent pages should be shown on each side?
	$adjacents = 3;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	
	/* Setup vars for query. */
	$targetpage = "main-review-listing.php"; 	//your file name  (the name of this file)
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	if(isset($_GET['supplierid'])){
		$sId =$_GET['supplierid'];
		$sql = "SELECT review.* FROM review where toid = $sId and `from` = 'Buyer' order by reviewid desc LIMIT $start, $limit";	
	}
	else if(isset($_GET['buyerid'])){
		$sId =$_GET['buyerid'];
		$sql = "SELECT review.* FROM review where toid = $sId and `from` = 'Supplier' order by reviewid desc LIMIT $start, $limit";	
	}
	else{	
		$sql = "SELECT review.* FROM review order by reviewid desc LIMIT $start, $limit";	
	}
	$result = mysql_query($sql);
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?page=$prev\">« previous</a>";
		else
			$pagination.= "<a class=\"disabled\">« previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<a href='#' class=\"active\">$counter</a>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<a class=\"active	\">$counter</a>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "<a>...</a>";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "<a>...</a>";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<a class=\"active\">$counter</a>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "<a>...</a>";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "<a>...</a>";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<a class=\"active\">$counter</a>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}

			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\">next »</a>";
		else
			$pagination.= "<a class=\"disabled\">next »</a>";
		$pagination.= "</div>\n";		
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
 
<!-- Website Title --> 
<title>HERTZ WEB ADMIN</title>

<!-- Meta data for SEO -->
<meta name="description" content=""/>
<meta name="keywords" content=""/>

<!-- Template stylesheet -->
<link rel="stylesheet" href="css/screen.css" type="text/css" media="all"/>
<link href="css/datepicker.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" href="css/tipsy.css" type="text/css" media="all"/>
<link rel="stylesheet" href="js/jwysiwyg/jquery.wysiwyg.css" type="text/css" media="all"/>
<link href="js/visualize/visualize.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.0.css" media="screen"/>
<style>
div.growlUI { margin-top:100px; background: url(images/check48.png) no-repeat 10px 10px }
div.growlUI h1, div.growlUI h2 {
	
	color: white; padding: 5px 5px 5px 75px; text-align: left;
	font-size:20px;
}
	
	</style>
<!--[if IE 7]>
	<link href="css/ie7.css" rel="stylesheet" type="text/css" media="all">
<![endif]-->

<!--[if IE]>
	<script type="text/javascript" src="js/excanvas.js"></script>
<![endif]-->

<!-- Jquery and plugins -->
<script type="text/javascript" src="js/validation.js"></script>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.img.preload.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.0.js"></script>
<script type="text/javascript" src="js/jwysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/hint.js"></script>
<script type="text/javascript" src="js/visualize/jquery.visualize.js"></script>
<script type="text/javascript" src="js/jquery.tipsy.js"></script>
<script type="text/javascript" src="js/browser.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/jblockui.js"></script>
<script type="text/javascript" src="js/weddingprice.js"></script>
<script>

function delete_(reviewid)
{
	var confirm_value = confirm('Are you sure you want to delete this review? This will delete all data about this review. This action is IR-REVERSIBLE.');
	
	if(confirm_value == true)
	{
		window.location.href ="delete.php?reviewid="+reviewid;
	}
}

</script>
<?
if(isset($_REQUEST['msg']))
{
	$msg = $_REQUEST['msg'];
?>
<script>
$(document).ready(function() {
       $.growlUI('Notification', 'Item <? echo $msg; ?> successfully!');
 });
</script>
<?
}
?>
</head>
<body>
	
	<!-- Begin control panel wrapper -->
	<div id="wrapper">
	
		<!-- Begin top bar -->
		<? include("includes/header.php"); ?>
		<!--End top bar -->
		
		<!-- Begin main menu -->
		<?
		include("includes/menu.php");
		?>
		<!-- End main menu -->
		
		
		<!-- Begin shortcut menu -->
    <?
		include("includes/shortcut.php");
		?>
		<!-- End shortcut menu -->
		
		<br class="clear"/>
		
		<!-- Begin content -->
		<div id="content_wrapper">
		
			<!-- Begin one column box --><ul class="first_level_tab">
				<li>
<a href="" class="active">
						Manage Reviews</a>
				</li>
				<li></li>
				<li></li>
			</ul>
            <br class="clear" />
          <div class="onecolumn">
				
		    <div class="header">
					<div class="description"></div>
					
					<!-- Begin 2nd level tab --> 
                    
<!-- End 2nd level tab --></div>
				
				<div class="content nomargin">
					
					<!-- Begin example table data -->
<table class="global" width="100%" cellpadding="0" cellspacing="0">
						<thead>
						    <tr>
							  <th width="40">Content</th>	
					    	  <th width="40">Date</th>
							  <th width="20">Rating</th>
                              <th width="40">Action</th>
						    </tr>
						</thead>
						<tbody>
<?
while($row = mysql_fetch_array($result))
{
$temp = explode('(#)', $row['title']);
$bride = $temp[1];
$groom = $temp[0];

?>
						    <tr>
							  <th width="40"><?=trimlong($row['content'], 60)?></th>
							  <th width="40"><?=date('d-m-Y', strtotime($row['date']))?></th>	
							  <th width="40"><?=select(getRatings(), $row['rating'], 'rating', 'rating' . $row['reviewid'], '', 
							  ' onchange="ajaxUpdate(\'review\', \'rating\', $(\'#rating' . $row['reviewid'] .
							  '>option:selected\').val(), \'reviewid\', \'' . $row['reviewid'] . '\')"')?></th>  							  	
							  
							  <td width="40">
									<a href="add-edit-review.php?reviewid=<?=$row['reviewid']?>"><img src="images/icon_edit.png" alt="edit" class="help" title="Edit"/></a>
									&nbsp;&nbsp;
									<a href="javascript:void(0);"><img src="images/icon_delete.png" alt="Delete" class="help" title="Delete Row" onclick="delete_('<?=$row['reviewid']?>'); return false;" /></a>   									
							  </td>
						    </tr>
                <?
              }
                ?>
						</tbody>
					</table>
					<!-- End example table data -->
					
					
					<!-- Begin pagination -->
                    
                    <?=$pagination;?>

					<!-- End pagination -->
					
					<br class="clear"/>
				
			  </div>
				
			</div>

		</div>
		<!-- End content -->
		
		<br class="clear"/>
			
		<div id="footer">
			&copy; Copyright <?php echo date("Y"); ?> by HERTZ WEB ADMIN All Right Reserved.
		</div>
	
	</div>
	<!-- End control panel wrapper -->
	
</body>
</html>