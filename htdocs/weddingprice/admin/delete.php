<?php
include("includes/session.php");
include("lefke/cleanGetPost.php");
include("includes/secure.php");
include("includes/functions.php");
//for supplier
if(isset($_GET['supplierid'] , $_GET['userid'])){
	delete('user', 'userid', intval($_GET['userid']));
	delete('supplier', 'supplierid', intval($_GET['supplierid']));
	delete('website', 'supplierid', intval($_GET['supplierid']));
	delete('bid', 'supplierid', intval($_GET['supplierid']));
	delete('regionsuppliermap', 'supplierid', intval($_GET['supplierid']));
	delete('regionsuppliermap', 'supplierid', intval($_GET['supplierid']));
	header('Location: ' . 'main-supplier-listing.php' . '?msg=deleted');
}
//for buyer
else if(isset($_GET['buyerid'] , $_GET['userid'])){
	delete('user', 'userid', intval($_GET['userid']));
	delete('buyer', 'buyerid', intval($_GET['buyerid']));
	mysql_query('delete from weddingregion where weddingid IN(select weddingid from wedding where buyerid =' . $_GET['buyerid'] . ')');
	delete('wedding', 'buyerid', intval($_GET['buyerid']));
	header('Location: ' . 'main-buyer-listing.php' . '?msg=deleted');
}
//for categories
else if(isset($_GET['categoryid'])){
	delete('category', 'categoryid', $_GET['categoryid']);
	delete('categorysuppliermap', 'categoryid', $_GET['categoryid']);
	mysql_query('delete from bid where weddingcategoryid IN(select weddingcategoryid from weddingcategory where categoryid =' .  $_GET['categoryid'] . ' )');
	delete('weddingcategory', 'categoryid', $_GET['categoryid']);
	header('Location: ' . 'main-category-listing.php' . '?msg=deleted');
}
//for regions
else if(isset($_GET['regionid'])){
	delete('region', 'regionid', $_GET['regionid']);
	delete('regionsuppliermap', 'regionid', $_GET['regionid']);
	header('Location: ' . 'main-region-listing.php' . '?msg=deleted');
}
//for faqs
else if(isset($_GET['faqid'])){
	delete('faq', 'faqid', $_GET['faqid']);
	header('Location: ' . 'main-faq-listing.php' . '?msg=deleted');
}

//for faq categories
else if(isset($_GET['faqcategoryid'])){
	delete('faq', 'faqcategoryid', $_GET['faqcategoryid']);
	delete('faqcategory', 'faqcategoryid', $_GET['faqcategoryid']);
	header('Location: ' . 'main-faqcategory-listing.php' . '?msg=deleted');
}
//for weddings
else if(isset($_GET['weddingid'])){
	delete('wedding', 'weddingid', $_GET['weddingid']);
	delete('bid', 'weddingid', $_GET['weddingid']);
	delete('message', 'weddingid', $_GET['weddingid']);	
	header('Location: ' . 'main-wedding-listing.php' . '?msg=deleted');
}
//for bids
else if(isset($_GET['bidid'])){
	delete('bid', 'bidid', $_GET['bidid']);
	header('Location: ' . 'main-bid-listing.php' . '?msg=deleted');
}
else if(isset($_GET['weddingcategoryid'])){
	delete('weddingcategory', 'weddingcategoryid', $_GET['weddingcategoryid']);
	header('Location: ' . 'main-weddingcategory-listing.php' . '?msg=deleted');
}
else if(isset($_GET['reviewid'])){
	delete('review', 'reviewid', $_GET['reviewid']);
	header('Location: ' . 'main-review-listing.php' . '?msg=deleted');
}
else if(isset($_GET['messageid'])){
	delete('message', 'messageid', $_GET['messageid']);
	header('Location: ' . 'main-message-listing.php' . '?msg=deleted');
}
else if(isset($_GET['specialofferid'])){
	delete('specialoffer', 'specialofferid', $_GET['specialofferid']);
	header('Location: ' . 'main-specialoffer-listing.php' . '?msg=deleted');
}
?>