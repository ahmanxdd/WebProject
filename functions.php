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
<?