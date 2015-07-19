<?php
	include_once "Brain/field_const.php";
	include_once "Brain/User.php";
	include("header1.php");
?>
<link href="css/register.css" rel="stylesheet" type="text/css" />
<script src='js/register.js'> </script>
<?php
	include("Brain/District.php");
	include "Brain/UserControl.php";
	include("header2.php"); 
	include_once "Brain/ShoppingCart.php";
	
	$cart = new SCart();	
	if(isset($_GET["error"]))
		echo "<script> alert('Sorry, we only delivery two day after order.')</script>";
	if(UserControl::checkState() && UserControl::getType() == 'c')
	{
		$cust = getCustomer(getInfo(UserControl::getUserNo())[ID]);
		
		if(isset($_POST[distNo], $_POST[custAddr],$_POST["sdate"]))
		{
			$date = strtotime($_POST["sdate"]);
			$minday = strtotime(date("Y-m-d", strtotime("+ 2 days")));
			
			if($date < $minday)
			{
				header("Location: checkout.php?error=true");			
			}
			else 
			{
	
				if($cart->checkout($_POST["sdate"], "100", $_POST[custAddr], $cust[custNo], $_POST[distNo]))	
				{				
					header("Location: shoppingcart.php?sucess=true");	
				}
				else
					echo "<script> alert('Sorry!');</script>";
					
			}
		}
		
		
		
		
		$district = getAllDistricts();

		
		$box = "<select name='distNo'>";
		while($row = $district->fetch_assoc())
		{
			if($row[distNo]  == $cust[distNo])
			{
				$box .= "<option selected value='".$row[distNo]."'>".$row[distName]."</option>";
			}
			else $box .= "<option value='".$row[distNo]."'>".$row[distName]."</option>";
			
		}
				$box .= "</select>";
	}
	else
	{
		echo "You must first login!";
		return;
	}
	
	
?>	
<?php
	
?>
<div class="outer">
<div class="middle">
<div class="inner col-50 col-m-100">

<h1>Check out</h1>
<form name="form1" action="checkout.php" method="POST">
	<table>
	<tr><td><label class="form_header">Your No</label></td></tr>
	<tr><td><input readonly type="text" name="custNo" value="<?php echo $cust[custNo];?>"/></td></tr>
	<tr><td><label  class="form_header">Your Name</label></td></tr>
	<tr><td><input readonly type="text" name="custName" value="<?php echo $cust[custName];?>"/></td></tr>
	<tr><td><label readonly class="form_header">Your Contact</label></td></tr>
	<td><input type="text" name="contact" value="<?php echo $cust[custTel];?>"/></td>
	
	<tr><td><label  class="form_header">Perfer delivery date</label></td></tr>
	<tr><td><input readonly type="date" name="sdate" value="<?php echo date("Y-m-d", strtotime("+2days"));?>"/></td></tr>	
	<tr><td><?php echo $box; ?></td></tr>
	<tr><td><label class="form_header">Your Delivery Address</label></td></tr>
	<tr><td><textarea rows="5" cols="50" name="custAddr" ><?php echo $cust[custAddr];?></textarea></td></tr>
	<tr><td colspan="2" align="right"><input type="submit" name="submit" value="Submit" class="btn" /></td></tr>
	</table>
</form>
</div>
</div>
</div>


<?php include("footer.php"); ?>