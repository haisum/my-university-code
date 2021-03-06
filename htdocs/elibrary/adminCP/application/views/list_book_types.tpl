
<h3>List of { $table_name }</h3>

<div id="action_buttons">
	<a href="http://localhost/elibrary/admincp/index.php/book_types/create/"class="button positive">Add new record</a><br />
</div>

{ if !empty( $book_types_data ) }
<table>
	<thead>
    	{ foreach from=$book_types_data.0 value=x key=k }
                <th>{ $book_types_fields[$k] }</th>
    	{ /foreach }
        <th width="80">Actions</th>
	</thead>
	<tbody>
    	{ foreach from=$book_types_data value=row }
            <tr class="{ cycle values='odd,even' }">
                { foreach from=$row value=d }
                    <td>{ $d }</td>
    	        { /foreach }
                <td width="80">                    
                    <a href="http://localhost/elibrary/admincp/index.php/book_types/edit/{ $row.type_id }"><img src="admincp/application/images/edit.png" alt="" /></a>
                    <a href="http://localhost/elibrary/admincp/index.php/book_types/delete/{ $row.type_id }"><img src="admincp/application/images/delete.png" alt="" /></a>
                </td>
		    </tr>
    	{ /foreach }
	</tbody>
</table>
{ else }
    No records found
{ /if }

<div id="pager">
    { $pager }
</div>

<script>
    {literal}
        function chk( url )
        {
            if( confirm('Are you sure you want to delete this row?') )
            {
                document.location = url;
            }
        }
    {/literal}
</script>