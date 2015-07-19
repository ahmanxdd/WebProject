<?php include("header1.php"); ?>
<link rel="stylesheet" type="text/css" href="css/admin_table.css" />
<script src="scripts/admin_table.js"></script>
<title>Admin Category</title>
<?php include("header2.php"); ?>

	<?php include("admin_table_tabs.php") ?>
	<?php
		include_once('Brain/functions.php');
		include_once('Brain/Order.php');
		include_once('Brain/field_const.php');
		include_once('Brain/User.php');
		include_once('Brain/District.php');
		$orders = getAllOrders();
		
		regGet('searchBy', 'searchVal');
		if (isset($sortBy)) {
			
		}
	?>
	
	<div class='row adminTable_C'>
		<form action='admin_order.php' method='get'>
			<div class="filter_C col-m-100 iblk">
					<span class='col-m-100 iblk'>Search by:</span>
					<select name='searchBy'>
						<option value='prod'>Product</option>
						<option value='cat'>Category</option>
						<option value='dist'>District</option>
					</select>
					<input type="text" name="searchVal"/>
					<input class="btn" type='submit' value='GO'/>
			</div>
		</form>
		
		<table class="adminTable col-100" cellspacing="0">
			<tr>
				<th>Order No.</th>
				<th>Date</th>
				<th>Discount</th>
				<th>Customer</th>
				<th class="col-m-0">Delivery Address</th>
				<th class="col-m-0">District</th>
				<th>Delivery Job</th>
			</tr>
			
			<?php
				foreach ($orders as $o) {
					$cust = getCustomer($o[custNo]);
					$dist = getDistrict($o[distNo]);
					
					echo 
						'<tr>
							<td>' . $o[ordNo] . '</td>
							<td>' . $o[ordDate] . '</td>
							<td>' . $o[ordDiscount] . '</td>
							<td> <a href="cust_details.php?custNo=' . $cust[custName] . '">' . $cust[custName] . '</td>
							<td class="col-m-0">' . $o[deliAddr] . '</td>
							<td class="col-m-0">' . $dist[distName] . '</td>
							<td> <a href="job_details.php?jobNo=' . $o[jobNo] . '">' . $o[jobNo] . '</a></td>
						</tr>';
				}							
			?>
			
		</table>
		
<?php include("footer.php"); ?>