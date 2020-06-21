<?php



	class EventControlleur
	{
		/**
		 * Permet d'afficher le formulaire de creation d'un evenement dans la partie administration du site
		 * 
		 */
		public function displayCreateEvent()
		{
			
			$categ = new CategorieControlleur();
			$resCategorie = $categ->selectCategorieC();
			

			$obj = new ContactControlleur();
			$obj5 = $obj->selectAllContactC_result();

			$tableau = [
				'resCategorie' =>$resCategorie,
				'obj5' => $obj5
			];
			$maVue = new View($tableau,"createEvenement","Administration");
            $maVue->getViewBack();
		}

		



		public function displayOneEvent()
		{
			$resCategorie = array();
			$maVue = new View($tableau,"createEvenement","Administration");
            $maVue->getViewBack();
		}


		public function displayCreateEventSous()
		{

			$categ = new SousCategorieControlleur();
			$resSsCategorie = $categ->selectSsCategorieC($_GET['id']);

			$tableau = [ 'resSsCategorie' => $resSsCategorie];
			$maVue = new View($tableau,"createEvenement","Administration");
            $maVue->getViewBack();
			
		}

	   public function showSelecteurDate(){
			
			$date = [date("Y-m-d")];

			if(isset($_GET["PARA"])){
				$date = [$_GET["PARA"]];
				$tDate["date"] = $_GET["PARA"];
			}
			// Recupération toutes les dates du mois
	
			$laRequete    = "SELECT dateEvent, idEvent, nomEvent FROM `evenement` WHERE dateEvent =  ?";
		
			$event = new EventModel();
			$temp = $event->selectEventM($laRequete,$date);
			

			$class['classevent'] ='liste_evenement';
		
			if (!empty($temp)) {
			
				$tDate["date"] = $temp[0]['dateEvent'];
				foreach ($temp as $key => $value) {
					
					$obj[$key]['idEvent'] = $value[1];
					$obj[$key]["nomEvent"] = $value[2];
				}
			}

			$maVue = new View($obj,"listeDates","Administration");
            $maVue->templateBackSimple();
			//include 'www/templates/management/layoutDate.phtml';

		}

		public function dateEventSelected(){
			
			$date = [date("Y-m-d")];

			if(isset($_GET["PARA"])){
				$date = [$_GET["PARA"]];
				$tableau['ladate'] = $_GET["PARA"];
				
			}
			// Recupération toutes les dates du mois
	
			$laRequete    = "SELECT dateEvent, idEvent, nomEvent FROM `evenement` WHERE dateEvent =  ?";
		
			$event = new EventModel();
			$temp = $event->selectEventM($laRequete,$date);
			
			$tableau=array();
			$class['classevent'] ='liste_evenement';
		
			if (!empty($temp)) {
			
				$ladate = $tableau['ladate'] =  $temp[0]['dateEvent'];
				foreach ($temp as $key => $value) {
					
					$obj[$key]['idEvent'] = $value[1];
					$obj[$key]["nomEvent"] = $value[2];
				}
			}else{
				$ladate = $tableau['ladate']= $_GET["PARA"];
			}

			

			$maVue = new View($tableau,"layoutDate","Administration");
            $maVue->templateBackSimple();
			include 'www/templates/management/layoutDate.phtml';

		}

		public function displayEvent($data = null)
		 {
		 	
			$title = "Administration";
		 	if ($data == null) {
				$data = [$_GET["PARA"]];
		 	}

			
			$event = new EventModel();
			$obj1 = $event->photoEvent($data);
			$obj2 = $event->CatAndSsCatEvent($data);
			
			
			$resCategorie = array();
			$categ = new CategorieControlleur();
			$resCategorie   = $categ->selectCategorieC();


			$categ = new SousCategorieControlleur();
			$resSsCategorie   = $categ->selectSsCategorieC($obj2[0]["idCategorie"]);
			

			$obj = new ContactControlleur();
			$obj3 = $obj->selectAllContactSelectEvent($data);

			$obj5 = $obj->selectAllContactC_result();


			$tableau['urlPhoto'] = (isset($obj1[0]["urlPhoto"])) ? 'www/img/photo/'.$obj1[0]["urlPhoto"] :  'https://via.placeholder.com/600x400?text=No+Image';
			$tableau['nomphoto'] = (isset($obj1[0]["nomPhoto"])) ? $obj1[0]["nomPhoto"] :  '';
			$tableau['idEvent']  = (isset($obj1[0]["idEvent"])) ? $obj1[0]["idEvent"] :  '';
			      
			$tableau['nomEvent'] = (isset($obj1[0]["nomEvent"])) ? $obj1[0]["nomEvent"] :  '';
			$tableau['descriptionEvent']  = (isset($obj1[0]["descriptionEvent"])) ? $obj1[0]["descriptionEvent"] :  '';
			$tableau['pafEvent']     = (isset($obj1[0]["pafEvent"])) ? $obj1[0]["pafEvent"] :  '';
			$tableau['heureEvent']   = (isset($obj1[0]["heureEvent"])) ? $obj1[0]["heureEvent"] :  '';
			$tableau['dateEvent'] = (isset($obj1[0]["dateEvent"])) ? $obj1[0]["dateEvent"] :  '';
			$tableau['infoReservation']   = (isset($obj1[0]["infoReservation"])) ? $obj1[0]["infoReservation"] :  '';
			$tableau['idPhoto']    = (isset($obj1[0]["idPhoto"])) ? $obj1[0]["idPhoto"] :  '';

			$tableau['idCategorie'] = (isset($obj2[0]["idCategorie"])) ? $obj2[0]["idCategorie"] :  '';
			$tableau['nomCategorie'] = (isset($obj2[0]["nomCategorie"])) ? $obj2[0]["nomCategorie"] :  '';
			$tableau['idSSCateg'] = (isset($obj2[0]["idSSCateg"])) ? $obj2[0]["idSSCateg"] :  '';
			$tableau['nomSSCateg'] = (isset($obj2[0]["nomSSCateg"])) ? $obj2[0]["nomSSCateg"] :  '';
			     
			$tableau['idContact'] = (isset($obj1[0]["idContact"])) ? $obj1[0]["idContact"] :  '';
			$tableau['orgContact'] = (isset($obj1[0]["orgContact"])) ? $obj1[0]["orgContact"] :  '';

			$tableau['resCategorie'] = $resCategorie;
            $tableau['resSsCategorie'] = $resSsCategorie;

            $tableau['obj3'] = $obj3;
            $tableau['obj5'] = $obj5;
            $tableau['valide'] = 'valide';
      		$maVue = new View($tableau,"createEvenement","Administration");
            $maVue->getViewBack();
		}


		public function deleteEvent(){
			
			$data = [$_GET["PARA"]];
			$monModel = new EventModel();
			$delete = 'DELETE FROM `rel_user_com_event_statut` WHERE idEvent = ? ';
			$monModel->updateDeleteEventM($delete,$data);
			$delete = 'DELETE FROM `rel_photo_event` WHERE idEvent = ? ';
			$monModel->updateDeleteEventM($delete,$data);
			$delete = 'DELETE FROM `rel_event_contact` WHERE idEvent = ?';
			$monModel->updateDeleteEventM($delete,$data);
			$delete = 'DELETE FROM `evenement` WHERE idEvent = ? ';
			$monModel->updateDeleteEventM($delete,$data);

		}



		public function modifyevent()
		{

			$post = $this->traitementDonnees($_POST);
			
			if (!empty($_FILES['image']['name'])) {
				
				$lImage = new PhotoEventControlleur();
				$retourTraitement = $lImage->traitementImage($_FILES,$_POST["idPhoto"]);
				$IdPhoto = $lImage->addImage($retourTraitement['photo']);

			}else{
				$IdPhoto = $_POST["idPhoto"];
			} 

			$tabErreur = $this->testEmptyPost($_POST);

			if(tabIsEmpty($tabErreur)  == true){

				$tab = array($_POST['titreEvent'],$_POST['contenu'],$_POST['pafevent'],$_POST['timevent'],$_POST['dateevent'],$_POST['inforeservation'],$_POST['sscategorie'],$IdPhoto,$_POST['idEvent']);

				$event = new EventModel();
				$event->updateEventM($tab);

				$data = [$_POST['idEvent']];
				$delContact = new ContactControlleur();
				$delContact->deleteContactToEvent($data);


				$tabContact = explode(",", $_POST["contactevent"] );
				$isEmpty = tabIsEmpty($tabContact);

				if($isEmpty == false){
					$contact = new ContactControlleur();
					foreach ($tabContact as $key => $value) {
						$t= [$_POST['idEvent'] ,$value];
						$contact->addContactToEventC($t);
					}
				}

      			$this->displayEvent($data);

			}else{



				$tableau['urlPhoto'] 			= (isset($_FILES['image'])) ? $_FILES['image']['name'] :  'https://via.placeholder.com/600x400?text=No+Image';
				$tableau['nomphoto'] 			= (isset($_FILES['image'])) ? (pathinfo($_FILES['image']['name'])) :  '';				      
				$tableau['nomEvent'] 			= (isset($_POST['titreEvent'])) ? $_POST['titreEvent'] :  '';
				$tableau['descriptionEvent']  	= (isset($_POST['contenu'])) 	? $_POST['contenu'] :  '';
				$tableau['pafEvent']     		= (isset($_POST['pafevent'])) ? $_POST['pafevent'] :  '';
				$tableau['heureEvent']   		= (isset($_POST['timevent'])) ? $_POST['timevent'] :  '';
				$tableau['dateEvent'] 			= (isset($_POST['dateevent'])) ? $_POST['dateevent'] :  '';
				$tableau['infoReservation']   	= (isset($_POST['inforeservation'])) ? $_POST['inforeservation']:  '';

				$tableau['idCategorie'] 		= (isset($_POST['categorie'])) ? $_POST['categorie'] :  '';
				$tableau['idSSCateg'] 			= (isset($_POST['sscategorie'])) ? $_POST['sscategorie'] :  '';	

				$tableau['idContact'] 			= (isset($obj1[0]["idContact"])) ? $obj1[0]["idContact"] :  '';
				$tableau['orgContact'] 			= (isset($obj1[0]["orgContact"])) ? $obj1[0]["orgContact"] :  '';
				$tableau['resCategorie'] 		= $resCategorie;
	            $tableau['resSsCategorie'] 		= $resSsCategorie;



	            $obj = new ContactControlleur();
				$tabContact = $obj->addContactToEventB($_POST['contactevent']);

	            $tableau['obj3'] 				=  $tabContact; 



	            $obj = new ContactControlleur();
				$obj5 = $obj->selectAllContactC_result();
	            $tableau['obj5'] 				= $obj5;
	            $tableau['message'] 			= $tabErreur;



				//$message = 'Votre identifiant ou mot de passe sont erronnés';
				$donnees = ['message' => $tableau['message'], 'color' => 'red'];
				


	      		//$maVue = new View($tableau,"createEvenement","Administration");
	            //$maVue->getViewBack();

				echo json_encode($donnees);
			}
		}
		
		public function testEmptyPost($data){
			$tabErreur = array();

			if( empty($data['titreEvent'])){

				$tabErreur["titre"] = "Le titre n'est pas rempli";	
			}
			if( empty($data['contenu']) ){

				$tabErreur["contenu"] = "Vous n'avez pas mis d'information pour l'évènement";	
			}
			if( empty($data['timevent']) ){

				$tabErreur["heure"] = "Vous n'avez pas mis d'horaire pour l'évènement";	
			}
			if( empty($data['dateevent']) ){

				$tabErreur["date"] = "Vous n'avez pas mis de date pour l'évènement";	
			}
			if( empty($data['sscategorie'])){

				$tabErreur["categorie"] = "Vous devez choissier une catégorie et une sous-catégorie";	
			}


			return $tabErreur;
		}

		public function traitementDonnees($data){

			$post['titreEvent'] = valid_donnees($data['titreEvent']);
			$post['contenu'] = valid_donnees($data['contenu']);
			$post['pafevent'] = valid_donnees($data['pafevent']);
			$post['timevent'] = valid_donnees($data['timevent']);
			$post['dateevent ']= valid_donnees($data['dateevent']);
			$post['inforeservation'] = valid_donnees($data['inforeservation']);
			$post['sscategorie'] = valid_donnees($data['sscategorie']);
			return $post;
		}
	

		public function createEvent()
		{
			

			$post = $this->traitementDonnees($_POST);

			$lImage = new PhotoEventControlleur();



			$tabErreur = $this->testEmptyPost($post);


			if(tabIsEmpty($tabErreur)  == true){

				$retourTraitement = $lImage->traitementImage($_FILES,NULL);
				$lastInsertId = $lImage->addImage($retourTraitement['photo']);

				$tab['photo'] =$retourTraitement['tab'];
				$tab = array($post['titreEvent'],$post['contenu'],$post['pafevent'],$post['timevent'],$post['dateevent'],$post['inforeservation'],$post['sscategorie']);
				
				
				if(($lastInsertId == 0) || ($lastInsertId == NULL)){
					$lastInsertId = 1;
				}

				array_push($tab,$lastInsertId) ;
				$event = new EventModel();
				
				$lastInsertIdEvent = $event->addNewEventM($tab);
				


				$tabContact = explode(",", $_POST["contactevent"] );
				$isEmpty = tabIsEmpty($tabContact);

				if($isEmpty == false){
					$contact = new ContactControlleur();
					foreach ($tabContact as $key => $value) {
						$t= [$lastInsertIdEvent ,$value];
						$contact->addContactToEventC($t);
					}
				}

				$this->displayEvent([$lastInsertIdEvent]);
			}else{



				$tableau['urlPhoto'] 			= (isset($_FILES['image'])) ? $_FILES['image']['name'] :  'https://via.placeholder.com/600x400?text=No+Image';
				$tableau['nomphoto'] 			= (isset($_FILES['image'])) ? (pathinfo($_FILES['image']['name'])) :  '';				      
				$tableau['nomEvent'] 			= (isset($post['titreEvent'])) ? $_POST['titreEvent'] :  '';
				$tableau['descriptionEvent']  	= (isset($post['contenu'])) 	? $_POST['contenu'] :  '';
				$tableau['pafEvent']     		= (isset($post['pafevent'])) ? $_POST['pafevent'] :  '';
				$tableau['heureEvent']   		= (isset($post['timevent'])) ? $_POST['timevent'] :  '';
				$tableau['dateEvent'] 			= (isset($post['dateevent'])) ? $_POST['dateevent'] :  '';
				$tableau['infoReservation']   	= (isset($post['inforeservation'])) ? $_POST['inforeservation']:  '';

				$tableau['idCategorie'] 		= (isset($post['categorie'])) ? $_POST['categorie'] :  '';
				$tableau['idSSCateg'] 			= (isset($post['sscategorie'])) ? $_POST['sscategorie'] :  '';	

				$tableau['idContact'] 			= (isset($obj1[0]["idContact"])) ? $obj1[0]["idContact"] :  '';
				$tableau['orgContact'] 			= (isset($obj1[0]["orgContact"])) ? $obj1[0]["orgContact"] :  '';
				$tableau['resCategorie'] 		= $resCategorie;
	            $tableau['resSsCategorie'] 		= $resSsCategorie;



	            $obj = new ContactControlleur();
				$tabContact = $obj->addContactToEventB($_POST['contactevent']);

	            $tableau['obj3'] 				=  $tabContact; 



	            $obj = new ContactControlleur();
				$obj5 = $obj->selectAllContactC_result();
	            $tableau['obj5'] 				= $obj5;
	            $tableau['message'] 			= $tabErreur;



				//$message = 'Votre identifiant ou mot de passe sont erronnés';
				$donnees = ['message' => $tableau['message'], 'color' => 'red'];
				


	      		//$maVue = new View($tableau,"createEvenement","Administration");
	            //$maVue->getViewBack();

				echo json_encode($donnees);
			}


			
		}

	}

?>
