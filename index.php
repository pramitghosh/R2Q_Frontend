
<html>
	<head>
		
		<link rel="stylesheet" href="styles.css">
		<title>
			Massnahmenkatalog Frontend
		</title>		
				<script type="text/javascript" src = "selectdeselect.js"></script>		
	</head>
	<body>
		<div class = "filters">
			<?php
				include 'filters.php';
			?>
		</div>
		<div class = "results">
			<form action="details.php" method="GET">
				<label for="id">Bitte geben Sie Massnahmen ID ein, für die Direktsuche: </label>
				<input type="text" name="id">
				<input type="submit" value="Bestätigen">				
			</form>
			<?php
				if($post_set)
				{
					echo "<p class='filterHeader'>
						Suchergebnisse
						<br>
						</p>
						<table class='resultsTable'>
						<colgroup>
								<col style='width:600px'>
								<col style='width:100px'>
						</colgroup>
						<thead class='resultsTableHeader'>
							<td style='font-size: 22px;' >Name</td>
							<td style='font-size: 22px;' >Ressource</td>
						
						</thead>
						";
							/* $Parsedown = new Parsedown();
							echo $Parsedown->text('Hello _Parsedown_!'); # prints: <p>Hello <em>Parsedown</em>!</p> */
						
							if(mysqli_num_rows($result2) > 0)
							{
								//while($row = mysqli_fetch_assoc($result))
								foreach ($result2 as $row2)
								{
									//echo "<tr><td>" . $row2["id"] . "</td>";
									echo "<tr>";
									echo "<td>" . "<a href='details.php?id=" . $row2["id"] . "'>" . $row2["name"] . "</a>" . "</td>";
									echo "<td>" . $row2["ressource"] . "</td>";
									echo "</tr>";
									//echo "<td>" . $row2["kategorieIndex"] . "</td></tr>";
								}
							}					
							mysqli_close($conn);
						
					echo "</table>";
				}
			?>
		</div>
	</body>
</html>

