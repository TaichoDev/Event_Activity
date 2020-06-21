<?php

	/**
	 *
	 */
	class PhotoControlleur
	{
		//afficher toutes les photos de l'evenement
		public function displayListeEvenements()
		{
			$code = 0;
			//A
			if($code == 0){
				//recherche tout les dates qui sont suppérieur a la date du jour
				$requete = "SELECT * FROM evenement WHERE ".$texte;
				$element = new PhotosModel();
				$resultat = $element->getEvents($requete);

			}else {
				$tabErreur= [
					'erreur' => "Votre demande n'a pas pu aboutir."
				];
			}

		}

		// Affiche une photo presice de l'évènement
		public function displayPhoto()
		{
			$code = 0;
			//on verifie si le parametre num est bien un nombre

			if(is_int($_GET["num"])){
				$texte = "idEvent = ".$_GET["num"];
			}else{
				$code  = 1;
			}

			if($code == 0){
				//recherche tout les dates qui sont suppérieur a la date du jour
				$requete = "SELECT * FROM evenement WHERE ".$texte;
				$element = new PhotosModel();
				$resultat = $element->getEvents($requete);

			}else {
				$tabErreur= [
					'erreur' => "Votre requete n'a pas pu aboutir."
				];
			}
			//Determine le template
			$template = "pagePhotoEvenement";
			include 'www/templates/layout.phtml';
		}
	}
