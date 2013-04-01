<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2010-09-19 11:48:48 Pakistan Standard Time */ ?>
    <?php if ($this->_vars['errors']): ?>
        <div class="error"><?php echo $this->_vars['errors']; ?>
</div>
    <?php endif; ?>

	<form class='wufoo' method='post' action='http://localhost/elibrary/admincp/index.php/books/<?php echo $this->_vars['action_mode']; ?>
/<?php echo $this->_vars['record_id']; ?>
' enctype="multipart/form-data">

    	<div class="info">
            <?php if ($this->_vars['action_mode'] == 'create'): ?>
                <h2>Add new record</h2>
            <?php else: ?>
                <h2>Edit record: #<?php echo $this->_vars['record_id']; ?>
</h2>
            <?php endif; ?>
    	</div>

        <ul>
            
    	<li>
            <label class="desc"><?php echo $this->_vars['books_fields']['Book_Title']; ?>
</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="<?php echo $this->_vars['books_data']['Book_Title']; ?>
" name="Book_Title" />
    		</div>
    		<p class="instruct">Book Title</p>
    	</li>
    
    	<li>
            <label class="desc"><?php echo $this->_vars['books_fields']['Book_Author']; ?>
</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="<?php echo $this->_vars['books_data']['Book_Author']; ?>
" name="Book_Author" />
    		</div>
    		<p class="instruct">Book's Author</p>
    	</li>
    
    	<li>
            <label class="desc"><?php echo $this->_vars['books_fields']['Book_ISBN']; ?>
</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="<?php echo $this->_vars['books_data']['Book_ISBN']; ?>
" name="Book_ISBN" />
    		</div>
    		<p class="instruct">Book's ISBN</p>
    	</li>
    
    	<li>
            <label class="desc"><?php echo $this->_vars['books_fields']['book_publisher_id']; ?>
</label>
        	<div class="block">
        	<span class="left">
        		<select class="field select addr" name="book_publisher_id" >
                    <option value="0"></option>
                    <?php if (count((array)$this->_vars['related_publishers'])): foreach ((array)$this->_vars['related_publishers'] as $this->_vars['rel']): ?>
                        <option value="<?php echo $this->_vars['rel']['publishers_id']; ?>
"<?php if ($this->_vars['books_data']['book_publisher_id'] == $this->_vars['rel']['publishers_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_vars['rel']['publishers_name']; ?>
</option>
                    <?php endforeach; endif; ?>
            	</select>
            </span>
            </div>
    		<p class="instruct">Publisher</p>
        </li>
    
    	<li>
            <label class="desc"><?php echo $this->_vars['books_fields']['book_category_id']; ?>
</label>
        	<div class="block">
        	<span class="left">
        		<select class="field select addr" name="book_category_id" >
                    <option value="0"></option>
                    <?php if (count((array)$this->_vars['related_categories'])): foreach ((array)$this->_vars['related_categories'] as $this->_vars['rel']): ?>
                        <option value="<?php echo $this->_vars['rel']['categories_id']; ?>
"<?php if ($this->_vars['books_data']['book_category_id'] == $this->_vars['rel']['categories_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_vars['rel']['categories_name']; ?>
</option>
                    <?php endforeach; endif; ?>
            	</select>
            </span>
            </div>
    		<p class="instruct">Book's Category</p>
        </li>
    
    	<li>
            <label class="desc"><?php echo $this->_vars['books_fields']['book_uploader_id']; ?>
</label>
        	<div class="block">
        	<span class="left">
        		<select class="field select addr" name="book_uploader_id" >
                    <option value="0"></option>
                    <?php if (count((array)$this->_vars['related_users'])): foreach ((array)$this->_vars['related_users'] as $this->_vars['rel']): ?>
                        <option value="<?php echo $this->_vars['rel']['users_id']; ?>
"<?php if ($this->_vars['books_data']['book_uploader_id'] == $this->_vars['rel']['users_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_vars['rel']['users_name']; ?>
</option>
                    <?php endforeach; endif; ?>
            	</select>
            </span>
            </div>
    		<p class="instruct">Book's Uploader</p>
        </li>
    
    	<li>
            <label class="desc"><?php echo $this->_vars['books_fields']['book_type_id']; ?>
</label>
        	<div class="block">
        	<span class="left">
        		<select class="field select addr" name="book_type_id" >
                    <option value="0"></option>
                    <?php if (count((array)$this->_vars['related_book_types'])): foreach ((array)$this->_vars['related_book_types'] as $this->_vars['rel']): ?>
                        <option value="<?php echo $this->_vars['rel']['book_types_id']; ?>
"<?php if ($this->_vars['books_data']['book_type_id'] == $this->_vars['rel']['book_types_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_vars['rel']['book_types_name']; ?>
</option>
                    <?php endforeach; endif; ?>
            	</select>
            </span>
            </div>
    		<p class="instruct">Book type</p>
        </li>
    
    	<li>
            <label class="desc"><?php echo $this->_vars['books_fields']['book_downloads']; ?>
</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="<?php echo $this->_vars['books_data']['book_downloads']; ?>
" name="book_downloads" />
    		</div>
    		<p class="instruct">Total No. of Downloads</p>
    	</li>
    
    	<li>
            <label class="desc"><?php echo $this->_vars['books_fields']['book_size']; ?>
</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="<?php echo $this->_vars['books_data']['book_size']; ?>
" name="book_size" />
    		</div>
    		<p class="instruct">Size of Book</p>
    	</li>
    
    	<li>
            <label class="desc"><?php echo $this->_vars['books_fields']['Book_Path']; ?>
</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="<?php echo $this->_vars['books_data']['Book_Path']; ?>
" name="Book_Path" />
    		</div>
    		<p class="instruct">Path Book Is Stored At</p>
    	</li>
    
    	<li>
            <label class="desc"><?php echo $this->_vars['books_fields']['book_IsApproved']; ?>
</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="<?php echo $this->_vars['books_data']['book_IsApproved']; ?>
" name="book_IsApproved" />
    		</div>
    		<p class="instruct">1 for Approved 0  for Unapproved</p>
    	</li>
    
    	<li>
            <label class="desc"><?php echo $this->_vars['books_fields']['book_Date_Inserted']; ?>
</label>
    		<div>
            <input class="field text medium" type="text" maxlength="255" value="<?php echo $this->_vars['books_data']['book_Date_Inserted']; ?>
" name="book_Date_Inserted" id="demo1" OnClick = "javascript:NewCal('demo1','ddmmmyyyy',true,12);" /><a href="javascript:NewCal('demo1','ddmmmyyyy',true,12)" style="width:350px;"><img src="http://localhost/elibrary/admincp/application/images/calendar.png" class="icon" alt="Pick date." /></a>
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
