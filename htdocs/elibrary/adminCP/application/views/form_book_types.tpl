
    { if $errors }
        <div class="error">{ $errors }</div>
    { /if }

	<form class='wufoo' method='post' action='http://localhost/elibrary/admincp/index.php/book_types/{ $action_mode }/{ $record_id }' enctype="multipart/form-data">

    	<div class="info">
            { if $action_mode == 'create' }
                <h2>Add new record</h2>
            { else }
                <h2>Edit record: #{ $record_id }</h2>
            { /if }
    	</div>

        <ul>
            
    	<li>
            <label class="desc">{ $book_types_fields.type_name }</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="{ $book_types_data.type_name }" name="type_name" />
    		</div>
    		<p class="instruct">Type Name</p>
    	</li>
    
        </ul>

        <input type='submit' value='Save data' class='button positive' />
        <br />
        <br />
    </form>
