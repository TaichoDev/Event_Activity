<?php 


	class AdminModel{

		public function typeAdminModel(){


			$laRequete = "SELECT * FROM type_user";
			$bdd = new Bdd(HOST,BASE,USER,PWD);
		   	$resultats = $bdd->requetesExec($laRequete,null);
		   	return $resultats;

		}

		public function selectAllAdmin(){
			$laRequete = "SELECT * FROM admin";
			$bdd = new Bdd(HOST,BASE,USER,PWD);
		   	$resultats = $bdd->requetesExec($laRequete,null);
		   	return $resultats;			
		}

		public function createAdmin($data){
		
			$laRequete = "INSERT INTO `admin`(`idAdmin`, `nomAdmin`, `prenomAdmin`, `mailAdmin`, `idTypeAdmin`, `passwordAdmin`, `pseudo`) VALUES (?,?,?,?,?,?,?)";
			$bdd = new Bdd(HOST,BASE,USER,PWD);		
		   	$resultats = $bdd->insertionExec($laRequete,$data);

		   	return $resultats;
		}


		public function selectOneAdmin($data = []){

			$data = [$data];
			$laRequete = "SELECT * FROM admin WHERE idAdmin = ? ";
			$bdd = new Bdd(HOST,BASE,USER,PWD);		
		   	$resultats = $bdd->requeteExec($laRequete,$data);

		   	return $resultats;			
		}

		public function deleteAdmin($data){

			$laRequete = "DELETE FROM admin WHERE idAdmin = ? ";
			$bdd = new Bdd(HOST,BASE,USER,PWD);	
			$resultat = $bdd->updateDeleteExec($laRequete,$data);
			return $resultat;

		}

		public function updateAdmin($data){
			$texte='';
			$tab =$data;

			if (!empty($data[4])) {
				$texte = ',`passwordAdmin`= ?';
			}else{
				unset($data[4]);

				$tab = [];
				foreach ($data as $key => $value) {
					array_push($tab, $value);
				}
			}
			
			$requete = 'UPDATE `admin` SET `nomAdmin`= ? ,`prenomAdmin`= ? ,`mailAdmin`= ? ,`idTypeAdmin`= ? '.$texte.' ,`pseudo`= ? WHERE idAdmin = ?';
			$bdd = new Bdd(HOST,BASE,USER,PWD);		
		   	$resultats = $bdd->updateDeleteExec($requete,$tab);

		   	return $resultats ;
		}

	}