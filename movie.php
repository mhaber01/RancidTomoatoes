# RancidTomoatoes
Web Programming - Project 3

<?php
	# Gets film title from URL
	$film = $_GET["film"];
	
	# Implements film title into code
	$basename = $film."/";
	$info = file($basename."info.txt");
	$overview = file($basename."overview.txt");
	$reviews = glob($basename."review*.txt");
?>

<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>Rancid Tomatoes</title>
		<link href = "movie.css" type = "text/css" rel = "stylesheet" />
		<link href = "rotten.gif" type = "image/ico" rel = "shortcut icon" />
		<meta charset = "utf-8" />
		<meta name = "author" content = "Megan Haber" />
		<meta name = "description" content = "CMPT 241 Project 3" />
		
	</head>
	
	<body>
		
		<!-- Banner on top of page -->
		<div id = "banner">
			<img src = "banner.png" alt = "Rancid Tomatoes">
		</div>
		
		<!-- Displays film title and year from file -->
		<h1>
			<?=$info[0]." (".trim($info[1]).")"?>
		</h1>
		
		<div id = "content-area">
		<div id = "rotten-background">
		
		<!-- General Overview -->
		<div id = "general-overview">
		
		<!-- Displays overview picture -->
			<div>
			<img src = "<?=$basename?>/overview.png" alt = "general overview" />
			</div>
			
		<!-- Prints from overview file -->
			<dl>
			<?php
				foreach($overview as $line){
					$lines = explode(":", $line);
				?>
					<dt><?=$lines[0]?></dt>
					<dd><?=$lines[1]?></dd>
				<?php
				}
			?>
			</dl>
		</div>

		<!-- if/else statement use -->
		<!-- Uses percentage in file to see if movie needs Rotten or Fresh picture -->
		<div id = "rottenOrFresh">
			<?php 
			if ($info[2] >= 60) {
			?>
				<img src = "freshbig.png" alt = "Fresh" />
			<?php 
			}
			else {
			?>
				<img src = "rottenbig.png" alt = "Rotten" />
			<?php
			}
			?>
		
		<!-- Then displays percentage -->
			<span id = "rating">
			<?=$info[2]?>%
			</span>
		</div>
		
		<!-- Reviews and Columns-->
		<div id = "all-reviews">
		<div class = "columns">
			<?php
				# Count records how many critics are on website
				$count = 0;
				
				# Loops through review file
				foreach($reviews as $review){
				
				# Creates an array named critic
					$critic = file($review);
				?>
				<p class = "review">
					<?php
					
				# if/else statment used
				# Uses key word "ROTTEN" to figure out which picture to display
						if (strcasecmp($critic[1], "ROTTEN") == 1) {
					?>
						<img class = "freshOrRotten" src = "rotten.gif" alt = "Rotten" />
					<?php
						}
						else {
					?>
						<img class = "freshOrRotten" src="fresh.gif" alt="Fresh">
					<?php
						}
					?>
					<q>
				<!-- Displays quote from critic -->
						<?= $critic[0] ?>
					</q>
				</p>
				
				<!-- Displays critic's crdentials -->
				<p class = "reviewer">
					<img src="critic.gif" alt="Critic">
					<?=$critic[2]?>
					<br />
					<span class = "publication">
						<?=$critic[3]?>
					</span>
				</p>
				
				<!-- Uses if statement -->
				<!-- Will either set equal number of reviews in each column if even number of reviews -->
				<!-- Or have 1 more review in left column than right column if odd number of reviews -->
				<?php
					if ($count >= round(sizeof($critic)/2)){
				?>
					</div>
					<div class = "columns">
				<?php
					}	
					$count++;
			}
			?>
		</div>
		</div>
		
		<!-- Displays number of reviews for movie -->
		<!-- Uses count variable from previous function -->
		</div>
		<p id = "bottom">(1-<?=$count?>) of <?=$count?></p>	
		</div>
		
		<!-- Validate page -->
		<div id = "validation">
			<a href="http://validator.w3.org/check/referer"><img src="w3c-html.png" alt="Valid HTML5"></a>
			<br>
			<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="w3c-css.png" alt="Valid CSS"></a>
		</div>
	</body>
	
</html>
