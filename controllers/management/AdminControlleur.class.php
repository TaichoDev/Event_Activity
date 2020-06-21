<?php 

	class AdminControlleur
	{


		public function updateAdmin(){			

			if (isset($_POST['passwordAdmin'])) {				
				$passwordAdmin =  password_hash($_POST['passwordAdmin'], PASSWORD_DEFAULT);
			}else{
				$passwordAdmin = '';
			}
			$datas = [$_POST['nomAdmin'],$_POST['prenomAdmin'],$_POST['mailAdmin'],$_POST['idtypeAdmin'],$passwordAdmin,$_POST['pseudo'],$_POST['idAdmin']];
			$myUpdate = new AdminModel();
			$retour = $myUpdate->updateAdmin($datas);
			$this->selectAllAdmin();

		}

		public function deconnexion(){		
			$_SESSION = array();
			unset($_SESSION);
			session_destroy();				
			$vue = new Accueil();		
			$vue->displayHome();
		}

	}