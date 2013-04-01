<?php require_once('C:\wamp\www\elibrary\adminCP\application\libraries\template_lite\plugins\function.cycle.php'); $this->register_function("cycle", "tpl_function_cycle");  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2010-09-19 11:32:40 Pakistan Standard Time */ ?>
<h3>List of <?php echo $this->_vars['table_name']; ?>
</h3>

<div id="action_buttons">
	<a href="http://localhost/elibrary/admincp/index.php/departments/create/"class="button positive">Add new record</a><br />
</div>

<?php if (! empty ( $this->_vars['departments_data'] )): ?>
<table>
	<thead>
    	<?php if (count((array)$this->_vars['departments_data']['0'])): foreach ((array)$this->_vars['departments_data']['0'] as $this->_vars['k'] => $this->_vars['x']): ?>
                <th><?php echo $this->_vars['departments_fields'][$this->_vars['k']]; ?>
</th>
    	<?php endforeach; endif; ?>
        <th width="80">Actions</th>
	</thead>
	<tbody>
    	<?php if (count((array)$this->_vars['departments_data'])): foreach ((array)$this->_vars['departments_data'] as $this->_vars['row']): ?>
            <tr class="<?php echo tpl_function_cycle(array('values' => 'odd,even'), $this);?>">
                <?php if (count((array)$this->_vars['row'])): foreach ((array)$this->_vars['row'] as $this->_vars['d']): ?>
                    <td><?php echo $this->_vars['d']; ?>
</td>
    	        <?php endforeach; endif; ?>
                <td width="80">                    
                    <a href="http://localhost/elibrary/admincp/index.php/departments/edit/<?php echo $this->_vars['row']['department_id']; ?>
"><img src="admincp/application/images/edit.png" alt="" /></a>
                    <a href="http://localhost/elibrary/admincp/index.php/departments/delete/<?php echo $this->_vars['row']['department_id']; ?>
"><img src="admincp/application/images/delete.png" alt="" /></a>
                </td>
		    </tr>
    	<?php endforeach; endif; ?>
	</tbody>
</table>
<?php else: ?>
    No records found
<?php endif; ?>

<div id="pager">
    <?php echo $this->_vars['pager']; ?>

</div>

<script>
    <?php echo '
        function chk( url )
        {
            if( confirm(\'Are you sure you want to delete this row?\') )
            {
                document.location = url;
            }
        }
    '; ?>

</script>