<nav>
	<?php 

		if (isset($_SESSION['USER'])) {
	?>

			<span>Bienvenue <?= $_SESSION['USER']['NOM'] ?> <?= $_SESSION['USER']['PRENOM']?></span>
			<a href="<?= $path ?>admin/admin.php">Administration</a>
			<a href="<?= $path ?>php/deconnection.php">Se deconnecter</a>
			<a href="<?= $path ?>index.php">retour site</a>
			<?php
		}else{
			?>
				<a href="<?= $path ?>php/inscription.php?con=1">Se connecter</a>
				<a href="<?= $path ?>php/inscription.php?con=2">S'inscrire</a>
			<?php
		}


	?>

</nav>