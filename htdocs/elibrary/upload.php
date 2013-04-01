<?php session_start();
mysql_connect("localhost", "codefreak", "letmein");
mysql_select_db("elibrary");
$ext = "";
$totalSize = 0;
define('ALLOWED_SIZE' , 20 * 1024 * 1024);//replace 20 with desired allowed size in MBs
$query = mysql_query("SELECT * FROM book_types");
while(($row = mysql_fetch_object($query))!=null){
$ext .= "*." . strtoupper($row->type_name) . ";";
}
if(isset ($_SESSION['user_id'])){
$query = mysql_query("SELECT book_size FROM books where book_uploader_id=" . $_SESSION['user_id']);
while(($row = mysql_fetch_object($query))!=null){
$totalSize += $row->book_size;
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <link rel="stylesheet" href="css/uploadify.css" />
        <link rel="stylesheet" href="css/upload.css" />
        <script type="text/javascript" src="scripts/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="scripts/swfobject.js"></script>
        <script type="text/javascript" src="scripts/jquery.uploadify.v2.1.0.min.js"></script>
        <script type="text/javascript">
            function startUpload(){
                if($(".formInput #book_title").val() == ""){
                    $(".formInput #book_title").css('background-color', '#FFCFCF');
                }
                else if($(".formInput #book_isbn").val() == ""){
                    $(".formInput #book_isbn").css('background-color', '#FFCFCF');
                }
                else if($(".formInput #book_author").val() == ""){
                    $(".formInput #book_author").css('background-color', '#FFCFCF');
                }
                else if($(".formInput #book_isbn").val() == ""){
                    $(".formInput #book_author").css('background-color', '#FFCFCF');
                }
                else{
                $('#fileUpload').uploadifySettings('scriptData', {'book_title' : $(".formInput #book_title").val() ,
                                        'book_author' : $(".formInput #book_author").val(),
                                        'book_isbn' : $(".formInput #book_isbn").val(),
                                        'category_id' : $("#book_categories option:selected").val(),
                                        'publisher_id' : $("#book_publishers option:selected").val(),
                                        'user_id' : '<?php
                                                         if(isset ($_SESSION['user_id']))
                                                            echo $_SESSION['user_id'];
                                                         else {
                                                            echo '';
                                                         }
                                                    ?>'
                                                    }
                                                )

                $('#fileUpload').uploadifyUpload();
                }
            }
            var sizeLimit = 1024 * 1024 * 200;
            $(document).ready(function(){
             $('#fileUpload').uploadify({
            'uploader': 'uploadify.swf',
            'script':   'uploadify.php',
            'folder':    'uploads',
            'cancelImg': 'images/cancel.png',
            'checkScript' : 'check.php',
            'fileDesc' : 'E-books(<?php echo $ext;?>)',
            'fileExt' : '<?php echo $ext;?>',
            'sizeLimit' : sizeLimit,
            'multi': false,
            onComplete: function (evt, queueID, fileObj, response, data) {
                    $("#UploadMessage").css('margin-top','20px').html(response);
                    $("#loading").fadeOut(400);
            },
            onProgress : function(){
                $("#loading").css('display','inline');
            },
            onSelect : function(evt, queueID, fileObj){
            /*@cc_on
                    @if (@_jscript_version >= 4){
                        var fileName = fileObj.name;
                        if(fileName.length>35)
                           fileName =  fileName.substring(0,35) + '...' ;
                        $('#forIE').css('margin-top','20px').css('margin-bottom','20px').html("<div style='float:left;display:inline'>Selected File: " + fileName + "</div><div style='flaot:left;display:inline;margin-left:10px;'><img src='images/loadingRound.gif' alt='loading' id='loading' style='display:none;'/></div>");
                    @end
        }
            @*/
                return true;
            }
                    });
            $('#classicLink').click(function(){
            $('#fileUpload').css('dispaly','none');$('#classic').css('display', 'block');$('#startUpload').attr('href',"javascript:ClassicUpload();");$('#CancelUpload').remove();
            $('#fileUploadUploader').remove();
            $('#fileUploadQueue').remove();
            });
            }

            );
            function Cancel(){
                $('#fileUpload').uploadifyClearQueue();
                $('#forIE').css('margin-top','0px').css('margin-bottom','0px').html('');
            }

        </script>
    </head>
    <body>
        <div>
            <h2 class ="heading">Upload Ebook</h2>
          <?php
          if(isset ($_SESSION['user_name'] ) && isset ($_SESSION['user_password'] ) && isset ($_SESSION['user_roll_no'] ) && isset ($_SESSION['user_id'] ))
            {
              if($totalSize>ALLOWED_SIZE){
                  echo "You have reached your upload limit";
                  exit;
              }
          
          ?>
            <div class="flashMessage">Try upgrading your flash player if upload isn't working!</div>
             <div class="formInput">
                 <fieldset>
                    <legend>Book Information</legend>
                    <label for="fileName">Book Name: </label>
                    <input type="text" name="fileName" id="book_title"/>
                    <label for="ISBN">ISBN: </label>
                    <input type="text" name="ISBN" id="book_isbn"/>
                    <label for="author">Author: </label>
                    <input type="text" name="author" id="book_author"/>
                    <label for="category">Category:</label>
                    <select name="category" id="book_categories">
                     <?php
                        $query =  mysql_query("SELECT * FROM categories order by category_name");
                        while(($row=mysql_fetch_object($query)) != null){
                            echo "<option value='" . $row->category_id ."'>" . $row->Category_name . "</option>";
                        }
                     ?>
                    </select>
                    <label for="publisher">Publisher:</label>
                    <select name="publisher" id="book_publishers">
                    <?php
                        $query =  mysql_query("SELECT * FROM publishers order by publisher_name");
                        while(($row=mysql_fetch_object($query)) != null){
                            echo "<option value='" . $row->publisher_id ."'>" . $row->publisher_name . "</option>";
                        }
                    ?>
                    </select>
                 </fieldset>
            </div>
            <div style="height:20px;"></div>
            <div id="fileUpload" class="flashObj">
                    You have a problem with your javascript
            </div>

            <div id="forIE" class="forIE"></div>

            <a class="links" id="startUpload" href="javascript:startUpload();">Start Upload</a>
            |  <a class="links" href="javascript:Cancel();">Cancel</a>

            <div id="UploadMessage" class="UploadMessage"></div>
            <?php }
            else {
                echo "You must be logged in to upload files. You will be redirected to home now";
                header('location:http://localhost/elibrary/');
            }
            ?>
        </div>
        
    </body>
</html>