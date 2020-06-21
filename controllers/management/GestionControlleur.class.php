<?php



	class GestionControlleur
	{
		/**
		 * [displayHome Permet d'afficher la page d'accueil d'administration du site]
		 */
		public function displayGestion()
		{
			if (!isset( $_SESSION['USER']['ADMIN'])){
			    header("Location: index.php?page=logAdmin");
			} 

			$vue = new View(NULL,"pageGestion","Administration");			
			$vue->getViewBack2();
		}


		public function displayDate()
		{

			$maVue = new View(NULL,'layoutDate','Administration');
            $maVue->getViewBack();
		}


	}

?>
