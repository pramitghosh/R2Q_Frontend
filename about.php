<?php 
	require_once 'sql.php';
	
	$post_set = $_POST?1:0;
		
?>

<html>
	<head>
		
		<link rel="stylesheet" href="styles.css">
		
		<title>
			Massnahmenkatalog Frontend
		</title>		
		<script type="text/javascript" src = "selectdeselect.js"></script>
		<link href='fontawesome-free-5.15.4-web/css/all.css' rel="stylesheet">
	</head>
	<body>
		<div class="page-container">
			
			<?php
				include 'NavBar.php';
			?>
			
				<div class = "aboutContent">
					<h3  style = "width: 1000px; text-align: justify;"> Über </h3>
				</div>
			<?php include 'footer.php'; ?>
			
		</div>
		
	</body>
</html>
