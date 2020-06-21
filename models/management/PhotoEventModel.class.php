<?php
	
	class PhotoEventModel
	{


		public function insPhoto($donnee ){
			
			$laRequetePhoto = "INSERT INTO `photo`( `urlPhoto`, `nomPhoto`) VALUES (?,?)";
			$bdd = new Bdd(HOST,BASE,USER,PWD);
			$bdd->getBDD();
			$resultats = $bdd->insertionExec($laRequetePhoto,$donnee);
			return $resultats;
		}

	   

	}
