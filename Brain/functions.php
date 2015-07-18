<?php
	function regGet() {	//register get query values specified in the parameter list
		foreach (func_get_args() as $k) {
			if (isset($_GET[$k]))
				$GLOBALS[$k] = $_GET[$k];
		}	
	}
	
	function regPost() {	//register form values specified in the parameter list
		foreach (func_get_args() as $k) {
			if (isset($_POST[$k]))
				$GLOBALS[$k] = $_POST[$k];
		}	
	}
	
	function printThisDBResult($result) //For debug usage, print all Database result
	{
		if(!isset($result) || !$result)
		{
			echo "個 result 乜都冇, 冇野睇呀, 你想點Print ar?";
			return false;
		}
		$fields = $result->fetch_fields();

		$tables = array();

	
		//header
		$html_tBody = "<tr>";
		foreach($fields as $field)
		{
			$tables[$field->table] = 0;
			$html_tBody .= "<th>$field->name</th>";
		}
		$html_tBody .= "</tr>";
		
		//content
		while($row = $result->fetch_array())
		{
			$html_tBody.= "<tr>";
			for($i = 0; $i < $result->field_count; $i++)
				$html_tBody .= "<td>$row[$i]</td>";
			$html_tBody .= "</tr>";
		}
		
		//start tag
		$html_table =  "<table border='1'>";	
		$html_table .= "<caption style='text-align:left;border:1px solid black; border-bottom: none;'>";
				$html_table .= "<b>Table:  </b>";
		foreach($tables as $key=>$value)
			$html_table .= $key . " ";
		$html_table .= "</caption>";
		
		
		//end tag
		$html_table .= $html_tBody . "</table>";
		
		echo $html_table;
		

	}
?>