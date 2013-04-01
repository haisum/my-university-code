
    %default%
    	<li>
            <label class="desc">{ $%NAME_TABLE%_fields.%FIELD_NAME% }</label>
    		<div>
    	       	<input class="field text medium" type="text" maxlength="255" value="{ $%NAME_TABLE%_data.%FIELD_NAME% }" name="%FIELD_NAME%" />
    		</div>
    		%IF_FIELD_DESC%<p class="instruct">%FIELD_DESC%</p>%/IF_FIELD_DESC%
    	</li>
    %/default%

    %textarea%
    	<li>
            <label class="desc">{ $%NAME_TABLE%_fields.%FIELD_NAME% }</label>
    		<div>
        		<textarea rows="10" cols="50" class="field textarea medium" name="%FIELD_NAME%">{ $%NAME_TABLE%_data.%FIELD_NAME% }</textarea>
    		</div>
    		%IF_FIELD_DESC%<p class="instruct">%FIELD_DESC%</p>%/IF_FIELD_DESC%
    	</li>
    %/textarea%

    %WYSIWYG%
    	<li>
            <label class="desc">{ $%NAME_TABLE%_fields.%FIELD_NAME% }</label>
    		<div>
        		<textarea rows="10" cols="50" class="field textarea medium" name="%FIELD_NAME%" >{ $%NAME_TABLE%_data.%FIELD_NAME% }</textarea>
    		</div>
    		%IF_FIELD_DESC%<p class="instruct">%FIELD_DESC%</p>%/IF_FIELD_DESC%
    	</li>
    %/WYSIWYG%
    	
    %checkbox%
    	<li>
            <label class="desc">{ $%NAME_TABLE%_fields.%FIELD_NAME% }</label>
    		<div class="block">
        		<span>
                    <input class="field checkbox" type="checkbox" value="1" name="%FIELD_NAME%"{if $%NAME_TABLE%_data.%FIELD_NAME% == 1 } checked="checked"{/if} />
                </span>
    		</div>
    		%IF_FIELD_DESC%<p class="instruct">%FIELD_DESC%</p>%/IF_FIELD_DESC%
    	</li>
    %/checkbox%

    %file%
    	<li>
        	<fieldset>
                <legend class="desc">{ $%NAME_TABLE%_fields.%FIELD_NAME% }</legend>

                <input type="hidden" value="{ $%NAME_TABLE%_data.%FIELD_NAME% }" name="%FIELD_NAME%-original-name" />
                { if !$%NAME_TABLE%_data.%FIELD_NAME% }
                    <p>No file uploaded</p>
                { else }
                    <p>File uploaded: <a href="uploads/{ $%NAME_TABLE%_data.%FIELD_NAME% }">{ $%NAME_TABLE%_data.%FIELD_NAME% }</a></p>
                { /if }
        		<div class="block">
                    <span><input class="field file" type="file" name="%FIELD_NAME%" /></span>
        		</div>
        		%IF_FIELD_DESC%<p class="instruct">%FIELD_DESC%</p>%/IF_FIELD_DESC%
        	</fieldset>
    	</li>
    %/file%

    %date%
    	<li>
            <label class="desc">{ $%NAME_TABLE%_fields.%FIELD_NAME% }</label>
    		<span>
    		      <input class="field text" name="%FIELD_NAME%" size="16" type="text" value="" id="demo1"/>
    		      <label>YYYY-MM-DD HH:MM:SS</label>
    		</span>
    		<span>
    		      <a href="javascript:NewCal('demo1','ddmmmyyyy',true,24)"><img src="application/images/calendar.png" class="icon" alt="Pick date." /></a>
    		</span>
    		%IF_FIELD_DESC%<p class="instruct">%FIELD_DESC%</p>%/IF_FIELD_DESC%
    	</li>
    %/date%

    %related%
    	<li>
            <label class="desc">{ $%NAME_TABLE%_fields.%FIELD_NAME% }</label>
        	<div class="block">
        	<span class="left">
        		<select class="field select addr" name="%FIELD_NAME%" >
                    <option value="0"></option>
                    { foreach from=$related_%RELATED_TABLE% value=rel }
                        <option value="{ $rel.%RELATED_TABLE%_id }"{if $%NAME_TABLE%_data.%FIELD_NAME% == $rel.%RELATED_TABLE%_id } selected="selected"{/if}>{ $rel.%RELATED_TABLE%_name }</option>
                    { /foreach }
            	</select>
            </span>
            </div>
    		%IF_FIELD_DESC%<p class="instruct">%FIELD_DESC%</p>%/IF_FIELD_DESC%
        </li>
    %/related%

    
    %many_related%
    	<li>
        	<fieldset>
                <legend class="desc">{ $%NAME_TABLE%_fields.%FIELD_NAME% }</legend>
        		<div class="block">
                        { foreach from=$related_%RELATED_TABLE% value=rel }
                		    <span>
                                <input id="chk-{ $rel.%RELATED_TABLE%_id }" class="field checkbox" type="checkbox" value="{ $rel.%RELATED_TABLE%_id }" name="%FIELD_NAME%[]" { if in_array( $rel.%RELATED_TABLE%_id, $%NAME_TABLE%_%RELATED_TABLE%_data ) }checked="checked" { /if }/>
                                <label for="chk-{ $rel.%RELATED_TABLE%_id }" class="choice">{ $rel.%RELATED_TABLE%_name }</label>
                            </span>
                        { /foreach }
                <br clear="left" />
                <input type="button" value="Select all" onclick="chk_selector( 'all', this )" />
                <input type="button" value="Select none" onclick="chk_selector( 'none', this )" />
        		</div>
        		%IF_FIELD_DESC%<p class="instruct">%FIELD_DESC%</p>%/IF_FIELD_DESC%
            </fieldset>
       	</li>
    %/many_related%


    %enum_values%
    	<li>
            <label class="desc">{ $%NAME_TABLE%_fields.%FIELD_NAME% }</label>
        	<div class="block">
        	<span class="left">
        		<select class="field select addr" name="%FIELD_NAME%" >
                    <option value="0"></option>
                    { foreach from=$metadata.%FIELD_NAME%.enum_values value=e key=k }
                        <option value="{ $e }"{if $%NAME_TABLE%_data.%FIELD_NAME% == $e } selected="selected"{/if}>{ $e }</option>
                    { /foreach }
            	</select>
            </span>
            </div>
    		%IF_FIELD_DESC%<p class="instruct">%FIELD_DESC%</p>%/IF_FIELD_DESC%
        </li>
    %/enum_values%

