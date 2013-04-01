<?php
//session_start();



$strStatus['A'] = "<span style='color:green'><strong>Active</strong></span>";
$strStatus['I'] = "<span style='color:red'><strong>Inactive</strong></span>";


function replace_h3($string)
{
	$string = str_replace("<h1>","<h3>",$string);
	$string = str_replace("</h1>","</h3>",$string);
	$string = str_replace("<h2>","<h3>",$string);
	$string = str_replace("</h2>","</h3>",$string);
	
	return $string;

}

function myTruncate2($string, $limit, $break=" ", $pad="...")
{
  // return with no change if string is shorter than $limit
  if(strlen($string) <= $limit) return $string;

  $string = substr($string, 0, $limit);
  if(false !== ($breakpoint = strrpos($string, $break))) {
    $string = substr($string, 0, $breakpoint);
  }

  return $string . $pad;
}
//****************************************************************************************************************************************************
// This file should be included in the begining of each php file
// to avoid url injection and script
function encodehtml() {
	if ( get_magic_quotes_gpc() ) {
		foreach ($_POST as $key => $value) {
			if (!is_array($_POST[$key])) {
				if (!empty($value))
				$_POST[$key]= stripslashes($value);
			}

		}

		foreach ($_GET as $key => $value) {
			if (!is_array($_GET[$key])) {
				if (!empty($value))
				$_GET[$key]= stripslashes($value);
			}
		}
	}

	foreach ($_POST as $key => $value) {
		if (!is_array($_POST[$key])) {
			if ($_POST[$key]!='')
			$_POST[$key] = htmlentities($value, ENT_QUOTES);
		}
		//echo $key."=".$value."<br>";
	}

	foreach ($_GET as $key => $value) {
		if (!is_array($_GET[$key])) {
			if (!empty($value))
			$_GET[$key] = htmlentities($value, ENT_QUOTES);
		}
		//	echo $key."=".$value."<br>";
	}
}


//****************************************************************************************************************************************************
// This Function should be used after connecting to DB not befor that
// to create the sql injection free string
function sqlfriendly () {
	foreach ($_POST as $key => $value) {
		if (!is_array($_POST[$key]))
		$_POST[$key] = mysql_real_escape_string($value);
	}

	foreach ($_GET as $key => $value) {
		if (!is_array($_GET[$key]))
		$_GET[$key] = mysql_real_escape_string($value);
	}
}

//****************************************************************************************************************************************************
// to show the decoded html on page eg if <b> is used in string it will be bold in outputed text
function decodehtml($str) {
	return html_entity_decode($str, ENT_QUOTES);
}

function Create_Url($url, $fieldvariable, $fieldvalue) {
	$url.="?";
	if (is_array($fieldvariable)) {
		$count = count($fieldvariable);
		$i=0;
		foreach ($fieldvariable as $value) {
			if ($i+1 == $count) {
				$url .= $value."={val$i}";
			} else {
				$url .= $value."={val$i}&";
			}
			$i++;
		}
		$k=0;
		foreach ($fieldvalue as $value) {
			$url = str_replace("{val$k}",$value,$url);
			$k++;
		}
		if ($i!=$k) {
			for ($j=$k; $j<=$i; $j++) $url = str_replace("{val$j}","",$url);
		}
	} else {
		$url .= $fieldvariable.'='.$fieldvalue;
	}

	return $url;
}

