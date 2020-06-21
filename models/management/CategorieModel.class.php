<?php


	/**
	 * CLASS POUR LE Dashboard
	 */
	class CategorieModel
	{
		public function selectCategorieM($laRequete,$donnee = []){
			$bdd = new Bdd(HOST,BASE,USER,PWD);
		   	$bdd->getBDD();
		   	$resultats = $bdd->requetesExec($laRequete,$donnee);
		   	return $resultats;
	   }
	}

?>
