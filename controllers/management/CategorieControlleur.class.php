<?php

	class CategorieControlleur
	{
		/**
		 * Affiche toutes les catégories 
		 * @return [array] [retourne un tableau contenant toute les catégories]
		 */
		public function selectCategorieC(){
			$laRequete = "SELECT * FROM `categorie`";
			$monNewUser = new CategorieModel();
			$res = $monNewUser->selectCategorieM($laRequete, NULL);

			// Ajout d'une ligne dans le tableau
			$resultat = array();
			array_push($resultat, array('idCategorie' => '0','nomCategorie' => '----' ));
			// Ajout des éléments de la requete
			foreach ($res as $key => $value) {
				array_push($resultat,$value);
			}

			return $resultat;
		}

	}

?>
