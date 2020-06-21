<?php
	//a ajouté les variables et hydratation

	/**
	 *
	 */
	class EvenementsModel
	{

		public function getEvents($texte,$data = [], $pageActuelle = 1){

			$laRequete = "SELECT COUNT(*) FROM evenement e INNER JOIN photo p ON p.idPhoto = e.idPhoto INNER JOIN ss_categorie ssc ON ssc.idSSCateg = e.idSsCategorie INNER JOIN categorie c ON c.idCategorie = ssc.idCategorie  WHERE ".$texte;


			$bdd = new Bdd(HOST,BASE,USER,PWD);
			$NombreEvenements = $bdd->requetesExec($laRequete,$data);
			
			//Nous allons afficher 20 messages par page.
			$evenementParPage = NOMBRE_ARTICLE_PAGE; 
		
			$debut = (($pageActuelle-1)*$evenementParPage);

			//Nous allons maintenant compter le nombre de pages.
			$nombreDePages = ceil($NombreEvenements[0][0] / $evenementParPage);


			$laRequete = "SELECT idEvent,pafEvent,infoReservation, nomEvent,nomPhoto,urlPhoto,nomCategorie, nomSSCateg,dateEvent, descriptionEvent FROM evenement e INNER JOIN photo p ON p.idPhoto = e.idPhoto INNER JOIN ss_categorie ssc ON ssc.idSSCateg = e.idSsCategorie INNER JOIN categorie c ON c.idCategorie = ssc.idCategorie  WHERE ".$texte." LIMIT  $debut , $evenementParPage";

		

			$resultats = $bdd->requetesExec($laRequete,$data);
			//var_dump(['%$data%','%$data%','%$data%']);
			$tab = [
        		'resultats' => $resultats,
        		'pageActuelle' => $pageActuelle,
        		'nombreDePages' => $nombreDePages,
        		'h2' => 'Page '.$pageActuelle .'/'. $nombreDePages    		
        	];

        	//var_dump($tab);
			return $tab;
		}

		public function getEvent($data = []){
			//retourne l'element selectionne
			$bdd = new Bdd(HOST,BASE,USER,PWD);

				//on verifie si le parametre num est bien un nombre
			$requete = "SELECT idEvent,pafEvent,infoReservation, nomEvent,nomPhoto,urlPhoto,nomCategorie, nomSSCateg,dateEvent, descriptionEvent FROM evenement e INNER JOIN photo p ON p.idPhoto = e.idPhoto INNER JOIN ss_categorie ssc ON ssc.idSSCateg = e.idSsCategorie INNER JOIN categorie c ON c.idCategorie = ssc.idCategorie WHERE idEvent = ?";

			$resultats = $bdd->requetesExec($requete,$data);
            $requete = "SELECT ct.*, nomCiv FROM evenement e
                INNER JOIN rel_event_contact rec ON rec.idEvent = e.idEvent
                INNER JOIN contact ct ON ct.idContact = rec.idContact
                INNER JOIN civilite c ON c.idCiv = ct.idCiv
                WHERE e.idEvent = ? ";
            $resOrg = $bdd->requetesExec($requete,$data);

            $requete = "SELECT p.idPhoto,nomPhoto,urlPhoto,infoPhoto FROM evenement e INNER JOIN rel_photo_event rpe ON rpe.idEvent = e.idEvent INNER JOIN photo p ON p.idPhoto = rpe.idPhoto WHERE e.idEvent = ?";
            $resPhotos = $bdd->requetesExec($requete,$data);


			$requete = "SELECT p.idPhoto,nomPhoto,urlPhoto,infoPhoto FROM evenement e INNER JOIN rel_photo_event rpe ON rpe.idEvent = e.idEvent INNER JOIN photo p ON p.idPhoto = rpe.idPhoto WHERE e.idEvent = ?";
            $resPhotos = $bdd->requetesExec($requete,$data);

			$requete = "SELECT com.*, nomEvent,user.idUser,user.nomUser FROM `rel_user_com_event_statut` ruces INNER JOIN commentaire com ON com.idCommentaire = ruces.idCom INNER JOIN user ON user.idUser = ruces.idUser INNER JOIN evenement e ON e.idEvent = ruces.idEvent INNER JOIN statutvalidation sv ON sv.idStatut = ruces.idStatut WHERE e.idEvent = ? ";
			//array_push($data,'2');
			$commentaires = $bdd->requetesExec($requete,$data);

        	$tab = [
        		'resultat' => $resultats,
        		'resOrg' => $resOrg,
				'resPhotos' => $resPhotos,
				'resCommentaires' => $commentaires

        	];


			return $tab;
		}


		function rechercherEvenement($data){

			$pageActuelle = 1;

				

			
			$bdd = new Bdd(HOST,BASE,USER,PWD);

			$laRequete = "SELECT COUNT(*) FROM evenement e INNER JOIN photo p ON p.idPhoto = e.idPhoto INNER JOIN ss_categorie ssc ON ssc.idSSCateg = e.idSsCategorie INNER JOIN categorie c ON c.idCategorie = ssc.idCategorie  WHERE nomEvent like ? OR `nomCategorie` like ? or `nomSSCateg` like ?  ORDER BY dateEvent ASC ";

			$NombreEvenements = $bdd->requetesExec($laRequete,["%$data%","%$data%","%$data%"]);
			
			//Nous allons afficher 20 messages par page.
			$evenementParPage = NOMBRE_ARTICLE_PAGE; 
		
			$debut = (($pageActuelle-1)*$evenementParPage);

			//Nous allons maintenant compter le nombre de pages.
			$nombreDePages = ceil($NombreEvenements[0][0] / $evenementParPage);

			$laRequete = "SELECT * FROM evenement e INNER JOIN photo p ON p.idPhoto = e.idPhoto INNER JOIN ss_categorie ssc ON ssc.idSSCateg = e.idSsCategorie INNER JOIN categorie c ON c.idCategorie = ssc.idCategorie  WHERE nomEvent like ? OR `nomCategorie` like ? or `nomSSCateg` like ?  ORDER BY dateEvent ASC LIMIT  $debut , $evenementParPage";
		


			$resultats = $bdd->requetesExec($laRequete,["%$data%","%$data%","%$data%"]);

			
			//var_dump(['%$data%','%$data%','%$data%']);
			$tab = [
        		'resultats' => $resultats,
        		'pageActuelle' => $pageActuelle,
        		'nombreDePages' => $nombreDePages,
        		'texte'  => $data,
        		'h2' => 'Page '.$pageActuelle .'/'. $nombreDePages    		
        	];
			return $tab;

		}
	}
