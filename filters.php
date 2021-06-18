


<div>
	<h3>Suche</h3>
		<form action = "index.php" method = "POST">			
  			<input type="text" id="massnahme_search" name="massnahme_search"><br><br>
  			<input type = "Submit" value = "Bestätigen">&ensp;<input type = "Reset" value = "Zurücksetzen">
		</form>


	<h3>Filter</h3>
	<form action = "index.php" method = "POST">
			<h4>Ressource</h4>
			<p>
					<!-- <select name="resourceform[]" multiple> -->
					<!-- <option value="">Select...</option> -->
					
				  	<?php
						require 'sql.php';

				  		$sql = "SELECT DISTINCT ebene2 FROM r2q.joined_massnahme2 WHERE ebene1 = 'Ressource'";
						$result = mysqli_query($conn, $sql);
	
						if(mysqli_num_rows($result) > 0)
						{							
							while($row = mysqli_fetch_assoc($result))
							{
								echo "<input checked='true' type='checkbox' name='resourceform[]' value='" . $row['ebene2'] . "'> " . $row['ebene2'] . "<br>";
							}
						}						
					?>
					<input type="button" onclick='selects("resourceform[]")' value="Alle auswählen"/>
					<input type="button" onclick='deSelect("resourceform[]")' value="Alle abwählen"/>
				
			</p>
			
			<h4>Funktion</h4>
			<p>
			<?php 
				$funcats = "SELECT DISTINCT ebene2 FROM r2q.joined_massnahme2 WHERE ebene1='Wirkung/Funktion'";
				$funcats_result = mysqli_fetch_all(mysqli_query($conn, $funcats));
								
				$funcats_count = count($funcats_result);
				
				if($funcats_count > 0)
				{
					for ($i = 0; $i < $funcats_count; $i++)
					{
						$this_cat = $funcats_result[$i][0];
						echo "<b>" . $this_cat . "</b><br>";
						
						$funs_query = "SELECT DISTINCT ebene3 FROM r2q.joined_massnahme2 WHERE ebene2='" . $this_cat . "' AND ebene1='Wirkung/Funktion'";
						$funs_result = mysqli_fetch_all(mysqli_query($conn, $funs_query));
						#var_dump($funs_result);
						
						$funs_count = count($funs_result);
						
						if($funs_count > 0)
						{
							for ($j = 0; $j < $funs_count; $j++)
							{
								echo "<input checked='true' type='checkbox' name='functionsform[]' value='" . $funs_result[$j][0] . "'>" . $funs_result[$j][0] . "<br>";
							}
						}
					}
				}				
			?>
			<input type="button" onclick='selects("functionsform[]")' value="Alle auswählen"/>
			<input type="button" onclick='deSelect("functionsform[]")' value="Alle abwählen"/>
			</p>
			
			<h4>Anwendungsebene</h4>
			<p>
			<?php 
				$anwendung_query = "SELECT DISTINCT ebene2 FROM r2q.joined_massnahme2 WHERE ebene1='Anwendungsebene'";
				$anwendungs_result = mysqli_fetch_all(mysqli_query($conn, $anwendung_query));
				
				$anwendungs_count = count($anwendungs_result);
				
				if($anwendungs_count > 0)
				{
					for ($i = 0; $i < $anwendungs_count; $i++)
					{
						echo "<input checked='true' type='checkbox' name='anwendungsform[]' value='" . $anwendungs_result[$i][0] . "'>" . $anwendungs_result[$i][0] . "<br>";
					}
				}				
			?>
			<input type="button" onclick='selects("anwendungsform[]")' value="Alle auswählen"/>
			<input type="button" onclick='deSelect("anwendungsform[]")' value="Alle abwählen"/>
			
			
			
			<?php mysqli_close($conn); ?>
			<p>
				<input type = "Submit" value = "Bestätigen">&ensp;<input type = "Reset" value = "Zurücksetzen">
			</p>
		</form>
</div>
	