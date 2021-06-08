<div>
	<h3>Filters</h3>
	<form action = "index.php" method = "POST">
			<h4>Resource</h4>
			<p>
<!-- 				<select name="resourceform[]" multiple> -->
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
						
						mysqli_close($conn);
					?>
				</select>
			</p>
			<p>
				<input type = "Submit">&ensp;<input type = "Reset">
			</p>
		</form>
</div>
	