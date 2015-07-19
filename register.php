<?php
	include_once "Brain/field_const.php";
	include_once "Brain/User.php";
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
<?php
	if(isset($_POST['submit']))
	{	
		$loginName = $_POST['loginName'];
		$custName = $_POST['custName'];
		$loginPswd = $_POST['loginPswd'];
		$rePswd = $_POST['rePswd'];
		$custName = $_POST['custName'];
		$custGender = $_POST['custGender'];
		$custDOB = $_POST['custDOB'];
		$custTel = $_POST['custTel'];
		$distNo = $_POST['distNo']; 
		$custAddr = $_POST['custAddr'];
		
		if(count(getUserNoByLoginName($loginName)) != 0)
			echo "<script> alert('The username already exist!, please change other one!')</script>";
		else if($loginPswd != $rePswd)
			echo "<script> alert('Password and re-enter password must be same!')</script> ";
		else if($custAddr == "")
			echo "<script> alert('Please enter Address!')</script>";
		else{
			if (addUser($loginName, $loginPswd)){
				if (regCustomer(getUserNoByLoginName($loginName), $custName, $custGender, $custDOB, $custTel, $custAddr, $distNo)){
					echo "<script> alert('Successful register!')</script>";
					unset($_POST);
				}else {
					delUser(getUserNoByLoginName($loginName));
					echo "<script> alert('Unsuccessful register!')</script>";
				}
					
			}else 
				echo "<script> alert('Unsuccessful register!')</script>";
		}

	}
?>
<div class="outer">
<div class="middle">
<div class="inner col-50 col-m-100">

<h1>Register</h1>
<form name="form1" action="register.php" method="POST">
	<table>
	<tr><td><label class="form_header">Username</label></td></tr>
	<tr><td><input required type="text" name="loginName" value="<?php echo isset($_POST['loginName']) ? $_POST['loginName'] : '' ?>"/></td></tr>
	<tr><td><label  class="form_header">Password</label></td></tr>
	<tr><td><input required type="password" name="loginPswd"/></td></tr>
	<tr><td><label class="form_header">Re-enter your password</label></td></tr>
	<td><input required type="password" name="rePswd"/></td>
	<tr><td><label class="form_header">Your full Name</label></td></tr>
	<tr><td><input required type="text" name="custName" value="<?php echo isset($_POST['custName']) ? $_POST['custName'] : '' ?>"/></td></tr>
	<tr><td><label class="form_header">Gender</label></td></tr>
	<tr><td><input  required type="radio" name="custGender" value="M" ><M>Male</M>
	<input type="radio" name="custGender" value="F" ><F>Female</F></td></tr>
	<tr><td><label class="form_header">Birthday</label></td></tr>
	<tr><td><input required type="date" name="custDOB" value="<?php echo isset($_POST['custDOB']) ? $_POST['custDOB'] : '' ?>"/></td></tr>
	<tr><td><label class="form_header">Contact</label></td></tr>
	<tr><td><input required type="number" name="custTel" pattern="[0-9]" value="<?php echo isset($_POST['custTel']) ? $_POST['custTel'] : '' ?>"/></td></tr>
	<tr><td><label class="form_header">District</label></td></tr>
	<tr><td><?php echo $box; ?></td></tr>
	<tr><td><label class="form_header">Your Address</label></td></tr>
	<tr><td><textarea rows="5" cols="50" name="custAddr" ><?php echo isset($_POST['custAddr']) ? $_POST['custAddr'] : '' ?></textarea></td></tr>
	<tr><td colspan="2" align="right"><input type="submit" name="submit" value="Submit" class="btn" /></td></tr>
	</table>
</form>
</div>
</div>
</div>


<?php include("footer.php"); ?>