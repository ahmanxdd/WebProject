<html>
<head>
<link rel="stylesheet" type='text/css' href='general.css'/>
<link rel='stylesheet' type='text/css' href='admin_table.css' />

<link rel="stylesheet" href="jquery_ui/jquery-ui.min.css">
<script src="jquery_ui/external/jquery/jquery.js"></script>
<script src="jquery_ui/jquery-ui.min.js"></script>

<script src='admin_table.js'></script>

<script>

</script>
</head>
<body>
	<form action="admin_cat.php" method="post">
		<?php
			include_once('Brain/field_const.php');
			include_once('Brain/functions.php');
			include_once('Brain/Category.php');
			
			regPost('catNo', 'catName', null);
			if (isset($catNo)) {
				//from post method
				$size = sizeof($catNo);
				for ($i = 0; $i < $size; $i++)
					updateCategory($catNo[$i], $catName[$i]);
			}
			
			
			$cats = getAllCategoriesNested();
			echo genCatTable($cats);
			
			function genCatTable($catArr) {
				$html = '<ul>';
				foreach ($catArr as $cat) {
					$html .= 
						'<li>
							<div>
								<button type="button" onclick="removeCat(this)">Remove</button>
								<span>' . $cat[catNo] . '</span>
								<input type="hidden" name="dels[]" value="" v="' . $cat[catNo] . '"/>"
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
	</form>
	
	<li id='newCat' style="display:none">
		<div>
			<button type="button" onclick="removeNewCat(this)">Remove</button>
			<input id="catNo" type="hidden" name="newCatNo[]" value="" />
			<input id="catName" type="text" name="newCatName[]" value="" />
			<input id="catParent" type="hidden" name="newCatParent[]" value="" />
			<button type="button" onclick="addNewCat(this);">add</button>
		</div>
		<ul></ul>
	</li>
	
</body>
</html>