<!DOCTYPE HTML>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		
		<title><?= $title ?></title>
		<link href="www/css/normalize.css" rel="stylesheet" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
		<link href="www/css/style.css" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/css?family=Bungee&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Kanit|Overpass|Prompt&display=swap" rel="stylesheet"><meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="icon" type="image/png" href="www/img/icon.png" />
		<meta name="description" content="">

	</head>
	<body>
		
		</div>
			<header>
				<nav>
					<a href="index.php" id="logo">
						<img src="www/img/ea.png" alt="EventActivity">
					    <label>Event Activity
					    </label>
					</a>

					<div class="contenaire-menu">

						<ul class="menu">
							<li>
								<a href="index.php">Accueil</a>
							</li>
							<li>
								<a href="#">Evèvement</a>
								<ul>
									<li><a href="index.php?page=toutvoir&type=futur">Evèvement prochainement</a></li>
									<li><a href="index.php?page=toutvoir&type=past">Evènement passé</a></li>
								</ul>
							</li>
							<?php 							
								if (isset($_SESSION['USER']) && !isset($_SESSION['USER']['ADMIN']) ) { 
							

									?>

										<li>
											<a href="index.php?page=moncompte">Mon compte</a>
										</li>
										<li>
											<button id="logout">Se déconnecter</button> 
										</li>
									
									<?php 
								}
								else
								{ 
									?>
										<li><button id="inorout">Se connecter</button></li>
									<?php 
								} ?>
						</ul>
						<div class="container" id="menu-hamburger">
						  <div class="bar1"></div>
						  <div class="bar2"></div>
						  <div class="bar3"></div>
						</div>
						<div id="contenaire-recherche">
							<form method="GET" action="index.php">
								<!-- filtre a mettre -->
								<input class="btn-recherche" type="submit" name="page" value="Rechercher"> 
								<input class="recherche" name="texte" type="text" placeholder="recherche">
							</form>
						</div>
					</div>
					<!-- <button type="button" ><i class="fas fa-search"></i></button> -->
				</nav>
			</header>
			<main>
