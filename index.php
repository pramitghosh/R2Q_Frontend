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

        <!-- Slideshow container -->
<div class="slideshow-container">

<!-- Full-width images with number and caption text -->
<div class="mySlides fade">
    <!-- <div class="numbertext">1 / 3</div> -->
    <img class="LogoIntro" src="R2Q_Logo.png">
    <p style="text-align: justify">
        Platzhalter Einleitung:
        <br>
        Das Verbundprojekt R2Q - RessourcenPlan im Quartier - verfolgt das Ziel, die Verwendung der Ressourcen Wasser, 
        Stoffe, Energie und Fläche/Raum im Quartier zu untersuchen. 
        Aus den gewonnenen Erkenntnissen ist ein Katalog entstanden, der Maßnahmen vorstellt, die ein effizientes Bewirtschaften dieser Ressourcen ermöglicht.
    </p>
    <button class="massnahmenLink" onclick="window.location.href='massnahme.php';">
            Zum Katalog
    </button>
</div>

<div class="mySlides fade">
  <!-- <div class="numbertext">2 / 3</div> -->
  <h1> Vorgehen </h1>
  <p style="text-align: justify">
        <br>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem necessitatibus repellendus ipsa nihil pariatur? Ipsam sit error ullam repellendus dignissimos autem, a enim eum quis, ipsum quia voluptatem consequatur eaque?
    </p>
    <button class="massnahmenLink" onclick=window.location.href='massnahme.php';>
        Zum Katalog
    </button>
</div>

<div class="mySlides fade">
  <!-- <div class="numbertext">3 / 3</div> -->
  <h1> Der Katalog </h1>
  <p style="text-align: justify">
        <br>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem necessitatibus repellendus ipsa nihil pariatur? Ipsam sit error ullam repellendus dignissimos autem, a enim eum quis, ipsum quia voluptatem consequatur eaque?
    </p>
    <button class="massnahmenLink" onclick="window.location.href='massnahme.php';">
        Zum Katalog
    </button>
</div>

<!-- Next and previous buttons -->
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
<span class="dot" onclick="currentSlide(1)"></span>
<span class="dot" onclick="currentSlide(2)"></span>
<span class="dot" onclick="currentSlide(3)"></span>
</div>

        <!-- <div class="intro">
            
            
            <img class="LogoIntro" src="R2Q_Logo.png">
            <br>
            <p style="text-align: justify">
		    Platzhalter Einleitung:
            <br>
                Das Verbundprojekt R2Q - RessourcenPlan im Quartier - verfolgt das Ziel, die Verwendung der Ressourcen Wasser, 
                Stoffe, Energie und Fläche/Raum im Quartier zu untersuchen. 
                Aus den gewonnenen Erkenntnissen ist ein Katalog entstanden, der Maßnahmen vorstellt zur effizienten Bewirtschaftung dieser Ressourcen.
            </p>
            <button class="massnahmenLink" onclick="window.location.href='massnahme.php';">
            Maßnahmen
            </button>
        </div> -->
        <?php include 'footer.php'; ?>

        <script>
            var slideIndex = 1;
            showSlides(slideIndex);

            function plusSlides(n) {
            showSlides(slideIndex += n);
            }

            function currentSlide(n) {
            showSlides(slideIndex = n);
            }

            function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}    
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";  
            dots[slideIndex-1].className += " active";
            }
        </script>
    </body>
    
</html>

</div>