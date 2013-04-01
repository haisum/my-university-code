
<h3>List of { $table_name }</h3>

<div id="action_buttons">
	<a href="{php}echo ADMINURL;{/php}/index.php/%NAME_TABLE%/create/"class="button positive">Add new record</a><br />
</div>

{ if !empty( $%NAME_TABLE%_data ) }
<table>
	<thead>
    	{ foreach from=$%NAME_TABLE%_data.0 value=x key=k }
                <th>{ $%NAME_TABLE%_fields[$k] }</th>
    	{ /foreach }
        <th width="80">Actions</th>
	</thead>
	<tbody>
    	{ foreach from=$%NAME_TABLE%_data value=row }
            <tr class="{ cycle values='odd,even' }">
                { foreach from=$row value=d }
                    <td>{ $d }</td>
    	        { /foreach }
                <td width="80">                    
                    <a href="{php}echo ADMINURL;{/php}/index.php/%NAME_TABLE%/edit/{ $row.%FIELD_ID% }"><img src="application/images/edit.png" alt="" /></a>
                    <a href="{php}echo ADMINURL;{/php}/index.php/%NAME_TABLE%/delete/{ $row.%FIELD_ID% }"><img src="application/images/delete.png" alt="" /></a>
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