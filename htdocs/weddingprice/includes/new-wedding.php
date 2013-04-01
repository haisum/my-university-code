<tr class='editTr' id="editTr-1" style='display:none;'>
<td colspan='9' style="padding:0px;">
<div id='editWrap-1' style='display:none;'>
	<form action='javascript:void(0);' method='post' onsubmit='saveWedding(-1);'>
		<table class='etable'>		
			<tr>
					<td style="background:none;">
						<label>
							Wedding Title:
						</label>
					</td>
					<td style="background:none;">
						<input id='weddingTitle-1' type='text' class='text' value=''/>
						<a href='javascript:cancelEdit(-1);' title='Cancel Editing' class='closeLink'>
								Close
							</a>
					</td>
			</tr>
			<tr>
				<td style="background:none;">
					<label>
						Wedding Date:
					</label>
				</td>
				<td style="background:none;">
					<input id='weddingDate-1' type='text' class='text' value=''/>
				</td>
			</tr>
			<tr>
				<td>
					<label>
						Deadline:
					</label>
				</td>
				<td>
					<input type='text' id='bidDeadline-1' class='text'  value=''/>
				</td>
			</tr>
			<tr>
				<td>
					<label>
						Region:
					</label>
				</td>
				<td>
					<select class='text' id="regions-1">
						<?php echo $regions;?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<label>
						Categories:
					</label>
				</td>
				<td>
					<input id='categories-1' type='text' class='text categories'  value=''/>
				</td>
			</tr>
			<tr>
				<td>
					<label>
						Guest Count:
					</label>
				</td>
				<td>
					<input type='text' id="guestCount-1" class='text numberOnly'  value=''/>
				</td>
			</tr>
			<tr>
				<td>
					<label>
						Size of bridal party:
					</label>
				</td>
				<td>
					<input id="bridalPartySize-1" type='text' class='text numberOnly'  value=''/>
				</td>
			</tr>
			<tr>
				<td>
					<label>
						Total Budget for wedding:
					</label>
				</td>
				<td>
					<div class='budgettxt' style='width:40px;'>From $</div><input type='text' class='text numberOnly budgetinput' id="budgetFrom-1"  value=''/> <div class='budgettxt' style='width:20px;margin-left:5px;'>to $</div><input  type='text' id="budgetTo-1" class='text numberOnly budgetinput'  value=''/>
				</td>
			</tr>
			<tr>
				<td>
					<label>
						Wedding Details:
					</label>
				</td>
				<td>
					<textarea class='text additionalInformation' id='additionalInfo-1'></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<label>
						Image:
					</label>
				</td>
				<td>
					<img id="img-1" src='<?php echo URL . "/img/weddings/-1.jpg";?>' alt='image'/><br/>
						<br/>				
						<input style='margin-top:10px;' class='uploadify-1' type='file' name='image-1' id="image-1"/>														
				</td>
			</tr>
			<tr>
				<td>
					<label>
						Status
					</label>
				</td>
				<td>
					<input type='checkbox' class='status' id='status-1' checked />&nbsp;<span style="font-size:12px;" id='statusText-1'>OPEN</span>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<label style='margin-left:0px;' class="submit uiButton uiButtonConfirm">
						<input value="Save and Add Category Details" type="button" style="color:#fff;" onclick='saveWedding({rowId:-1, showCatEdit:true});'>
					</label>
					<label class="cancel uiButton">
						<input value="Cancel"  type="button" onclick='cancelEdit(-1)'/>														
					</label>
				</td>
			</tr>
		</table>
	</form>
</div>
</td>

</tr>