<?php include("header1.php"); ?>
<style>
	.a, .b, .c {
		margin-top: 10px;
		margin-left: 10px;
		display: inline-block;
	}
	
	.a{
		background: red;
		min-width: 500px;
	}
	
	.b{
		background: green;
		min-width: 500px;
	}
	
	.c {
		background: yellow;
	}
</style>

<?php include("header2.php"); ?>
	<div class="test row">
		<div class="a col-30 col-m-100">
			<span>Name:</span>
			<input type="text" />
		</div>
		<div class="b col-30 col-m-100">
			<span>Name:</span>
			<input type="text" />
		</div>
	</div>
<?php include("footer.php"); ?>