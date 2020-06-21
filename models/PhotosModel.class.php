<?php
	//a ajouté les variables et hydratation

	/**
	 *
	 */
	class PhotosModel
	{

		public function getEvents($laRequete,$data = []){

			$bdd = new Bdd(HOST,BASE,USER,PWD);
			$bdd->getBDD();
			//Listes de toutes les requetes retournant tous les elenements dans la base
			$resultats = $bdd->requetesExec($laRequete,$data);
			//$laRequete = "";
			return $resultats;
		}

		public function getEvent($laRequete,$data = []){
			//retourne l'element selectionne
			$bdd = new Bdd(HOST,BASE,USER,PWD);
			$bdd->getBDD();
			$resulat = $bdd->requeteExec($laRequete,$data);
			return $resulat;
		}
	}
