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
		include_once('Brain/functions.php');
		include_once('Brain/District.php');
		include_once('Brain/field_const.php');
		
		regPost('distNo', 'distName', 'newDistName', 'dels');
		
		updateDistrict("DST01", "aaaa");
		
		if (isset($distNo)) {
			//handle add/modify/delete;
			foreach ($newDistName as $newD) {
				if ($newD != "") {
					addDistrict($newD);
				}
			}
			
			$dists = sizeof($distNo);
			for ($i = 0; $i < $dists; $i++) {
				updateDistrict($distNo[$i], $distName[$i]);
			}
			
			foreach ($dels as $delDistNo) {
				if (!delDistrict($delDistNo)) {
					//cannot delete district message
				}
			}
		}
		
	?>
	
	<div class='row adminDataTable_c'>
		<div class='col-12'>
			<span class='adminTableTab'>Category</span>
			<span class='adminTableTab'>District</span>
			<span class='adminTableTab'>Orders</span>
		</div>
		
		<form action='admin_table.php' method='post'>
			<table id='adminDataTable' class='col-12 adminDataTable'>
				<tr>
					<th>Delete </th>
					<th>District ID</th>
					<th>District Name</th>
				</tr>
				
				<?php
					$districts = getAllDistricts();
					foreach ($districts as $d) {
						echo 
							'<tr>
								<input type="hidden" name="distNo[]" value="'. $d[distNo] . '"/>
								<td> <input type="checkbox" name="dels[]" value="'. $d[distNo] . '"/> </td>
								<td>' . $d[distNo] . '</td>
								<td> <input type="text" name="distName[]" value="'. $d[distName] . '"/> </td>
							</tr>';
					}							
				?>

				
				<tr class='adminNewRecord' style='display:none'>
					<td> New record </td>
					<td> <input type='text' name='newDistName[]' value=''/> </td>
				</tr>
			</table>
			<button type='button' onclick='addNewRecord()'>ADD</button>
			<input type='submit' />
		</form>
	</div>
</body>
</html>