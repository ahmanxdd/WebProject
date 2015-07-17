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
				$GLOBALS[$k] = $_GET[$k];
		}	
	}
	
	function printThisDBResult($result) //For debug usage, print all Database result
	{
		$fields = $result->fetch_fields();
		$tables = array();
		$html_table;

		//start tag
		$html_table =  "<table border='1'>";		
		//header
		$html_table .= "<tr>";
		foreach($fields as $field)
		{
			$tables[$field->table] = 0;
			$html_table .= "<th>$field->name</th>";
		}
		$html_table .= "</tr>";
		
		//content
		while($row = $result->fetch_array())
		{
			$html_table.= "<tr>";
			for($i = 0; $i < $result->field_count; $i++)
				$html_table .= "<td>$row[$i]</td>";
			$html_table .= "</tr>";
		}
		
		//end tag
		$html_table .= "</table>";
		
		
		//printing
		echo "<b>Table:  </b>";
		foreach($tables as $key=>$value)
			echo $key . " ";
		echo $html_table;
	}
?>