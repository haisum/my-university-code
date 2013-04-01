<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2010-09-19 11:33:11 Pakistan Standard Time */ ?>
    <?php if ($this->_vars['errors']): ?>
        <div class="error"><?php echo $this->_vars['errors']; ?>
</div>
    <?php endif; ?>

	<form class='wufoo' method='post' action='http://localhost/elibrary/admincp/index.php/categories/<?php echo $this->_vars['action_mode']; ?>
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
            <label class="desc"><?php echo $this->_vars['categories_fields']['category_department_id']; ?>
</label>
        	<div class="block">
        	<span class="left">
        		<select class="field select addr" name="category_department_id" >
                    <option value="0"></option>
                    <?php if (count((array)$this->_vars['related_departments'])): foreach ((array)$this->_vars['related_departments'] as $this->_vars['rel']): ?>
                        <option value="<?php echo $this->_vars['rel']['departments_id']; ?>
"<?php if ($this->_vars['categories_data']['category_department_id'] == $this->_vars['rel']['departments_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_vars['rel']['departments_name']; ?>
</option>
                    <?php endforeach; endif; ?>
            	</select>
            </span>
            </div>
    		<p class="instruct">Department Name</p>
        </li>
    
    	<li>
            <label class="desc"><?php echo $this->_vars['categories_fields']['Category_name']; ?>
</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="<?php echo $this->_vars['categories_data']['Category_name']; ?>
" name="Category_name" />
    		</div>
    		<p class="instruct">Name of Category</p>
    	</li>
    
        </ul>

        <input type='submit' value='Save data' class='button positive' />
        <br />
        <br />
    </form>
