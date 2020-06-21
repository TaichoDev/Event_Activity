<?php


	/**
	 * CLASS POUR LE Dashboard
	 */
	class SousCategorieModel
	{


		public function selectSsCategorieM($laRequete,$donnee = []){
			$bdd = new Bdd(HOST,BASE,USER,PWD);
			$bdd->getBDD();
			$resultats = $bdd->requetesExec($laRequete,$donnee);
			return $resultats;
	   }

	}
