
    { if $errors }
        <div class="error">{ $errors }</div>
    { /if }

	<form class='wufoo' method='post' action='http://localhost/elibrary/admincp/index.php/books/{ $action_mode }/{ $record_id }' enctype="multipart/form-data">

    	<div class="info">
            { if $action_mode == 'create' }
                <h2>Add new record</h2>
            { else }
                <h2>Edit record: #{ $record_id }</h2>
            { /if }
    	</div>

        <ul>
            
    	<li>
            <label class="desc">{ $books_fields.Book_Title }</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="{ $books_data.Book_Title }" name="Book_Title" />
    		</div>
    		<p class="instruct">Book Title</p>
    	</li>
    
    	<li>
            <label class="desc">{ $books_fields.Book_Author }</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="{ $books_data.Book_Author }" name="Book_Author" />
    		</div>
    		<p class="instruct">Book's Author</p>
    	</li>
    
    	<li>
            <label class="desc">{ $books_fields.Book_ISBN }</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="{ $books_data.Book_ISBN }" name="Book_ISBN" />
    		</div>
    		<p class="instruct">Book's ISBN</p>
    	</li>
    
    	<li>
            <label class="desc">{ $books_fields.book_publisher_id }</label>
        	<div class="block">
        	<span class="left">
        		<select class="field select addr" name="book_publisher_id" >
                    <option value="0"></option>
                    { foreach from=$related_publishers value=rel }
                        <option value="{ $rel.publishers_id }"{if $books_data.book_publisher_id == $rel.publishers_id } selected="selected"{/if}>{ $rel.publishers_name }</option>
                    { /foreach }
            	</select>
            </span>
            </div>
    		<p class="instruct">Publisher</p>
        </li>
    
    	<li>
            <label class="desc">{ $books_fields.book_category_id }</label>
        	<div class="block">
        	<span class="left">
        		<select class="field select addr" name="book_category_id" >
                    <option value="0"></option>
                    { foreach from=$related_categories value=rel }
                        <option value="{ $rel.categories_id }"{if $books_data.book_category_id == $rel.categories_id } selected="selected"{/if}>{ $rel.categories_name }</option>
                    { /foreach }
            	</select>
            </span>
            </div>
    		<p class="instruct">Book's Category</p>
        </li>
    
    	<li>
            <label class="desc">{ $books_fields.book_uploader_id }</label>
        	<div class="block">
        	<span class="left">
        		<select class="field select addr" name="book_uploader_id" >
                    <option value="0"></option>
                    { foreach from=$related_users value=rel }
                        <option value="{ $rel.users_id }"{if $books_data.book_uploader_id == $rel.users_id } selected="selected"{/if}>{ $rel.users_name }</option>
                    { /foreach }
            	</select>
            </span>
            </div>
    		<p class="instruct">Book's Uploader</p>
        </li>
    
    	<li>
            <label class="desc">{ $books_fields.book_type_id }</label>
        	<div class="block">
        	<span class="left">
        		<select class="field select addr" name="book_type_id" >
                    <option value="0"></option>
                    { foreach from=$related_book_types value=rel }
                        <option value="{ $rel.book_types_id }"{if $books_data.book_type_id == $rel.book_types_id } selected="selected"{/if}>{ $rel.book_types_name }</option>
                    { /foreach }
            	</select>
            </span>
            </div>
    		<p class="instruct">Book type</p>
        </li>
    
    	<li>
            <label class="desc">{ $books_fields.book_downloads }</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="{ $books_data.book_downloads }" name="book_downloads" />
    		</div>
    		<p class="instruct">Total No. of Downloads</p>
    	</li>
    
    	<li>
            <label class="desc">{ $books_fields.book_size }</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="{ $books_data.book_size }" name="book_size" />
    		</div>
    		<p class="instruct">Size of Book</p>
    	</li>
    
    	<li>
            <label class="desc">{ $books_fields.Book_Path }</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="{ $books_data.Book_Path }" name="Book_Path" />
    		</div>
    		<p class="instruct">Path Book Is Stored At</p>
    	</li>
    
    	<li>
            <label class="desc">{ $books_fields.book_IsApproved }</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="{ $books_data.book_IsApproved }" name="book_IsApproved" />
    		</div>
    		<p class="instruct">1 for Approved 0  for Unapproved</p>
    	</li>
    
    	<li>
            <label class="desc">{ $books_fields.book_Date_Inserted }</label>
    		<div>
            <input class="field text medium" type="text" maxlength="255" value="{ $books_data.book_Date_Inserted }" name="book_Date_Inserted" id="demo1" OnClick = "javascript:NewCal('demo1','ddmmmyyyy',true,12);" /><a href="javascript:NewCal('demo1','ddmmmyyyy',true,12)" style="width:350px;"><img src="http://localhost/elibrary/admincp/application/images/calendar.png" class="icon" alt="Pick date." /></a>
		<script type="text/javascript" src="admincp/js/main.js"></script>

    		      <label>Insertion/Modification Date</label>
    			<script type="text/javascript">
					var Cdate = new Date();
					document.getElementById("demo1").value = Cdate.toLocaleString();
    			</script>

    		</div>
    		<p class="instruct">Date Inserted - don't insert manually select it from new windows</p>
    	</li>
    
        </ul>

        <input type='submit' value='Save data' class='button positive' />
        <br />
        <br />
    </form>