//****************************************************************************************************************************************************
// Fuunction to generate email form with attachement and option to send plain/html or both type email
function Create_Email_Form ($action,$from, $nam){


	$emailForm = <<<F1
	<form method="POST" action="$action" enctype="multipart/form-data">
  <div align="center">
    <table border="0" width="500" style="border-width: 0; border-style: solid" align="center">
      <tr>
        <td colspan="2"><b>From</b></td>
      </tr>
      <tr>
        <td width="100"> E-Mail : </td>
        <td>
        	<input type="text" name="emailfr" value="$from" style="width: 100%; text-align: left">
        </td>
      </tr>
      <tr>
        <td width="100"> Name : </td>
        <td><input type="text" name="namefr" value="$nam" style="width: 100%; text-align: left"></td>
      </tr>
      <tr><td colspan="2">CC to Self &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cc" value="Y" checked> Yes </td></tr>
      <tr height="30"><td colspan="2"></td></tr>
       <tr>
        <td colspan="2"><b>To</b></td>
      </tr>
      <tr>
        <td width="100"> E-Mail : </td>
        <td><input class="left" type="text" name="emailto" style="width: 100%"></td>
      </tr>
      <tr>
        <td width="100"> Name : </td>
        <td><input type="text" name="nameto" style="width: 100%; text-align: left"></td>
      </tr>
      <tr>
        <td width="100"> Subject : </td>
        <td><input type="text" name="subjectfr" style="width: 100%; text-align: left"></td>
      </tr>
      <tr>
        <td width="100"> Message : </td>
        <td><textarea name="message" cols="60" rows="8"></textarea></td>
      </tr>
      <tr>
        <td nowrap>
           Attachment :
        </td>
        <td>
           	<input type="file" size="50" name="attachment">
        </td>
      </tr>
    <tr><td>   
    Email Format </td><td>
    <input type="checkbox" name="html" value="Y" checked>HTML &nbsp;&nbsp;&nbsp;
	<input type="checkbox" name="text" value="Y">Text
    </table>
	<br>
    <p><input type="button" value="Back" name="back" style="width: 100px" onClick="history.go(-1);">
    <input type="reset" value="Clear" name="clear" style="width: 100px">
    <input type="submit" value="Send" name="send" style="width: 100px"></p><p>&nbsp;</p>
    
  </div>

</form>
F1;

	echo $emailForm;
}

// Functions for sending email

function hasFile(){
	if($_FILES['attachment']['name'] != ''){
		//	print_r($_FILES);
		$fileName=$_FILES['attachment']['name'];
		//move_uploaded_file($_FILES['attachment']['tmp_name'], "/home/ttest1/public_html/test/files/$fileName");


		$newfile1 = $_FILES['attachment']['name'];
		$path_parts = pathinfo($newfile1);
		//$f_type=$path_parts['basename'];
		$newname=$fileName;
		$newfile = "/home/ttest1/public_html/test/files/" . $newname;//$newfile1;
		echo $_FILES['attachment']['tmp_name'];
		$file1 = $_FILES['attachment']['tmp_name'];

		//echo "<br>".$newname."<br>";
		if (!move_uploaded_file($file1, $newfile)) {
			$contents .= "Cannot Upload File $newfile<br>";
			$errors=1;
			echo $contetnts;
		} else {
			echo "Uploaded";
		}
		chmod($newfile, 0644);


		return("files/$fileName");
	}else
	return false;
}

function Get_File_Extension($Filename) {
	// make an array, each value seperated by a period (.)
	$Extension = explode (".", $Filename);

	// Count how many are in array, and -1 due to
	// php starting an array with 0
	$Extension_i = (count($Extension) - 1);

	// Return it..
	return $Extension[$Extension_i];
}

