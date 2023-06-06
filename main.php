<?php
	require_once __DIR__.'../boot.php';
	$user = null;
	error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
	<head>
      <title>Chinese novel</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <meta charset="UTF-8">
	  <!--Linking external files-->
	  <link rel="stylesheet" href="style.css">
	  <link rel="icon" sizes="512x512" href="content\icons\great-wall-of-china.png" type="image/png">
	  <script src="appearance.js"></script>
	  <script src="https://unpkg.com/react@16/umd/react.development.js" crossorigin defer></script>
	  <script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js" crossorigin defer></script>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	</head>
	<body>
		<?php 
			flash(); 
		?>
		<div class="box" onClick="$('#page').load('/../game.php')">
		<!--Navigation panel-->
			<nav class="box width100">
				<div class="box width40" id="navigation"></div>
				<script>
					$('#navigation').load("/ajax/nav-panel.php");
				</script>	
				<div class="userInfo topmargin" id="user-info"></div>
				<script>
					$('#user-info').load("/ajax/user-info.php");
				</script>
			</nav>
		</div>
		<div class="box topmargin" id="page"></div>
		<script>
			$('#page').load('/../game.php');
		</script>
	</body>
</html>