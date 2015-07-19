<?php
	include_once "Brain/field_const.php";
	include("header1.php");
?>
<link href="css/register.css" rel="stylesheet" type="text/css" />
<script src='js/register.js'> </script>
<?php
	include("Brain/District.php"); 
	include("header2.php"); 
	$district = getAllDistricts();
	$box = "<select name='distNo'>";
	while($row = $district->fetch_assoc())
		$box .= "<option value='".$row[distNo]."'>".$row[distName]."</option>";
	$box .= "</select>";
?>


<div class="outer">
<div class="middle">
<div class="inner col-50 col-m-100">

<h1>Register</h1>
<form action="register.php" method="POST">
	<table>
	<tr><td><label class="form_header">Username</label></td></tr>
	<tr><td><input required type="text" name="loginName"/></td></tr>
	<tr><td><label required class="form_header">Password</label></td></tr>
	<tr><td><input type="password" name="loginPswd"/></td></tr>
	<td><label class="form_header">Re-enter your password</label></td></tr>
	<td><input required type="password" name="rePswd"/></td></tr>
	<tr><td><label class="form_header">Your full Name</label></td></tr>
	<tr><td><input required type="password" name="custName"/></td></tr>
	<tr><td><label class="form_header">Gender</label></td></tr>
	<tr><td><input type="radio" name="custGender" value="M"/><M>Male</M>
	<input type="radio" name="custGender" value="F"/><F>Female</F></td></tr>
	<tr><td><label class="form_header">Birthday</label></td></tr>
	<tr><td><input required type="date" name="custDOB"/></td></tr>
	<tr><td><label class="form_header">Contact</label></td></tr>
	<tr><td><input required type="tel" name="custTel"/></td></tr>
	<tr><td><label class="form_header">District</label></td></tr>
	<tr><td><?php echo $box; ?></td></tr>
	<tr><td><label class="form_header">Your Address</label></td></tr>
	<tr><td><textarea rows="5" cols="50"name="custAddr"> </textarea></td></tr>
	<tr><td colspan="2" align="right"><input type="submit" class="btn" /></td></tr>
</form>
</div>
</div>
</div>


<?php include("footer.php"); ?>