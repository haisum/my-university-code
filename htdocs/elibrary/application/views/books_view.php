<h2 class ="heading">Download <?php echo $book_name;?></h2>
             <div class="formInput">
                 <fieldset>
                     <label class="bookLabel">Book Name: </label>
                    <span><?php echo $book_name ;?></span>
                    <label class="bookLabel">Author: </label>
                    <span><?php echo $book_author ;?></span>
                    <label class="bookLabel">ISBN: </label>
                    <span><?php echo $book_isbn ;?></span>
                    <label class="bookLabel">Publisher: </label>
                    <span><?php echo $book_publisher ;?></span>
                    <label class="bookLabel">Category: </label>
                    <span><?php echo $book_category ;?></span>
                    <label class="bookLabel">Uploader: </label>
                    <span><?php echo $user_name ;?></span>
                    <label class="bookLabel">Type: </label>
                    <span><?php echo $type_name ;?></span>
                    <label class="bookLabel">Size: </label>
                    <span><?php echo $book_size ;?></span>
                    <label class="bookLabel">Date Uploaded: </label>
                    <span><?php echo $book_date_inserted ;?></span>
                    <label class="bookLabel">Total Downloads: </label>
                    <span><?php echo $book_downloads ;?></span>
                 </fieldset>
                 <div class="registerButton"><label> &#09;</label><a href="<?php echo $base_url . "/index.php/books/download";?>" class="DownloadButton">Download Now</a></div>
            </div>