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
	<?php
		include_once('Brain/Category.php');
		$cats = getAllCategoriesNested();
		echo genCatTable($cats);
		
		function loopcat($catArr, $prefix) {
			foreach ($catArr as $c) {
				echo $prefix . $c[catName] . '<br/>';
				if (isset($c['subcat'])) {
					loopcat($c['subcat'], $prefix.'-');
				}
			}
		}
		
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
</body>
</html>