<?php

	class EventModel
	{



		public function selectEventM($laRequete,$donnees = []){
		   $bdd = new Bdd(HOST,BASE,USER,PWD);
		   $resultat = $bdd->requetesExec($laRequete,$donnees);
		   //$arr = $bdd->getBDD()->errorInfo();
		   //print_r($arr);
		   return $resultat;
		}

	    public function insertEventM($laRequete,$donnees = []){
		   $bdd = new Bdd(HOST,BASE,USER,PWD);
		   $lastId = $bdd->insertionExec($laRequete,$donnees);
		   return $lastId;
		}

		public function addNewEventM($donnees = []){
			$laRequete  = "INSERT INTO `evenement`( `nomEvent`, `descriptionEvent`, `pafEvent`, `heureEvent`, `dateEvent`, `infoReservation`, `idSsCategorie`, `idPhoto`) VALUES (?,?,?,?,?,?,?,?)";
		   $bdd = new Bdd(HOST,BASE,USER,PWD);
		   $lastId = $bdd->insertionExec($laRequete,$donnees);
		   return $lastId;
		}

		public function updateEventM($donnees = []){
			$laRequete   = "UPDATE `evenement` SET `nomEvent`= ?,`descriptionEvent`= ? ,`pafEvent`= ? ,`heureEvent`= ? ,`dateEvent`= ? ,`infoReservation`= ? ,`idSsCategorie`= ?,`idPhoto`= ?   WHERE `idEvent`= ?";
		   $bdd = new Bdd(HOST,BASE,USER,PWD);
		   $lastId = $bdd->insertionExec($laRequete,$donnees);
		   return $lastId;
		}

		public function updateDeleteEventM($laRequete,$donnees = []){
		   $bdd = new Bdd(HOST,BASE,USER,PWD);
		   $nbRowAffected = $bdd->updateDeleteExec($laRequete,$donnees);
		   return $nbRowAffected;
		}
		

		public function CatAndSsCatEvent($donnees){

			$laRequete = "SELECT c.*,ssc.* FROM evenement e INNER JOIN ss_categorie ssc ON ssc.idSSCateg = e.idSsCategorie INNER JOIN categorie c ON c.idCategorie = ssc.idCategorie WHERE e.idEvent = ? ";
		 	$bdd = new Bdd(HOST,BASE,USER,PWD);
	   		$resultat = $bdd->requetesExec($laRequete,$donnees);
		    return $resultat;
		}

		public function photoEvent($donnees){

			$laRequete = "SELECT * FROM evenement e
			INNER JOIN photo p ON p.idPhoto = e.idPhoto
			WHERE e.idEvent = ? ";

		 	$bdd = new Bdd(HOST,BASE,USER,PWD);
	   		$resultat = $bdd->requetesExec($laRequete,$donnees);
		    return $resultat;
		}




	}
