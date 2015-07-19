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
			<div class="navTab navCart col-8 col-m-15">
				<div>
					<span class="fa fa-2x fa-shopping-cart cartIcon" onclick="window.location='shoppingCart.php'"></span>
					<div class="cartMenu">
						<ul>
							<?php
								include_once("Brain/ShoppingCart.php");
								$cart = new SCart();
								echo SCart::genCartMenuHtml($cart->getProducts());
							?>
						</ul>
						<button onclick="window.location='shoppingCart.php'">VIEW CART</button>
					</div>
				</div>
			</div>
			<div class="navTab col-6 col-m-15">
				<div><span class="fa fa-2x fa-user userIcon" onclick="showLoginPanel()"></span></div>
			</div>
			
		</div>
	</div>
	
	<div class="loginPanel_C">
		<div class="loginPanel inContent">
			<form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">	
				<label>Username</label>
				<input type="text" name="login"/>
				<label>Password</label>
				<input type="password" name="pw"/>
				<br/>
				<button type="submit">Login</button>
			</form>
		</div>
	</div>
	
	<div class="content_C">
	 <?php
		include_once("Brain/functions.php");
		include_once("Brain/User.php");
		include_once("Brain/UserControl.php");
		regPost('login', 'pw');
		
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