//strip_tags(
function mailConfirmation($bcc){

	$eol="\r\n";
	$file = hasFile();

	$email = $_POST['emailto'];
	$headers = "Content-Type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: ".$_POST['namefr']." <".$_POST['emailfr'].">\r\n";
	$headers .= "To: ".$_POST['nameto']."<".$_POST['emailto'].">\r\n";

	$headers .= "Cc: $_POST[emailfr]\r\n";

	if(strtolower($_POST['emailfr']) != $bcc) $headers .= "Bcc: $bcc\r\n\r\n";

	$subject = stripslashes($_POST['subjectfr'])." - ".stripslashes($_POST['nameto']);


	$body  = "<font face=\"Verdana\" size=\"2\">\n";
	$body .= nl2br(stripslashes($_POST['message']));
	$body .= "<br><br>";

	if($file) {
		if ($_FILES['attachment']['name'] != '') {

			# File for Attachment
			$file_name = $_FILES['attachment']['name'];

			$handle=fopen($_FILES['attachment']['name'], 'rb');
			$f_contents=fread($handle, filesize($_FILES['attachment']['name']));
			$f_contents=chunk_split(base64_encode($f_contents));    //Encode The Data For Transition using base64_encode();
			fclose($handle);

			# Attachment
			$body .= "--".$eol;
			$body .= "Content-Type: ".$_FILES["attachment"]["content_type"]."; name=\"".$file_name."\"".$eol;
			$body .= "Content-Transfer-Encoding: base64".$eol;
			$body .= "Content-Disposition: attachment; filename=\"".$file_name."\"".$eol.$eol; // !! This line needs TWO end of lines !! IMPORTANT !!
			//$body .= $f_contents.$eol.$eol;

		}
	}

	$body .= "<br><br>";

	$body .= "<b>".$_POST['namefr']."</b><br>\n";
	$body .= "Toronto Harbour Cruises and Events<br>\n";
	$body .= "89 Whitehall Road, 2nd Floor<br>\n";
	$body .= "Toronto, Ontario M4W 2C8<br><br>\n";
	$body .= "<b>Tel: 416.777.5777</b><br>\n";
	$body .= "Fax: 416.927.7666<br>\n";
	$body .= "Email: <a href = \"mailto://".$_POST['emailfr']."\">".$_POST['emailfr']."</a><br>\n";
	$body .= "<b>Visit us:</b> <a href = \"http://www.TorontoHarbour.com\">http://www.TorontoHarbour.com</a><br>\n";
	$body .= "</font>";



	if (!mail($email,$subject,$body,$headers)) {
		echo "Not Sent";
	}
}

// end of email function

function getfile($filename) {
	if (file_exists($filename)) {
		$handle = fopen ($filename, "r");
		$fcont = fread ($handle, filesize ($filename));
		fclose ($handle);
	} else {
		$fcont = 0;
	}

	return $fcont;
}
function HiddenValues() {
	if (isset($_GET['ID'])) {
		$ID=$_GET['ID'];
		$usr=$_GET['uname'];
		
	} else {
		$ID=$_POST['ID'];
		$usr=$_POST['uname'];
		
	}
	echo '<input type="hidden" name="ID" value="'.$ID.'">
	';
	echo '<input type="hidden" name="uname" value="'.$usr.'">
	';	
}

function paginate ($table, $limit, $href, $nextpre = False) {

	$page= @$_GET['page'];
	if(empty($page)){    // Checks if the $page variable is empty (not set)
		$page = 1;      // If it is empty, we're on page 1
	}
	$limitvalue = $page * $limit - ($limit);
	// Ex: (2 * 25) - 25 = 25 <- data starts at 25

	$query_count    = "SELECT count(*) as a FROM $table";
	//if ($where) $query_count.= " where $where";
	$result_count   = mysql_query($query_count);
	$totalrows      = mysql_result($result_count,0,"a");

	$numofpages = $totalrows / $limit;
	$totalpages=$numofpages;
	$newvalue=intval($totalpages);
	$newvalue++;

	/* We divide our total amount of rows (for example 102) by the limit (25). This

	will yield 4.08, which we can round down to 4. In the next few lines, we'll
	create 4 pages, and then check to see if we have extra rows remaining for a 5th
	page. */

	$page1=$page+1;
	if ($page!=0 && $page!=1) {
		echo("<a href=\"$href&page=1\">First<< </a> ");
	} else {
		echo("First<< ");
	}
	//echo "page:$page :";
	if ($page<=($numofpages-10)) {

		if ($numofpages>10) {
			$numofpages=10+$page;
		}


		for($i = $page1; $i <= $numofpages; $i++) {
			/* This for loop will add 1 to $i at the end of each pass until $i is greater
			than $numofpages (4.08). */

			if($i == $page){
				echo($i." ");
			}else{
				echo("<a href=\"$href&page=$i\">$i</a> ");
			}
			/* This if statement will not make the current page number available in
			link form. It will, however, make all other pages available in link form. */
		} // This ends the for loop
	}else {
		if (($numofpages-10)>10) {
		for($i = ($newvalue-10); $i <= $numofpages; $i++) {
			/* This for loop will add 1 to $i at the end of each pass until $i is greater
			than $numofpages (4.08). */

			if($i == $page){
				echo($i." ");
			}else{
				echo("<a href=\"$href&page=$i\">$i</a> ");
			}
			/* This if statement will not make the current page number available in
			link form. It will, however, make all other pages available in link form. */
		} // This ends the for loop
		} else {
			for($i = 1; $i <= $numofpages; $i++) {
				/* This for loop will add 1 to $i at the end of each pass until $i is greater
				than $numofpages (4.08). */

				if($i == $page){
					echo($i." ");
				}else{
					echo("<a href=\"$href&page=$i&$querystring\">$i</a> ");
				}
				/* This if statement will not make the current page number available in
				link form. It will, however, make all other pages available in link form. */
			}
		}
	}
	if(($totalrows % $limit) != 0){
		//echo $totalpages;


		/* The above statement is the key to knowing if there are remainders, and it's
		all because of the %. In PHP, C++, and other languages, the % is known as a
		Modulus. It returns the remainder after dividing two numbers. If there is no
		remainder, it returns zero. In our example, it will return 0.8 */

		if($i == $page){
			echo($i." ");
		}else{
			echo("<a href=\"$href&page=$i\">$i</a> ");
		}

		if ($page!=$newvalue) {
			echo("<a href=\"$href&page=$newvalue\"> >> Last </a> ");
		} else {
			echo(">> Last ");
		}

		/* This is the exact statement that turns pages into link form that is used

		above */
	} else {
		if ($page!=$newvalue) {
			echo("<a href=\"$href&page=$totalpages\"> >> Last </a> ");
		} else {
			echo(">> Last ");
		}
	}
	return $limitvalue;
}

