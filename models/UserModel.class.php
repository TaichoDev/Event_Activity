<?php 

	class UserModel{

		public function register($data){

			$insertRequete = 'INSERT INTO `user`(`idUser`, `nomUser`, `prenomUser`, `dateBirth`, `adresseUser`, `adressBisUser`, `cpUser`, `villeUser`, `paysUser`, `emailUser`, `mdpUser`, `idCiv`) VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?)';

			$bdd = new Bdd(HOST,BASE,USER,PWD);
			$idInserted = $bdd->insertionExec($insertRequete,$data);

			
			return $idInserted;
		}


		public function modify($data,$texte){
			$update = 'UPDATE `user` SET `nomUser`= ?,`prenomUser`= ?,`dateBirth`=?,`adresseUser`= ?,`adressBisUser`=?,`cpUser`= ?,`villeUser`=?,`paysUser`=?,`emailUser`=?'.$texte.' WHERE `idUser`=?';
			$bdd = new Bdd(HOST,BASE,USER,PWD);
			$retourMod = $bdd->updateDeleteExec($update,$data);

			
			return $retourMod;
		}

		public function password($data){

			$select = 'SELECT mdpUser FROM user WHERE idUser = ?';

			$bdd = new Bdd(HOST,BASE,USER,PWD);
			$mdpUser = $bdd->requeteExec($select,$data);

			
			return $mdpUser;
		}

		public function login($data){

			$select = 'SELECT * FROM user WHERE emailUser = ?';

			$bdd = new Bdd(HOST,BASE,USER,PWD);
			$idInserted = $bdd->requeteExec($select,$data);

			
			return $idInserted;
		}

		public function selectUser($data){

			$select = 'SELECT * FROM user WHERE idUser = ?';

			$bdd = new Bdd(HOST,BASE,USER,PWD);
			$donnees = $bdd->requeteExec($select,$data);
			$tab=[
				'donnees' => $donnees
			];
			
			return $tab;
		}
	}