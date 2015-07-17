<html>
<head>
<link rel="stylesheet" type='text/css' href='general.css'/>
<link rel='stylesheet' type='text/css' href='admin_table.css' />

<link rel="stylesheet" href="jquery_ui/jquery-ui.min.css">
<script src="jquery_ui/external/jquery/jquery.js"></script>
<script src="jquery_ui/jquery-ui.min.js"></script>

<script src='admin_table.js'></script>

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
								<span>' . $cat[catNo] . '</span>
								<input type="hidden" name="catNo[]" value="' . $cat[catNo] . '"/>
								<input type="text" name="catName[]" value="' . $cat[catName] . '"/>
								<button type="button"> add </button>
							</div>';
					if (isset($cat['subcat']))
						$html .= genCatTable($cat['subcat']);
					$html .= '</li>';
				}
				
				$html .= '</ul>';
				return $html;
			}
		?>
		<input type='submit' />
	</form>
	
</body>
</html>