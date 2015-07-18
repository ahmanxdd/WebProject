<?php include("header1.php"); ?>
<link rel="stylesheet" type="text/css" href="css/admin_table.css" />
<script src="scripts/admin_table.js"></script>
<title>Admin Category</title>
<?php include("header2.php"); ?>

	<?php include("admin_table_tabs.php") ?>
	<form id="adminCatForm" action="admin_cat.php" method="post">
		<div class="adminTable_C">
			<div id="adminCat_C" class="adminCat_C">
			<?php
				include_once('Brain/field_const.php');
				include_once('Brain/functions.php');
				include_once('Brain/Category.php');
				
				regPost('catNo', 'catName', 'newCatNo', 'newCatName', 'newCatParent', 'dels');
				if (isset($catNo)) {
					//from post method
					$size = sizeof($catNo);
					for ($i = 0; $i < $size; $i++)
						updateCategory($catNo[$i], $catName[$i]);
				}
				
				if (isset($newCatNo)){
					$catNoTable = array();
					foreach ($newCatNo as $i => $v) {
						if ($newCatNo[$i] == "")
							continue;
						$nCatParent = $newCatParent[$i];
						if ($nCatParent[0] != 'C')
							$nCatParent = $catNoTable[$nCatParent];
						$newIndex = addCategory($newCatName[$i], $nCatParent);
						$catNoTable[$newCatNo[$i]] = $newIndex;
					}
				}
				
				if(isset($dels)) {
					$size = sizeof($dels);
					for ($i = $size-1; $i >= 0; $i--) {
						if ($dels[$i] == "")
							continue;
						if (!delOneCategory($dels[$i])) {
							//you cannot delete the category at this moment
						}
					}
				}
				
				$cats = getAllCategoriesNested();
				echo genCatTable($cats);
				
				function genCatTable($catArr) {
					$html = '<ul>';
					foreach ($catArr as $cat) {
						$html .= 
							'<li>
									<div class="centerVC rowRecord">
										<span class="centerV rowRecordContent">
											<button id="btnRemove" class="btnRestore btnRemove" type="button" onclick="removeCat(this);return false;"></button>
											<span>' . $cat[catNo] . '</span>
											<input id="dels" type="hidden" name="dels[]" value="" v="' . $cat[catNo] . '"/>
											<input id="catNo" type="hidden" name="catNo[]" value="' . $cat[catNo] . '"/>
											<input required type="text" name="catName[]" value="' . $cat[catName] . '"/>
											<button class="btnAdd" type="button" onclick="addNewCat(this)"></button>
										</span>
									</div>';
						if (isset($cat['subcat']))
							$html .= genCatTable($cat['subcat']);
						else
							$html .= '<ul></ul>';
						$html .= '</li>';
					}
					
					$html .= '</ul>';
					return $html;
				}
			?>
			<input class='btnSubmit btn' type='submit' value="Submit" onclick="inputValidate(document.forms['adminCatForm'])"/>
			</div>
		</div>
	</form>
	
	<li id='newCat' class="newCat" style="display:none">
		<div class="centerVC rowRecord newRowRecord">
			<span class="centerV rowRecordContent">
				<button class="btnRemove btnRestore" "type="button" onclick="removeNewCat(this);return false;"></button>
				<input id="catNo" type="hidden" name="newCatNo[]" value="" />
				<input id="catParent" type="hidden" name="newCatParent[]" value="" />
				<label>new</label>
				<input id="catName" required type="text" name="newCatName[]" value="prevent_required" />		
				<button class="btnAdd" type="button" onclick="addNewCat(this);"></button>
			</span>
		</div>
		<ul></ul>
	</li>

<?php include("footer.php"); ?>