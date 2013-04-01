
    { if $errors }
        <div class="error">{ $errors }</div>
    { /if }

	<form class='wufoo' method='post' action='http://localhost/elibrary/admincp/index.php/users/{ $action_mode }/{ $record_id }' enctype="multipart/form-data">

    	<div class="info">
            { if $action_mode == 'create' }
                <h2>Add new record</h2>
            { else }
                <h2>Edit record: #{ $record_id }</h2>
            { /if }
    	</div>

        <ul>
            
    	<li>
            <label class="desc">{ $users_fields.user_name }</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="{ $users_data.user_name }" name="user_name" />
    		</div>
    		<p class="instruct">User Name</p>
    	</li>
    
    	<li>
            <label class="desc">{ $users_fields.user_roll_no }</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="{ $users_data.user_roll_no }" name="user_roll_no" />
    		</div>
    		<p class="instruct">Roll No</p>
    	</li>
    
    	<li>
            <label class="desc">{ $users_fields.user_department_id }</label>
        	<div class="block">
        	<span class="left">
        		<select class="field select addr" name="user_department_id" >
                    <option value="0"></option>
                    { foreach from=$related_departments value=rel }
                        <option value="{ $rel.departments_id }"{if $users_data.user_department_id == $rel.departments_id } selected="selected"{/if}>{ $rel.departments_name }</option>
                    { /foreach }
            	</select>
            </span>
            </div>
    		<p class="instruct">Department</p>
        </li>
    
    	<li>
            <label class="desc">{ $users_fields.user_type_id }</label>
        	<div class="block">
        	<span class="left">
        		<select class="field select addr" name="user_type_id" >
                    <option value="0"></option>
                    { foreach from=$related_user_types value=rel }
                        <option value="{ $rel.user_types_id }"{if $users_data.user_type_id == $rel.user_types_id } selected="selected"{/if}>{ $rel.user_types_name }</option>
                    { /foreach }
            	</select>
            </span>
            </div>
    		<p class="instruct">User type</p>
        </li>
    
    	<li>
            <label class="desc">{ $users_fields.user_isApproved }</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="{ $users_data.user_isApproved }" name="user_isApproved" />
    		</div>
    		<p class="instruct">1 for Approved, 0 for Unapproved</p>
    	</li>
    
        </ul>

        <input type='submit' value='Save data' class='button positive' />
        <br />
        <br />
    </form>
