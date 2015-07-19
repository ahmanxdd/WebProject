<?php
	include_once "../Brain/functions.php";
	include_once "../Brain/Product.php";		
	$requestCode = $_POST["requestCode"];
	$suppNo =  $_POST[suppNo];
	$array["title"]["text"] = $_POST['title'];
	$array["animationEnabled"] = "true";
	$array["data"][0]["type"] = "column";
	
	switch($requestCode)
	{
		case 1:
			$chart = getSalesSummaryByGender($suppNo);			
			$chart = $chart["M"];
			break;
		case 2:
			$chart = getSalesSummaryByGender($suppNo);			
			$chart = $chart["F"];
			break;
		case 3:
			$chart = getSalesSummaryByDistrict($suppNo,"DST01");			
			break;
		case 4:
			$chart = getSalesSummaryByDistrict($suppNo,"DST02");			
			break;
		case 5:
			$chart = getSalesSummaryByDistrict($suppNo,"DST03");			
			break;
		case 6:
			if(isset($_POST[catNo]))
			{
				$chart = getSalesSummaryByCat($suppNo, $_POST[catNo]);
				break;
			}
			else return null;
	}
	if(!$chart)
		return json_encode($array); 
	while($row = $chart->fetch_assoc())
	{
		$newArr["label"] = $row[prodName];
		$newArr["y"] = intval($row["Sold"]);
		$array["data"][0]["dataPoints"][] = $newArr;
	}
	echo json_encode($array); 
	
?>
	