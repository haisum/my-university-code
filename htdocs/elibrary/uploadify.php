<?php
mysql_connect("localhost", "codefreak", "letmein");
mysql_select_db("elibrary");
$type_id = 0;
function getExtension($name){
    $name = str_getcsv($name , ".");
    return  $name[count($name)-1];
}
function checkExtension($ext){
    global $type_id;
    $ext = strtolower($ext);
    $valid = false;
    $query = mysql_query("SELECT * FROM book_types");
    while(($row = mysql_fetch_object($query))!= null){
        if(strtolower($row->type_name) == $ext){
            $type_id = $row->type_id;
            $valid = true;
        }
    }
    return $valid;
}

if (!empty($_FILES)) {

	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
	$targetFile =  str_replace('//','/',$targetPath) . str_replace(' ','',$_FILES['Filedata']['name']);
        if(checkExtension(getExtension($_FILES['Filedata']['name'])))
        {
            mysql_query("INSERT INTO books(book_title,book_author, book_isbn, book_publisher_id, book_category_id , book_uploader_id, book_size, book_path , book_date_inserted, book_type_id)
                        values('" . mysql_real_escape_string($_REQUEST['book_title']) .
                                "' , '" . mysql_real_escape_string($_REQUEST['book_author']) .
                                "' , '" . mysql_real_escape_string($_REQUEST['book_isbn']) .
                                "' , " . mysql_real_escape_string($_REQUEST['publisher_id']) .
                                " , " . mysql_real_escape_string($_REQUEST['category_id']) .
                                " , " .mysql_real_escape_string($_REQUEST['user_id']).
                                " , " . mysql_real_escape_string($_FILES['Filedata']['size']) .
                                " , '" . mysql_real_escape_string(str_replace(' ','',$_FILES['Filedata']['name'])) .
                                "' ,' " . strftime("%Y-%m-%d %H:%M:%S", time()) .
                                "' ," . mysql_real_escape_string($type_id) .
                                " );");
	// $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	// $fileTypes  = str_replace(';','|',$fileTypes);
	// $typesArray = split('\|',$fileTypes);
	// $fileParts  = pathinfo($_FILES['Filedata']['name']);

	// if (in_array($fileParts['extension'],$typesArray)) {
		// Uncomment the following line if you want to make the directory if it doesn't exist
		//mkdir(str_replace('//','/',$targetPath), 0755, true);
                if(mysql_errno() == 0)
               {
		move_uploaded_file($tempFile,$targetFile);
                echo "File successfully uploaded";
               }
               else {
                    echo mysql_error();
               }
	// } else {
	// 	echo 'Invalid file type.';
	// }
               // print_r($_FILES['Filedata']);
                 
               // print_r($_REQUEST);
         }
         else {
             echo "This type of file is not allowed";
         }

    }
?>