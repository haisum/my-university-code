<?
include("includes/session.php");// database connection details stored here
include("lefke/cleanGetPost.php");
include("includes/functions.php");
if(isset($_REQUEST['edit'], $_REQUEST['id'])){	
	update('faq', array('question' => $_REQUEST['question'], 'answer' => $_REQUEST['answer'], 'position' => intval($_REQUEST['position']), 'faqcategoryid' => intval($_REQUEST['faqCategory']) ), 'faqid', $_REQUEST['id']);
	header('Location: main-faq-listing.php?msg='.urlencode('Updated'));
}
if(isset($_REQUEST['add'])){	
	insert('faq', array('question' => $_REQUEST['question'], 'answer' => $_REQUEST['answer'], 'position' => intval($_REQUEST['position']), 'faqcategoryid' => intval($_REQUEST['faqCategory']), 'date' => date('Y-m-d H:i:s', time())));	
	header('Location: main-faq-listing.php?msg='.urlencode('Inserted'));
}

?>