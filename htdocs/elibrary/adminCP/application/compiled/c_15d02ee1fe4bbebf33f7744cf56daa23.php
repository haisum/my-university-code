<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2010-10-13 05:39:35 Pakistan Standard Time */ ?>
    <?php if ($this->_vars['errors']): ?>
        <div class="error"><?php echo $this->_vars['errors']; ?>
</div>
    <?php endif; ?>

	<form class='wufoo' method='post' action='http://localhost/elibrary/admincp/index.php/book_types/<?php echo $this->_vars['action_mode']; ?>
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
            <label class="desc"><?php echo $this->_vars['book_types_fields']['type_name']; ?>
</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="<?php echo $this->_vars['book_types_data']['type_name']; ?>
" name="type_name" />
    		</div>
    		<p class="instruct">Type Name</p>
    	</li>
    
        </ul>

        <input type='submit' value='Save data' class='button positive' />
        <br />
        <br />
    </form>
