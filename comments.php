<h3>Comments</h3>

<?php 

	include 'sql.php';
	if (isset($_GET))
	{
		$id = $_GET["id"];
		if (isset($_POST["new_comment"]))
		{
			$new_comment = $_POST["new_comment"];
			if(!is_null($new_comment) or strlen(utf8_decode($new_comment)) > 0)
			{
				$insert_comment_sql = "INSERT INTO r2q.comments (`id`, `comment`) VALUES ('" . $id . "', '" . $new_comment . "')";
				$insertion_result = mysqli_query($conn, $insert_comment_sql);
				
				if(mysqli_affected_rows($conn) > 0)
					echo "<small>New comment inserted successfully!</small><br><br>";
			} else
			{
				echo "<small>Comment cannot be empty!</small><br><br>";
			}
		}
		
		$comments_sql = "SELECT * FROM r2q.comments WHERE id = " . $id;
		//echo $comments_sql;
		
		$comments_result = mysqli_fetch_all(mysqli_query($conn, $comments_sql));
		//var_dump($comments_result);
		
		$comments_count = count($comments_result);
		if($comments_count > 0)
		{
			for ($i = 0; $i < $comments_count; $i++)
			{
				echo $comments_result[$i][2] . "<br><hr width=75% align=left>";
			}
		}		
	}	
?>

<h4>Insert Comment</h4>
		<form action = "details.php?id=<?php echo $id;?>" method = "POST">				
  			<textarea id="new_comment" name="new_comment" rows=4 cols=50></textarea>
  			<br><br>
  			<input type = "Submit">&ensp;<input type = "Reset">
		</form>
		
		