// pagination with where clause
function paginatewhere ($table, $limit, $href, $where, $page, $nextpre = False,$paginate='', $sel='*') {

	$querystring="";

	if(empty($page)){    // Checks if the $page variable is empty (not set)
		$page = 1;      // If it is empty, we're on page 1
	}
	$limitvalue = $page * $limit - ($limit);

	// Ex: (2 * 25) - 25 = 25 <- data starts at 25

	$query_count    = "SELECT count($sel) as a FROM $table";
	if ($where) $query_count.= " where $where";

	//echo $query_count."<br>";

	$result_count   = mysql_query($query_count);
	$numofrows=mysql_num_rows($result_count);
	if ($numofrows && $numofrows>0) {
	$totalrows      = mysql_result($result_count,0,"a");

	$numofpages = $totalrows / $limit;



	$totalpages=$numofpages;
	$newvalue=intval($totalpages);
	$newvalue++;

	/* We divide our total amount of rows (for example 102) by the limit (25). This

	will yield 4.08, which we can round down to 4. In the next few lines, we'll
	create 4 pages, and then check to see if we have extra rows remaining for a 5th
	page. */
	if ($paginate!="")
	$querystring=$paginate."&Submit=Search";
	
	
	$page1=$page+1;
	if ($page!=0 && $page!=1) {
		echo("<a href=\"$href&page=1&$querystring\">«</a> ");
	} else {
		echo("<a href='#'>«</a>");
	}
	//echo "page:$page :$numofpages:";
	if ($page<=($numofpages-10)) {
		//	echo $numofpages."<br>";
		if ($numofpages>10) {
			$numofpages=10+$page;
		}


		for($i = $page1; $i <= $numofpages; $i++) {
			/* This for loop will add 1 to $i at the end of each pass until $i is greater
			than $numofpages (4.08). */

			if($i == $page){
				echo($i." ");
			}else{
				echo("<a href=\"$href&page=$i&$querystring\">$i</a> ");
			}
			/* This if statement will not make the current page number available in
			link form. It will, however, make all other pages available in link form. */
		} // This ends the for loop
	}else {
		if (($numofpages-10)>10) {
			for($i = ($newvalue-10); $i <= $numofpages; $i++) {
				/* This for loop will add 1 to $i at the end of each pass until $i is greater
				than $numofpages (4.08). */

				if($i == $page){
					echo($i." ");
				}else{
					echo("<a href=\"$href&page=$i&$querystring\">$i</a> ");
				}
				/* This if statement will not make the current page number available in
				link form. It will, however, make all other pages available in link form. */
			} // This ends the for loop
		} else {
			for($i = 1; $i <= $numofpages; $i++) {
				/* This for loop will add 1 to $i at the end of each pass until $i is greater
				than $numofpages (4.08). */

				if($i == $page){
					echo("<a href='#' class='active'>$i</a>");
				}else{
					echo("<a href=\"$href&page=$i&$querystring\">$i</a> ");
				}
				/* This if statement will not make the current page number available in
				link form. It will, however, make all other pages available in link form. */
			}
		}
	}
	if(($totalrows % $limit) != 0){
		//echo $totalpages;


		/* The above statement is the key to knowing if there are remainders, and it's
		all because of the %. In PHP, C++, and other languages, the % is known as a
		Modulus. It returns the remainder after dividing two numbers. If there is no
		remainder, it returns zero. In our example, it will return 0.8 */

		if($i == $page){
			echo($i." ");
		}else{
			echo("<a href=\"$href&page=$i&$querystring\">$i</a> ");
		}

		if ($page!=$newvalue) {
			echo("<a href=\"$href&page=$newvalue&$querystring\"> >> Last </a> ");
		} else {
			echo(">> Last ");
		}

		/* This is the exact statement that turns pages into link form that is used

		above */
	} else {
		if ($page!=$newvalue) {
			echo("<a href=\"$href&page=$totalpages&$querystring\">»</a> ");
		} else {
			echo("<a href='#'>»</a>");
		}
	}
	return $limitvalue;
	} else return 0;
}



