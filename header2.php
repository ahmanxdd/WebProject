</head>
<body>
	<div class="navBar_C">
		<div class="navBar inContent row">
			<div class="navLogo col-50 col-m-0">
				<div><a>Logo</a></div>
			</div>
			<div class="navTab col-8 col-m-15">
				<div><a href="products.php">Products</a></div>
			</div>
			<div class="navTab navTab_active col-8 col-m-15">
				<div><a href="admin_district.php">Admin</a></div>
			</div>
			<div class="navTab col-8 col-m-15">
				<div><a>Schedule</a></div>
			</div>
			<div class="navTab col-8 col-m-15">
				<div><a>Orders</a></div>
			</div>
			<div class="navTab col-8 col-m-15">
				<div><a href="shoppingCart.php">Chart</a></div>
			</div>
			<div class="navTab col-6 col-m-15">
				<div><a>Login</a></div>
			</div>
			
		</div>
	</div>
	
	<div class="loginPanel_C">
		<div class="loginPanel inContent">
			<label>Username</label>
			<input type="text" />
			<label>Password</label>
			<input type="password"/>
			<br/>
			<button type="submit">Login</button>
		</div>
	</div>
	
	<div class="content_C">
	 <?php
		include_once("Brain/functions.php");
		include_once("Brain/User.php");
		include_once("Brain/UserControl.php");
		regGet('login', 'pw');
		
		echo "<div>";
		if (isset($login) && isset($pw)) {
			if (UserControl::login($login, $pw)) {
				$loginUser = getUser(UserControl::getUserNo());
				echo 'Logged in as ' . $loginUser[userNo] . ' '. UserControl::getType() . '<br/>'
					. 'use $loginUser to get the the current user';
			}
			else {
				echo 'Login failed';
			}
		}
		else if (UserControl::checkState()) {
			$loginUser = getUser(UserControl::getUserNo());
			echo 'Already logged in as ' . $loginUser[userNo] . ' ' . UserControl::getType() . '<br/>'
				. 'user $loginUser to get the the current user';
		}
		else {
			echo 'Not logged in.';
		}
		
		echo '</div>';
	?>