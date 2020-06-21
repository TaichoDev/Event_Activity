<?php

	/**
	 *
	 */
	class EvenementsControlleur
	{

		/**
		 * [displayListeEvenements Liste tous les évènements selon les paramètres demané par l'utilisateur]
		 */
		public function displayListeEvenements()
		{	
			/**
			 * [$condition reçoit une donnée qui défini par l'utilisateur pour récupérer des informations soit qui sont déjà passé ou qui sont a venir]
			 * @var string
			 */
			$condition='';
			if (isset($_GET['type'])) {
				$condition = $_GET['type'];
			}
			//Permet de savoir sur quel page on se trouve dans la liste des évènements
			$nb = (!empty($_GET['nb'])) ? valid_donnees($_GET['nb']) : 1 ;
			switch ($condition) {
				case 'futur':
					$texte = "DATE( NOW() ) <= dateEvent";
					$titre = "evenement à venir";
					break;
				case 'past':
					$texte = "DATE( NOW() ) > dateEvent";
					$titre = "evenement passer";
					break;
			}

			$texte .= " ORDER BY dateEvent ASC";
			$element = new EvenementsModel();


			$tableau = $element->getEvents($texte,[], $nb);
			
			if($resultats === null){
				
				$tabErreur= [
					'erreur' => "Votre demande n'a pas pu aboutir."
				];
			}

			$tableau['title' ] = $titre;
			$tableau['texte' ] = $condition;
			

			$maVue = new View($tableau,"pageListe",$titre);
			$maVue->getView();
		}

		/**
		 * Afficher l'ensemble des détails d'un évènement
		 *
		 */
		public function displayEvenement($idEvent = null)
		{	

			
			if ($idEvent == null) {
				# code...
				$idEvent = intval($_GET["num"]);
			}else{
				$idEvent = intval($_GET["idEvent"]);
			}
			//Verification si c'est bien un entier qui est entre
			if(is_int($idEvent)){
			$event = new EvenementsModel();
			$tableau = $event->getEvent([$idEvent]);
				$maVue = new View($tableau,"pageEvenement",$tableau['resultats']['nomEvent']);
				$maVue->getView();
			}else{
			
				// Page 404 a mettre
				$accueil = new Accueil();
				$accueil->displayHome();
			}
		}

		/**
		 * [rechercheEvenement Permet d'effectuer une recherche ]
		 * @return [type] [description]
		 */
		public function rechercheEvenement()
		{

			$texte = valid_donnees($_GET['texte']);
		
			$event = new EvenementsModel();
			$tableau = $event->rechercherEvenement($texte);	
	
			$maVue = new View($tableau,"pageListe","Votre recherche");
			$maVue->getView();
		}
	}
