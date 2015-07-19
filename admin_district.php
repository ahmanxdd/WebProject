<?php include("header1.php") ?>
<link rel="stylesheet" type="text/css" href="css/admin_table.css" />
<script src='scripts/admin_table.js'></script>
<?php include("header2.php") ?>
	<?php include("admin_table_tabs.php") ?>
	<?php
		include_once('Brain/functions.php');
		include_once('Brain/District.php');
		include_once('Brain/field_const.php');
		
		regPost('distNo', 'distName', 'newDistName', 'dels');
				
		if (isset($distNo)) {
			//handle add/modify/delete;
			foreach ($newDistName as $newD) {
				if ($newD != "prevent_required") {
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
	
	<div class='row adminTable_C'>
		<form id="adminDistForm" action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>
			<table class="adminTable col-100" cellspacing="0">
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
								<td> <input type="text" required name="distName[]" value="'. $d[distName] . '"/> </td>
							</tr>';
					}							
				?>

				
				<tr class='adminNewDistrict' style='display:none'>
					<td><button type="button" class="btnRemove" onclick="removeNewDistrict(this)"/> </td>
					<td> New </td>
					<td> <input id="newDistName" type='text' name='newDistName[]' value="prevent_required" required /> </td>
				</tr>
			</table>
			<button class="btnAdd" type='button' onclick='addNewDistrict()'></button>
			<br/><br/>
			<input class="btnSubmit btn" onclick="inputValidate(document.forms['adminDistForm'])" type='submit' value="Submit"/>
		</form>
	</div>
</body>
</html>