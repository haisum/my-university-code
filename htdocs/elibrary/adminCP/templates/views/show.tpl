
<h3>Details of { $table_name }, record #{ $id }</h3>

<ul>
    %FIELD_LOOP%
        <li>
            <strong>{ $%NAME_TABLE%_fields.%FIELD_ID% }:</strong><br />
            { $%NAME_TABLE%_data.%FIELD_ID% }
        </li>
    %/FIELD_LOOP%
</ul>
