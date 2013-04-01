<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2010-09-19 11:32:33 Pakistan Standard Time */ ?>
    <?php if ($this->_vars['errors']): ?>
        <div class="error"><?php echo $this->_vars['errors']; ?>
</div>
    <?php endif; ?>

	<form class='wufoo' method='post' action='http://localhost/elibrary/admincp/index.php/users/<?php echo $this->_vars['action_mode']; ?>
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
            <label class="desc"><?php echo $this->_vars['users_fields']['user_name']; ?>
</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="<?php echo $this->_vars['users_data']['user_name']; ?>
" name="user_name" />
    		</div>
    		<p class="instruct">User Name</p>
    	</li>
    
    	<li>
            <label class="desc"><?php echo $this->_vars['users_fields']['user_roll_no']; ?>
</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="<?php echo $this->_vars['users_data']['user_roll_no']; ?>
" name="user_roll_no" />
    		</div>
    		<p class="instruct">Roll No</p>
    	</li>
    
    	<li>
            <label class="desc"><?php echo $this->_vars['users_fields']['user_department_id']; ?>
</label>
        	<div class="block">
        	<span class="left">
        		<select class="field select addr" name="user_department_id" >
                    <option value="0"></option>
                    <?php if (count((array)$this->_vars['related_departments'])): foreach ((array)$this->_vars['related_departments'] as $this->_vars['rel']): ?>
                        <option value="<?php echo $this->_vars['rel']['departments_id']; ?>
"<?php if ($this->_vars['users_data']['user_department_id'] == $this->_vars['rel']['departments_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_vars['rel']['departments_name']; ?>
</option>
                    <?php endforeach; endif; ?>
            	</select>
            </span>
            </div>
    		<p class="instruct">Department</p>
        </li>
    
    	<li>
            <label class="desc"><?php echo $this->_vars['users_fields']['user_type_id']; ?>
</label>
        	<div class="block">
        	<span class="left">
        		<select class="field select addr" name="user_type_id" >
                    <option value="0"></option>
                    <?php if (count((array)$this->_vars['related_user_types'])): foreach ((array)$this->_vars['related_user_types'] as $this->_vars['rel']): ?>
                        <option value="<?php echo $this->_vars['rel']['user_types_id']; ?>
"<?php if ($this->_vars['users_data']['user_type_id'] == $this->_vars['rel']['user_types_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_vars['rel']['user_types_name']; ?>
</option>
                    <?php endforeach; endif; ?>
            	</select>
            </span>
            </div>
    		<p class="instruct">User type</p>
        </li>
    
    	<li>
            <label class="desc"><?php echo $this->_vars['users_fields']['user_isApproved']; ?>
</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="<?php echo $this->_vars['users_data']['user_isApproved']; ?>
" name="user_isApproved" />
    		</div>
    		<p class="instruct">1 for Approved, 0 for Unapproved</p>
    	</li>
    
        </ul>

        <input type='submit' value='Save data' class='button positive' />
        <br />
        <br />
    </form>
