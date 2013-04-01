<?php 
require '../config/config.php';
if(isset($_REQUEST['json'])){
$json = json_decode($_REQUEST['json']);									
$id = $json->weddingId;
$url = URL;
$weddingTitle = $json->title;
$bidDeadLine = strftime('%y-%m-%y' , strtotime($json->bidDeadline));
$weddingDate = strftime('%y-%m-%y' , strtotime($json->weddingDate));
$regionName = $json->region->name;
$guestCount = $json->guestCount;
$bridalPartySize = $json->bridalPartySize;
$budgetFrom = $json->budgetFrom;
$budgetTo = $json->budgetTo;
$postedDate = $json->postedDate;
$statusText = $json->status;
$bidCount = $json->bidCount;
$statusChecked = $json->status == 'OPEN' ? 'checked' : '';
$file = file_exists('../img/weddings/' . $id . '_thumb.jpg')?$id:'-1';	
$html = <<<html
<tr id="listTr{$id}">									
									<td style='width:40px;'>
									<div id="listWrap{$id}">										
										<img id="{$id}thumb" src="{$url}/img/weddings/{$file}_thumb.jpg" alt='image'/>
									</td>
									<td style='width:115px;'>
										<span id="weddingTitleText{$id}">{$weddingTitle}</span>
									</td>
									<td style='width:125px;'>
										<span id="bidDeadLineText{$id}">{$bidDeadLine}</span>
									</td>
									<td style='width:120px;'>
										<span id="regionText{$id}">{$regionName}</span>
									</td>
									<td style='width:65px;'>
										<span id="guestCountText{$id}">{$guestCount}</span>
									</td>
									<td style='width:65px;'>
										<span id="bridalPartySizeText{$id}">{$bridalPartySize}</span>
									</td>
									<td style='width:95px;'>
										<span id="budgetFromText{$id}">\${$budgetFrom}-\${$budgetTo}</span>
									</td>
									<td style='width:40px;'>
										<span id="bidCount{$id}">{$bidCount}</span>
									</td>
									<td style='width:35px;'>
										<a href="javascript:editWedding({$id});"><img src="{$url}/img/edit.png" id="editImg{$id}" alt=''/></a>
									</td>
								</tr>
								<tr class='editTr' id="editTr{$id}" style='display:none;'>
									<td colspan='9' style="padding:0px;">
									<div id="editWrap{$id}" style='display:none;'>
										<form action='javascript:saveWedding({$id});' method='post'>
											<table class='etable'>
												<tr>
													<td style="background:none;">
														<label>
															Wedding Title:
														</label>
													</td>
													<td style="background:none;">
														<input rel='{$id}' id='weddingTitle{$id}' type='text' class='text' value='{$weddingTitle}'/>
														<a href='javascript:cancelEdit({$id});' title='Cancel Editing' class='closeLink'>
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
														<input id="weddingDate{$id}" type='text' class='text datepicker' value='{$weddingDate}'/>														
													</td>
												</tr>
												<tr>
													<td>
														<label>
															Deadline:
														</label>
													</td>
													<td>
														<input type='text' id="bidDeadline{$id}" class='text datepicker'  value='2011-08-10'/>
													</td>
												</tr>
												<tr>
													<td>
														<label>
															Region:
														</label>
													</td>
													<td>
														<select class='text' id="regions{$id}">
															<option>test</option>
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
														<input id="categories{$id}" type='text' class='text categories'  value=''/>
													</td>
												</tr>
												<tr>
													<td>
														<label>
															Guest Count:
														</label>
													</td>
													<td>
														<input type='text' id="guestCount{$id}" class='text numberOnly'  value=''/>
													</td>
												</tr>
												<tr>
													<td>
														<label>
															Size of bridal party:
														</label>
													</td>
													<td>
														<input id="bridalPartySize{$id}" type='text' class='text numberOnly'  value=''/>
													</td>
												</tr>
												<tr>
													<td>
														<label>
															Budget:
														</label>
													</td>
													<td>
														<div class='budgettxt' style='width:40px;'>From $</div><input type='text' class='text numberOnly budgetinput' id="budgetFrom{$id}"  value=''/> <div class='budgettxt' style='width:20px;margin-left:5px;'>to $</div><input  type='text' id="budgetTo{$id}" class='text numberOnly budgetinput'  value=''/>
													</td>
												</tr>
												<tr>
													<td>
														<label>
															Additional Information:
														</label>
													</td>
													<td>
														<textarea class='text additionalInformation' id="additionalInfo{$id}"></textarea>
													</td>
												</tr>
												<tr>
													<td>
														<label>
															Image:
														</label>
													</td>
													<td>
														<img id="img{$id}" src='{$url}/img/weddings/{$file}.jpg' alt='image'/><br/>
															<br/>				
															<input style='margin-top:10px;' class='uploadify' type='file' value='Choose Image' name='image{$id}' id="image{$id}"/>
															<input type='hidden' id='idof{$id}' value='{$id}'/>
													</td>
												</tr> 
												<tr>
													<td>
														<label>
															Status
														</label>
													</td>
													<td>														
														<input type='checkbox' class='status' id="status{$id}"  {$statusChecked} />&nbsp;<span style="font-size:12px;" id="statusText{$id}" >{$statusText}</span>
													</td>
												</tr>
												<tr>
													<td></td>
													<td>																					
														<label style='margin-left:0px;' class="submit uiButton uiButtonConfirm">
															<input value="Edit Category Details" type="button" style="color:#fff;" onclick='showCategoryBox({$id});return false;'>
														</label>
														<label style='' class="submit uiButton uiButtonConfirm">
															<input value="Save" type="submit" style="color:#fff;">
														</label>
																						<label class="cancel uiButton">
															<input value="Cancel"  type="button" onclick='cancelEdit({$id})'/>														
														</label><br/>
														<div>
														<br/>
														*Wedding posted on {$postedDate}<br/>
														*Wedding details were last modified on <span id="lastModified{$id}"></span> 
														</div>
													</td>
												</tr>
											</table>
										</form>
									</div>
									</td>
									
								</tr>
							
html;
echo $html;
}
else
	echo "Error";
?>