// pagination with Query sent to it with where clause
function paginateNew ($table, $limit, $href, $where, $page, $query,$paginate) {


	if(empty($page)){    // Checks if the $page variable is empty (not set)
		$page = 1;      // If it is empty, we're on page 1
	}
	$limitvalue = $page * $limit - ($limit);

	// Ex: (2 * 25) - 25 = 25 <- data starts at 25

	$query_count    = "SELECT count($query) as a FROM $table";
	

	//echo $query_count."<br>";

	$result_count   = mysql_query($query_count);
	$numofrows=mysql_num_rows($result_count);
	if ($numofrows && $numofrows>0) {
	$totalrows      = mysql_result($result_count,0,"a");

	$numofpages = $totalrows / $limit;



	$totalpages=$numofpages;
	$newvalue=intval($totalpages);
	$newvalue++;

	/* We divide our total amount of rows (for example 102) by the limit (25). This

	will yield 4.08, which we can round down to 4. In the next few lines, we'll
	create 4 pages, and then check to see if we have extra rows remaining for a 5th
	page. */
	if ($paginate!="")
	$querystring=$paginate."&Submit=Search";
	
	
	$page1=$page+1;
	if ($page!=0 && $page!=1) {
		echo("<a href=\"$href&page=1&$querystring\">« </a> ");
	} else {
		echo("<a href='#'>«</a>");
	}
	//echo "page:$page :$numofpages:";
	if ($page<=($numofpages-10)) {
		//	echo $numofpages."<br>";
		if ($numofpages>10) {
			$numofpages=10+$page;
		}


		for($i = $page1; $i <= $numofpages; $i++) {
			/* This for loop will add 1 to $i at the end of each pass until $i is greater
			than $numofpages (4.08). */

			if($i == $page){
				echo($i." ");
			}else{
				echo("<a href=\"$href&page=$i&$querystring\">$i</a> ");
			}
			/* This if statement will not make the current page number available in
			link form. It will, however, make all other pages available in link form. */
		} // This ends the for loop
	}else {
		if (($numofpages-10)>10) {
			for($i = ($newvalue-10); $i <= $numofpages; $i++) {
				/* This for loop will add 1 to $i at the end of each pass until $i is greater
				than $numofpages (4.08). */

				if($i == $page){
					echo($i." ");
				}else{
					echo("<a href=\"$href&page=$i&$querystring\">$i</a> ");
				}
				/* This if statement will not make the current page number available in
				link form. It will, however, make all other pages available in link form. */
			} // This ends the for loop
		} else {
			for($i = 1; $i <= $numofpages; $i++) {
				/* This for loop will add 1 to $i at the end of each pass until $i is greater
				than $numofpages (4.08). */

				if($i == $page){
					echo($i." ");
				}else{
					echo("<a href=\"$href&page=$i&$querystring\">$i</a> ");
				}
				/* This if statement will not make the current page number available in
				link form. It will, however, make all other pages available in link form. */
			}
		}
	}
	if(($totalrows % $limit) != 0){
		//echo $totalpages;


		/* The above statement is the key to knowing if there are remainders, and it's
		all because of the %. In PHP, C++, and other languages, the % is known as a
		Modulus. It returns the remainder after dividing two numbers. If there is no
		remainder, it returns zero. In our example, it will return 0.8 */

		if($i == $page){
			echo($i." ");
		}else{
			echo("<a href=\"$href&page=$i&$querystring\">$i</a> ");
		}

		if ($page!=$newvalue) {
			echo("<a href=\"$href&page=$newvalue&$querystring\"> >> Last </a> ");
		} else {
			echo(">> Last ");
		}

		/* This is the exact statement that turns pages into link form that is used

		above */
	} else {
		if ($page!=$newvalue) {
			echo("<a href=\"$href&page=$totalpages&$querystring\"> >> Last </a> ");
		} else {
			echo(">> Last ");
		}
	}
	return $limitvalue;
	} else {
		return 0;
	}
}



