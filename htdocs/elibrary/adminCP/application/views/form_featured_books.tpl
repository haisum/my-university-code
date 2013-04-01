
    { if $errors }
        <div class="error">{ $errors }</div>
    { /if }

	<form class='wufoo' method='post' action='http://localhost/elibrary/admincp/index.php/featured_books/{ $action_mode }/{ $record_id }' enctype="multipart/form-data">

    	<div class="info">
            { if $action_mode == 'create' }
                <h2>Add new record</h2>
            { else }
                <h2>Edit record: #{ $record_id }</h2>
            { /if }
    	</div>

        <ul>
            
    	<li>
            <label class="desc">{ $featured_books_fields.Featured_Book_Id }</label>
        	<div class="block">
        	<span class="left">
        		<select class="field select addr" name="Featured_Book_Id" >
                    <option value="0"></option>
                    { foreach from=$related_books value=rel }
                        <option value="{ $rel.books_id }"{if $featured_books_data.Featured_Book_Id == $rel.books_id } selected="selected"{/if}>{ $rel.books_name }</option>
                    { /foreach }
            	</select>
            </span>
            </div>
    		<p class="instruct">Featured Book</p>
        </li>
    
        </ul>

        <input type='submit' value='Save data' class='button positive' />
        <br />
        <br />
    </form>
