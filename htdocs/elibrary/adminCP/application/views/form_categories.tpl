
    { if $errors }
        <div class="error">{ $errors }</div>
    { /if }

	<form class='wufoo' method='post' action='http://localhost/elibrary/admincp/index.php/categories/{ $action_mode }/{ $record_id }' enctype="multipart/form-data">

    	<div class="info">
            { if $action_mode == 'create' }
                <h2>Add new record</h2>
            { else }
                <h2>Edit record: #{ $record_id }</h2>
            { /if }
    	</div>

        <ul>
            
    	<li>
            <label class="desc">{ $categories_fields.category_department_id }</label>
        	<div class="block">
        	<span class="left">
        		<select class="field select addr" name="category_department_id" >
                    <option value="0"></option>
                    { foreach from=$related_departments value=rel }
                        <option value="{ $rel.departments_id }"{if $categories_data.category_department_id == $rel.departments_id } selected="selected"{/if}>{ $rel.departments_name }</option>
                    { /foreach }
            	</select>
            </span>
            </div>
    		<p class="instruct">Department Name</p>
        </li>
    
    	<li>
            <label class="desc">{ $categories_fields.Category_name }</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="{ $categories_data.Category_name }" name="Category_name" />
    		</div>
    		<p class="instruct">Name of Category</p>
    	</li>
    
        </ul>

        <input type='submit' value='Save data' class='button positive' />
        <br />
        <br />
    </form>
