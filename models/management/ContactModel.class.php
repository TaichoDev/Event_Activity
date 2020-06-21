<?php

	class ContactModel
	{


		public function selectAllContactM($donnee = []){
			$laRequete = "SELECT * FROM contact";
			$bdd = new Bdd(HOST,BASE,USER,PWD);
			$resultats = $bdd->requetesExec($laRequete,$donnee);
			return $resultats;
		}

		public function insertContactM($laRequete,$donnee = []){
			$bdd = new Bdd(HOST,BASE,USER,PWD);
			$bdd->getBDD();
			$resultats = $bdd->insertionExec($laRequete,$donnee);
			
			return $resultats;
		}
		public function updateContactM($donnees){
			$laRequete = 'UPDATE `contact` SET `orgContact`= ?,`nomContact`= ? ,`prenomContact`= ? ,`telFixeContact`= ? ,`telMobContact`= ? ,`idCiv`= ? WHERE  idCOntact = ? ';

			$bdd = new Bdd(HOST,BASE,USER,PWD);
			$resultats = $bdd->updateDeleteExec($laRequete,$donnees);
			return $resultats;
		}

		/**
		 * [suppressionContactM Suppression d'un contact de la base de données]
		 * @param  [array] $donnees [description]
		 * @return [type]          [description]
		 */
		public function suppressionContactM($donnees){
			$bdd = new Bdd(HOST,BASE,USER,PWD);
			$laRequete = "SELECT idContact FROM rel_event_contact WHERE idContact = ? ";			
			$resultats = $bdd->requetesExec($laRequete,$donnees);
			
			if (!empty($resultats[0]['idContact'])){

				$laRequete = "DELETE FROM rel_event_contact WHERE idContact = ? ";
				$bdd->updateDeleteExec($laRequete,$donnees);
			} 
			$laRequete = "DELETE FROM contact WHERE idContact = ? ";
			$resultats = $bdd->updateDeleteExec($laRequete,$donnees);			
			return $resultats;
		}


		/**
		 * [deleteContactToEventM Suppression d'un contact d'un evenement]
		 * @param  [array] $donnees [description]
		 * @return [type]          [description]
		 */
		public function deleteContactToEventM($donnees){
			$deleteCOntact = "DELETE FROM `rel_event_contact` WHERE idEvent = ?";
			$bdd = new Bdd(HOST,BASE,USER,PWD);
			$resultats = $bdd->updateDeleteExec($laRequete,$donnees);
			return $resultats;
		}

		/**
		 * [addContactToEventM ajout d'un contact a un evenement]
		 * @param [type] $donnees [description]
		 */
		public function addContactToEventM($donnees){
			
			$laRequeteContact         = "INSERT INTO `rel_event_contact`(`idEvent`, `idContact`) VALUES (?,?)";
			$bdd = new Bdd(HOST,BASE,USER,PWD);
			$resultat = $bdd->insertionExec($laRequeteContact,$donnees);
			return $resultat;
		}

		public function selectContactSelected($donnees = []){
			 $laRequete = "SELECT ct.* FROM evenement e
            INNER JOIN rel_event_contact rec ON rec.idEvent = e.idEvent
            INNER JOIN contact ct ON ct.idContact = rec.idContact
            WHERE e.idEvent = ? ";

			$bdd = new Bdd(HOST,BASE,USER,PWD);
			$resultats = $bdd->requetesExec($laRequete,$donnees);
			return $resultats;
		}


		public function selectContactSelectedSP($donnees = []){

			$text = "?";
            for ($i=1; $i <  count($donnees); $i++) { 
                $text .= ",?";
            }             
            
            $laRequete = "SELECT * FROM contact WHERE idContact IN (" . $text .")";

			$bdd = new Bdd(HOST,BASE,USER,PWD);
			$resultats = $bdd->requetesExec($laRequete,$donnees);
			return $resultats;
		}

		/****

		****/
		public function base(){
			$bdd = new Bdd(HOST,BASE,USER,PWD);
			$resultats = $bdd->requetesExec($laRequete,$donnee);
			return $resultats;
		}

	}
