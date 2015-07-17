<html>
<head>
<link rel="stylesheet" type='text/css' href='general.css'/>
<link rel='stylesheet' type='text/css' href='admin_table.css' />

<link rel="stylesheet" href="jquery_ui/jquery-ui.min.css">
<script src="jquery_ui/external/jquery/jquery.js"></script>
<script src="jquery_ui/jquery-ui.min.js"></script>


</head>
<body>
	<?php
		include_once('Brain/functions.php');
		include_once('Brain/Order.php');
		include_once('Brain/field_const.php');
		include_once('Brain/User.php');
		include_once('Brain/District.php');
		$orders = getAllOrders();
	?>
	
	<div class='row adminDataTable_c'>
		<div class='col-12'>
			<span class='adminTableTab'>Category</span>
			<span class='adminTableTab'>District</span>
			<span class='adminTableTab'>Orders</span>
		</div>
		
		<div>
			<form action='admin_order.php' method='get'>
				<span>Sort by:</span>
				<select name='sortBy'>
					<option value='prod'>Product</option>
					<option value='cat'>Category</option>
					<option value='dist'>District</option>
				</select>
				<input type="text" />
				<input type='submit' value='GO'/>
			</form>
		</div>
		<table id='adminDataTable' class='col-12 adminDataTable'>
			<tr>
				<th>Order No.</th>
				<th>Order Date</th>
				<th>Order Discount</th>
				<th>Customer Name</th>
				<th>Delivery Address</th>
				<th>District</th>
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
							<td>' . $o[deliAddr] . '</td>
							<td>' . $dist[distName] . '</td>
							<td> <a href="job_details.php?jobNo=' . $o[jobNo] . '">' . $o[jobNo] . '</a></td>
						</tr>';
				}							
			?>
			
		</table>
		
	</div>
</body>
</html>