<?php
	include_once "../Brain/functions.php";
	include_once "../Brain/Product.php";		
//	regPost($_POST["requestCode"], $_POST[suppNo]);
	$requestCode = 1;
	$suppNo = "S0001";
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
	}

	while($row = $chart->fetch_assoc())
	{
		$newArr["label"] = $row[prodName];
		$newArr["y"] = $row["Sold"];
		$array["data"][0]["dataPoints"][] = $newArr;
	}
	echo json_encode($array); 
	
?>
	