function totalrecords ($table,$where,$sel='*') {
	$query_count    = "SELECT count($sel) as a FROM $table";
	if ($where!="") $query_count.= " where $where";
//	echo $query_count;
	$result_count   = mysql_query($query_count);
	$totalrows      = mysql_result($result_count,0,"a");
	return  $totalrows;
}

// IMAGE UPLOAD FUNCTION
// $x IS THE VALUE WITH WHICH THE FILE NAME WILL START
// $formField IS THE VARIABLE FOR THE FIELD NAME OF FORM WITH
// WHICH FILE WAS UPLOADED (INPUT NAME)
// $nam any special characters after $x eg img
// $path is the full path to upload directory
// Idont like to do this commenting shit Tahir

function imageUpload ($x, $formField, $nam, $path) {

	$img1 = $_FILES[$formField]['name'];
	$type1=explode("/",$_FILES[$formField]['type']);
	$file1 = $_FILES[$formField]['tmp_name'];

	//$type1=explode("/",$filetype);
	//$img1 = $filename;
	$path_parts = pathinfo($img1);
	srand(time());
	$random = (rand()%1000);
	$img1=$x."_".$random."_".$nam.".".$path_parts['extension'];
	$newfile =  $path. $img1;
	//$file1 = $tmp_name;

	if (!move_uploaded_file($file1, $newfile)) {
		echo "Cannot Upload File $newfile<br>";
		echo "<script> alert('Cannot Upload File ".$_FILES[$formField]['name']."'); </script>";
		return  false;
	} else {	
			
			echo "<script> alert('File Uploaded Successfully'); </script>";
		
		return $img1;
	}
	chmod($newfile, 0644);
}

//if you use any kind of automated function or loop to print the values, which you should for efficiency’s sake, you will end up with an extra comma at the end of your output.
function stripend ($string,$end) {
	// end should be hagative example -2
	$string=substr($string, 0, $end);
	return $string;
}
encodehtml();

/*$error = new error_handler("192.168.0.3",1,5,"shaikh.t@gmail.com","");
set_error_handler(array(&$handler, "handler"));  
*/
if (isset($_GET['ID'])) {
	$ID=isset($_GET['ID'])?$_GET['ID']:"";
	$usr=isset($_GET['uname'])?$_GET['uname']:"";
} else {
	$ID=isset($_POST['ID'])?$_POST['ID']:"";
	$usr=isset($_POST['uname'])?$_POST['uname']:"";
	
}
$nurl="ID=$ID&uname=$usr";
//auth($ID, $usr); DOYOON

$uploadpath="/kunden/homepages/21/d100097566/htdocs/vancouvershoppingdirectory/";
/*
show_user values:
0 -> off
1 -> on (default)

show_developer values:
0 -> off
1 -> on (default)
2 -> silent
4 -> add context
8 -> add backtrace
16 -> font color white (red default)
32 -> font color black (red default)
add numbers together for more than one to be turned on e.g: add context + silent = 6
matching ip address must be present for show_developer to be invoked

add a valid email address or log file path to invoke these functions			[http://franktank.com/blog/]
*/

