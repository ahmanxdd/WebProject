</head>
<body>
	<?php
		error_reporting(0);
		include_once("Brain/functions.php");
		include_once("Brain/User.php");
		include_once("Brain/UserControl.php");
		regPost('login', 'pw');
		
		echo "<div>";
		// if (isset($login) && isset($pw)) {
		// 	if (UserControl::login($login, $pw)) {
		// 		$loginUser = getUser(UserControl::getUserNo());
		// 		echo 'Logged in as ' . $loginUser[userNo] . ' '. UserControl::getType() . '<br/>'
		// 			. 'use $loginUser to get the the current user';
		// 	}
		// 	else {
		// 		echo 'Login failed';
		// 	}
		// }
		// else if (UserControl::checkState()) {
		// 	$loginUser = getUser(UserControl::getUserNo());
		// 	echo 'Already logged in as ' . $loginUser[userNo] . ' ' . UserControl::getType() . '<br/>'
		// 		. 'user $loginUser to get the the current user';
		// }
		// else {
		// 	echo 'Not logged in.';
		// }
		// 
		// echo '</div>';
	?>
	
	<div class="navBar_C">
		<div class="navBar inContent row">
			<div class="navLogo col-50 col-m-0">
				<div><a class="navIcon">Logo</a></div>
			</div>
			<div class="navTab col-10 col-m-20">
				<div><a class="navIcon" href="products.php">Products</a></div>
			</div>
			<?php if (UserControl::getType() == 'a') { ?>
			<div class="navTab navTab_active col-10 col-m-20">
				<div><a class="navIcon" href="admin_district.php">Admin</a></div>
			</div>
			<?php }?>
			<?php if (UserControl::getType() == 'd') { ?>
			<div class="navTab col-10 col-m-20">
				<div><a class="navIcon">Schedule</a></div>
			</div>
			<?php }?>
			<?php if (UserControl::getType() == 'c') { ?>
			<div class="navTab col-10 col-m-20">
				<div><a class="navIcon"s>Orders</a></div>
			</div>
			<?php }?>
			<?php if (UserControl::getType() == 'c') { ?>
			<div class="navTab navCart col-10 col-m-20">
				<div>
					<span class="fa fa-2x fa-shopping-cart cartIcon navIcon" onclick="window.location='shoppingCart.php'"></span>
					<div class="cartMenu">
						<ul>
							<?php
								include_once("Brain/ShoppingCart.php");
								$cart = new SCart();
								$html = SCart::genCartMenuHtml($cart->getProducts());
								echo $html;
							?>
						</ul>
						<button onclick="window.location='shoppingCart.php'">VIEW CART</button>
					</div>
				</div>
			</div>
			<?php }?>
			<div class="navTab col-10 col-m-20">
				<div><span class="fa fa-2x fa-search userIcon navIcon" onclick="showSearchBar()"></span></div>
			</div>
			<div class="navTab col-10 col-m-20">
				
				<?php 
					include_once("UserControl.php");
					echo '<div><span class="fa fa-2x fa-user userIcon navIcon" onclick="';
					if (UserControl::checkState())
						echo "window.location = 'profile.php?userNo=" . UserControl::getUserNo() . "'\"";
					else
						echo 'showLoginPanel()';
					echo "\"></span></div>";
				?>
			</div>
			
			
			
		</div>
		
		<div class="searchBar">
			<form action="products.php" method="get" style="margin:0;">
				<div class="searchInfo_C" style="width:700px">
					<label>Name:</label>
					<input type="text" name="prodName" />
				</div>
				<div class="searchInfo_C" style="width:400px">
					<label>Price:</label>
					<input type="text" name="priceMin" />
					-
					<input type="text" name="priceMax" />
				</div >
				<div class="searchInfo_C" style="width:500px;margin-bottom:0px">
					<label>Category</label>
					<select name="catNo">
					<?php
						include_once("Brain/Category.php");
						$cats = getAllCategories();
						echo genAllOptionsHtml($cats);
					?>
					</select>
				</div>
				<button class="fa fa-2x fa-search btnSearch"></button>
				<span class="fa fa-times clsSearchBar" onclick="closeSearchBar()"></span>
			</form>
		</div>
	</div>
	</div>
	
	
	
	<div class="loginPanel_C">
		<span class="clsLoginPanel fa fa-2x fa-times clsSearchBar" onclick="closeLoginPanel()"></span>
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
	
	<div id="bigContainer">
	<div class="content_C">
	 <?php
	?>