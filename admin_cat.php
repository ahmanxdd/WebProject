<?php include("header1.php"); ?>
<link rel="stylesheet" type="text/css" href="css/admin_table.css" />
<script src="scripts/admin_table.js"></script>
<title>Admin Category</title>
<?php include("header2.php"); ?>

	<form action="admin_cat.php" method="post">
		<div id="adminCat_C">
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
							<div>
								<button id="btnRemove" type="button" onclick="removeCat(this)">Remove</button>
								<span>' . $cat[catNo] . '</span>
								<input id="dels" type="hidden" name="dels[]" value="" v="' . $cat[catNo] . '"/>
								<input id="catNo" type="hidden" name="catNo[]" value="' . $cat[catNo] . '"/>
								<input type="text" name="catName[]" value="' . $cat[catName] . '"/>
								<button type="button" onclick="addNewCat(this)"> add </button>
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
		<input type='submit' />
		</div>
	</form>
	
	<li id='newCat' class="newCat" style="display:none">
		<div>
			<button type="button" onclick="removeNewCat(this)">Remove</button>
			<input id="catNo" type="hidden" name="newCatNo[]" value="" />
			<input id="catName" type="text" name="newCatName[]" value="" />
			<input id="catParent" type="hidden" name="newCatParent[]" value="" />
			<button type="button" onclick="addNewCat(this);">add</button>
		</div>
		<ul></ul>
	</li>

<?php include("footer.php"); ?>