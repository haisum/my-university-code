
    { if $errors }
        <div class="error">{ $errors }</div>
    { /if }

	<form class='wufoo' method='post' action='http://localhost/elibrary/admincp/index.php/publishers/{ $action_mode }/{ $record_id }' enctype="multipart/form-data">

    	<div class="info">
            { if $action_mode == 'create' }
                <h2>Add new record</h2>
            { else }
                <h2>Edit record: #{ $record_id }</h2>
            { /if }
    	</div>

        <ul>
            
    	<li>
            <label class="desc">{ $publishers_fields.publisher_name }</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="{ $publishers_data.publisher_name }" name="publisher_name" />
    		</div>
    		<p class="instruct">Publisher's Name</p>
    	</li>
    
        </ul>

        <input type='submit' value='Save data' class='button positive' />
        <br />
        <br />
    </form>
