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
			
			<div class="mainContent">
				<div class = "filters">
					<?php
						include 'filters.php';
					?>
				</div>
				<div class = "refContent">
					<h3  style = "width: 1000px; text-align: justify;"> Bildverweise </h3>
					<table class="refTable" style="border-top: 2px solid black" >
						<colgroup>
							<col style='width:30%'>
							<col style='width:70%'>
						</colgroup>
						<thead class='search'>
							<td style='font-size: 25px;' >Bild &nbsp;</td>
							<td style='font-size: 25px;' >Quelle &nbsp;</td>
						</thead>
						<tbody>
							<tr class="refRow">
								<td style="padding: 3px 5px">Hintergrundbild Startseite</td>
								<td style="padding: 3px 5px">CHUTTERSNAP, 04.09.2017, <a href="https://unsplash.com/photos/oqJxJ4TYoQg"> https://unsplash.com/photos/oqJxJ4TYoQg</a> </td>
							</tr>
							<tr class="refRow">
								<td style="padding: 3px 5px">Hintergrundbild Maßnahmenkatalog</td>
								<td style="padding: 3px 5px">Danist Soh, 05.01.2016, <a href="https://unsplash.com/photos/dqXiw7nCb9Q"> https://unsplash.com/photos/dqXiw7nCb9Q</a> </td>
							</tr>
							<!-- <tr class="searchrow">
								<td></td>
								<td></td>
								<td></td> -->
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<?php include 'footer.php'; ?>
			
		</div>
		
	</body>
</html>
