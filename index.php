<?php 
include 'parsedown-1.7.4/Parsedown.php';
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<link rel="stylesheet" href="start_styles.css">
        <title>
			Massnahmenkatalog Frontend
		</title>
                
    </head>
    <body class ="start" >
        <?php
			include 'NavBar.php';
		?>
        <div class="intro">
            
            
            <img class="LogoIntro" src="R2Q_Logo.png">
            <br>
            <p>
		    Platzhalter Einleitung:
            <br>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto expedita laboriosam id, voluptate recusandae, a vitae libero eaque necessitatibus repellendus cum maiores accusamus consequatur fuga debitis sed illum dignissimos. Est?
	        </p>
            <button class="massnahmenLink" onclick="window.location.href='massnahme.php';">
            Maßnahmen
            </button>
        </div>
        <?php include 'footer.php'; ?>
    </body>
    
</html>

</div>