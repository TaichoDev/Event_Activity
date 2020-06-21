<?php


	
	class SousCategorieControlleur
	{

		/**
		 * Affiche toutes les sous-catégories  d'une catégorie
		 * @return [array] [retourne un tableau contenant toute les sous-catégories  d'une catégorie]
		 */
		public function selectSsCategorieC($data){
				
			
			//$data = $_POST['id'];
			$laRequete = "SELECT * FROM `ss_categorie` WHERE idCategorie = ?";
			$tabDonnee = array($data);
			$monNewUser = new SousCategorieModel();
			$resSsCategorie = $monNewUser->selectSsCategorieM($laRequete, $tabDonnee);

			return $resSsCategorie;
		}


	}

?>