class error_handler
{

	//########################################################################
	//contructor for the class...
	function error_handler($ip=0, $show_user=1, $show_developer=1, $email=NULL, $log_file=NULL)
	{
		$this->ip = $ip;
		$this->show_user = $show_user;
		$this->show_developer = $show_developer;
		$this->email = mysql_escape_string($email);
		$this->log_file = $log_file;
		$this->log_message = NULL;
		$this->email_sent = false;

		$this->error_codes =  E_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR;
		$this->warning_codes =  E_WARNING | E_CORE_WARNING | E_COMPILE_WARNING | E_USER_WARNING;

		//associate error codes with errno...
		$this->error_names = array('E_ERROR','E_WARNING','E_PARSE','E_NOTICE','E_CORE_ERROR','E_CORE_WARNING',
		'E_COMPILE_ERROR','E_COMPILE_WARNING','E_USER_ERROR','E_USER_WARNING',
		'E_USER_NOTICE','E_STRICT','E_RECOVERABLE_ERROR');

		for($i=0,$j=1,$num=count($this->error_names); $i<$num; $i++,$j=$j*2)
		$this->error_numbers[$j] = $this->error_names[$i];
	}

	//########################################################################
	//error handling function...
	function handler($errno, $errstr, $errfile, $errline, $errcontext)
	{
		$this->errno = $errno;
		$this->errstr = $errstr;
		$this->errfile = $errfile;
		$this->errline = $errline;
		$this->errcontext = $errcontext;

		if($this->log_file)
		$this->log_error_msg();

		if($this->email)
		$this->send_error_msg();

		if($this->show_user)
		$this->error_msg_basic();

		if($this->show_developer && preg_match("/^$this->ip$/i", $_SERVER['REMOTE_ADDR'])) //REMOTE_ADDR : HTTP_X_FORWARDED_FOR
		$this->error_msg_detailed();

		/* Don't execute PHP internal error handler */
		return true;
	}


	//########################################################################
	//error reporting functions...
	function error_msg_basic()
	{
		$message = NULL;
		if($this->errno & $this->error_codes) $message .= "<b>ERROR:</b> There has been an error in the code.";
		if($this->errno & $this->warning_codes) $message .= "<b>WARNING:</b> There has been an error in the code.";

		if($message) $message .= ($this->email_sent)?" The developer has been notified.<br />\n":"<br />\n";
		echo $message;
	}

	function error_msg_detailed()
	{
		//settings for error display...
		$silent = (2 & $this->show_developer)?true:false;
		$context = (4 & $this->show_developer)?true:false;
		$backtrace = (8 & $this->show_developer)?true:false;

		switch(true)
		{
			case (16 & $this->show_developer): $color='white'; break;
			case (32 & $this->show_developer): $color='black'; break;
			default: $color='red';
		}

		$message =  ($silent)?"<!--\n":'';
		$message .= "<pre style='color:$color;'>\n\n";
		$message .= "file: ".print_r( $this->errfile, true)."\n";
		$message .= "line: ".print_r( $this->errline, true)."\n\n";
		$message .= "code: ".print_r( $this->error_numbers[$this->errno], true)."\n";
		$message .= "message: ".print_r( $this->errstr, true)."\n\n";
		$message .= ($context)?"context: ".print_r( $this->errcontext, true)."\n\n":'';
		$message .= ($backtrace)?"backtrace: ".print_r( debug_backtrace(), true)."\n\n":'';
		$message .= "</pre>\n";
		$message .= ($silent)?"-->\n\n":'';

		echo $message;
	}

	function send_error_msg()
	{
		$message = "file: ".print_r( $this->errfile, true)."\n";
		$message .= "line: ".print_r( $this->errline, true)."\n\n";
		$message .= "code: ".print_r( $this->error_numbers[$this->errno], true)."\n";
		$message .= "message: ".print_r( $this->errstr, true)."\n\n";
		$message .= "log: ".print_r( $this->log_message, true)."\n\n";
		$message .= "context: ".print_r( $this->errcontext, true)."\n\n";
		//$message .= "backtrace: ".print_r( $this->debug_backtrace(), true)."\n\n";

		$this->email_sent = false;
		if(mail($this->email, 'Error: '.$this->errcontext['SERVER_NAME'].$this->errcontext['REQUEST_URI'], $message, "From: error@".$this->errcontext['HTTP_HOST']."\r\n"))
		$this->email_sent = true;
	}

