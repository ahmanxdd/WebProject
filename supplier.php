<html>
<body>
	<table>
		<?php
			include_once("Brain/User.php");
			include_once("Brain/functions.php");
			
			regGet('suppNo');
			if (isset($suppNo)) {
				$supp = getSupplier($suppNo);
				echo 
					'<tr>
						<th>Supplier ID</th>
						<td>' . $supp[suppNo] . '</td>
					</tr>
					<tr>
						<th>Supplier Name</th>
						<td>' . $supp[suppName] . '</td>
					</tr>
					<tr>
						<th>Tel.</th>
						<td>' . $supp[suppTel] . '</td>
					<tr>
						<th>Address</th>
						<td>' . $supp[suppAddr] . '</td>
					</tr>';
			}
			else {	//show all suppliers
				$supps = getAllSuppliers(suppName, "ASC");
				
				echo
					'<tr>
						<th>Supplier ID</th>
						<th>Supplier Name</th>
						<th>Tel</th>
						<th>Address</th>
					</tr>';
				foreach ($supps as $s) {
					echo
					'<tr>
						<td>' . $s[suppNo] . '</td>
						<td>' . $s[suppName] . '</td>
						<td>' . $s[suppTel] . '</td>
						<td>' . $s[suppAddr] . '</td>
					</tr>';
				}
			}
		?>
	</table>
</body>
</html>