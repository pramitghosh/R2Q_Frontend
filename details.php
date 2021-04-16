<?php 
	require 'sql.php';
	$m_id = $_GET["id"];
	//echo mysqli_ping($conn) ? 'true' : 'false';
	
/* 	function m_values($id, $e1, $e2, $e3):mysqli_result
	{
		$q = "SELECT wert FROM joined_massnahme WHERE id = " . $id . " AND ebene1 = '" . $e1 . "'";
		if (!isset($e2)) {
			$q = $q . " AND ebene2 = '" . $e2 . "'";
			if(!isset($e3))
			{
				$q = $q . " AND ebene3 = '" . $e3 . "'";
			}
		}
		echo $q;
		$r = mysqli_query($conn, $q);
		return $r;
	}
	$details_r = m_values(1, 'Titel'); */
	
	function extract_wert($query_result)
	{
		$wert = "";
		foreach ($query_result as $qr)
			$wert = $qr["wert"];
		return $wert;
	}
	
	if (!is_null($m_id))
	{		
		$q_template = "SELECT wert FROM joined_massnahme WHERE id = " . $m_id . " AND ";
		
		$q_title = $q_template . " ebene1 = 'Titel'";
		
		
		
		$r_title = extract_wert(mysqli_query($conn, $q_title));	
	} else echo "Not a valid ID!";








?>

<html>
	<head>
		<link rel="stylesheet" href="styles.css">
		<title>
			Massnahmenkatalog Frontend
		</title>
	</head>
	<body>
		<div class = "filters">
			<?php
				include 'filters.php';
			?>
		</div>
		<div class = "results">
		<?php
			echo $r_title;
		
		
		
		
		
		
		
		
		?>
		
		</div>
	</body>
</html>