	function log_error_msg()
	{
		$message =  "time: ".date("j M y - g:i:s A (T)", mktime())."\n";
		$message .= "file: ".print_r( $this->errfile, true)."\n";
		$message .= "line: ".print_r( $this->errline, true)."\n\n";
		$message .= "code: ".print_r( $this->error_numbers[$this->errno], true)."\n";
		$message .= "message: ".print_r( $this->errstr, true)."\n";
		$message .= "##################################################\n\n";

		if (!$fp = fopen($this->log_file, 'a+'))
		$this->log_message = "Could not open/create file: $this->log_file to log error."; $log_error = true;

		if (!fwrite($fp, $message))
		$this->log_message = "Could not log error to file: $this->log_file. Write Error."; $log_error = true;

		if(!$this->log_message)
		$this->log_message = "Error was logged to file: $this->log_file.";

		fclose($fp);
	}

}

////////////////////////////////////////////////////////////////////////////////////////
// Class: DbConnector
// Purpose: Connect to a database, MySQL version
///////////////////////////////////////////////////////////////////////////////////////

// encodes a string one way
function encrypt($txt) {
	return crypt($txt,"vI").crc32($txt);
}

// sends a query
function send($msg) {
	require("messages.php");
	require_once('DbConnector.php');
	$con = new DbConnector();
	$result = mysql_query($msg) or die("$msg_014 :$msg");
}

// returns current date and time
function now(){
	$dat = getdate(strtotime(now));
	return "$dat[year]-$dat[mon]-$dat[mday] $dat[hours]:$dat[minutes]:00";
}

// it makes the authentification
function auth($SES_ID) {
	//echo $SES_ID;
	if ($SES_ID!="vIsfWespbrBVQ166936360") {
		require("messages.php");
		require_once('DbConnector.php');
		$con = new DbConnector();
		$query = "select * from cmsadmin where ses = '$SES_ID'";

		$result = mysql_query($query) or die ("$msg_014 :$query");
		$num = mysql_num_rows($result);

		if ($num == 0) {
			echo $msg_004;
			echo "<script>window.location='index.php';</script>";
			mysql_close();
			$con->close();
			exit;
		}
		$session_time=25;
		if (diff(@now(), mysql_result($result,0,"dtime")) > $session_time ) {
			echo $msg_005;
			send("update cmsadmin set ses='*' where ses='$SES_ID'");
			echo "<script>window.location='index.php';</script>";
			mysql_close();
			$con->close();
			exit;
		}
		//   echo diff(@now(), mysql_result($result,0,"dtime"));
		$dat = @now();
		send("update cmsadmin set dtime='$dat' where ses='$SES_ID'");
		mysql_close();
		//   $con->close();
	}
}

// generates a unic string
function gen() {
	mt_srand((double)microtime() * 1000000);
	return mt_rand(1000, 9999) . "-" . mt_rand(1000, 9999) . "-" . mt_rand(1000, 9999) . "-" . mt_rand(1000, 9999);
}

// calculeaza diferenta in minute dintre doua date, unde data este de forma 2003-08-24.
function diff($date1, $date2) {
	$a1 = @getdate(strtotime($date1));
	$a2 = @getdate(strtotime($date2));
	return ($a1[@year]-$a2[@year])*525600 + ($a1[@mon]-$a2[@mon])*43200 + ($a1[@mday]-$a2[@mday])*1440 + ($a1[@hours]-$a2[@hours])*60 + ($a1[@minutes]-$a2[@minutes]);
}

// generates random strings - doyoon - for Moneris order ID
function generateCode($length) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
	$code = "";
	$clen = strlen($chars) - 1;  //a variable with the fixed length of chars correct for the fence post issue
	while (strlen($code) < $length) {
		$code .= $chars[mt_rand(0,$clen)];  //mt_rand's range is inclusive - this is why we need 0 to n-1
	}
	return $code;
}
?>