<?php
	include_once "../Brain/functions.php";
	include_once "../Brain/Product.php";		
	$requestCode = $_POST["requestCode"];
	$suppNo =  $_POST[suppNo];
	$array["title"]["text"] = "Result";
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
	}

	while($row = $chart->fetch_assoc())
	{
		$newArr["label"] = $row[prodName];
		$newArr["y"] = intval($row["Sold"]);
		$array["data"][0]["dataPoints"][] = $newArr;
	}
	echo json_encode($array); 
	
?>
	