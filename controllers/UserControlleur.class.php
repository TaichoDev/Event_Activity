<?php 

	class UserControlleur{




		public function login(){

			$erreur= array();
			$mailUser 		= valid_donnees($_POST['mailUser']);
			$mdpUser 		= valid_donnees($_POST['mdpUser']);
			$datas = [$mailUser];				

			if(empty($mailUser)){
				$erreur['adresseMail'] =  "Il y a une erreur dans votre mail.";
			}elseif(!filter_var($mailUser, FILTER_VALIDATE_EMAIL) ){
				$erreur['adresseMail'] = "Vous avez une erreur dans votre adressse mail";
			}else{
				$tabDonnees = array( $mailUser); ;
			}

			if(empty($mdpUser)){
				$erreur['mdpCrypte'] = "Vous n'avez pas saisi de mot de passe";
			}
			if (count($erreur)==0)
			{

				$newUser = new UserModel();
				$myUser = $newUser->login($datas);
				//on test le password
				if (password_verify($mdpUser, $myUser["mdpUser"]))
				{

					$_SESSION = array();						
					$_SESSION['USER']['NOM'] = $myUser["nomUser"];
					$_SESSION['USER']['PRENOM'] = $myUser["prenomUser"];
					$_SESSION['USER']['ID'] = $myUser["idUser"];
					$message = 'Bienvenue '.$myUser["nomUser"].' '.$myUser["prenomUser"];
					$donnees = ['message' => $message, 'color' => 'green'];
					
				} else {
				    $message = 'Mot de passe et\\ou utilisateur erroné(s)';
					$donnees = ['message' => $message, 'color' => 'red'];
				}

			}else{
				 $message = 'Votre identifiant ou mot de passe sont erronnés';
				$donnees = ['message' => $message, 'color' => 'red'];
			}

			echo json_encode($donnees);
		}

		public function logout()
		{	

			session_destroy();
			unset($_SESSION['USER']);
			header("Location: index.php");
		}


		public function moncompte(){


			if (!isset( $_SESSION['USER']) || isset( $_SESSION['USER']['ADMIN']) ){
				header("Location: index.php");
			}else{

				$accueil = new UserModel();
				$donnees = $accueil->selectUser([$_SESSION['USER']['ID']]);
				
				$title = "Mon Compte";
			
				$vue = new View($donnees,"compte");
				$vue->getView();
			}



		}

		public function modificationCompte(){

			$idUser = intval($_POST['idUser']);
			if( is_int($idUser))
			{
				$info = traitementUser($_POST);
				
				$tableauMsg = checkEmptyField($info);
				$texte = "";
				if ( !empty($info['mdpUser']) || !empty($info['confirMdpUser'])) {
					$tableauMsg = checkPassword($info);
					$ajout = "oui";
				}else{
					$ajout = "non";
					$tableauMsg['passwordAdmin'] = valid_donnees($_POST['passwordOrgin']);
				}

				
				$tableauMsg = checkMail($info);

				if (!isset($tableauMsg[0]) || !isset($tableauMsg[1]) || !isset($tableauMsg[2])) {
			
					$datas = [$info['nomUser'],$info['prenomUser'],$info['dttnUser'],$info['adresseUser'],$info['adresseBisUser'],$info['cpUser'],$info['villeUser'],$info['paysUser'],$info['mailUser']];

					if ($ajout == "oui") {
						array_push($datas, $tableauMsg['passwordAdmin']);
						$texte = ",`mdpUser`= ? ";
					}
					array_push($datas, $_POST['idUser']);
					$newUser = new UserModel();
					$retour = $newUser->modify($datas,$texte);
							
					if ($retour > 0) {
						$message = 'La modification c\'est bien passé.';
						$donnees = ['message' => $message, 'color' => 'green'];
					}else{
						$message = "Une erreur c'est produite lors de la modification.";
						$donnees =  [ 'message' => $message, 3 => $erreur];
					}
					
				}else{
					$message = "Une erreur c'est produite lors de la modification.";
					$donnees = [$tableauMsg];
				}
			}else{
				$donnees = ['Une erreur est survenue'];
			}

			echo json_encode($donnees);
		}

		public function register(){
			
	    	$info = traitementUser($_POST);
	    	$msg = "";
	    	if(empty($info['nomUser'])){
	    		$msg .= '<p>Le champ nom n\'a pas été renseigné</p>';
	    	}else{
	    		
	    	}
	    	if(empty($info['prenomUser'])){
	    		$msg .= '<p>Le champ prenom n\'a pas été renseigné</p>';
	    	}else{
	    		
	    	}
	    	if(empty($info['dtnUser'])){
	    		$msg .= '<p>Le champ date n\'a pas été renseigné</p>';
	    	}else{
	    		
	    	}
	    	if(empty($info['adresseUser'])){
	    		$msg .= '<p>Le champ adresse n\'a pas été renseigné</p>';
	    	}else{
	    		
	    	}
	    	if(empty($info['cpUser'])){
	    		$msg .= '<p>Le champ cp n\'a pas été renseigné</p>';
	    	}else{
	    		
	    	}
	    	if(empty($info['villeUser'])){
	    		$msg .= '<p>Le champ ville n\'a pas été renseigné</p>';
	    	}else{
	    		
	    	}
	    	if(empty($info['mailUser'])){
	    		$msg .= '<p>Le champ mail n\'a pas été renseigné</p>';
	    	}else{

	    		$retour = checkMail($info);

				if (!empty($retour['message'])) {
					$msg .= '<p>Votre mail n\'ai pas correct</p>';
			    }	    		
	    	}
	    	if(empty($info['paysUser'])){
	    		$msg .= '<p>Le champ pays n\'a pas été renseigné</p>';
	    	}else{
	    		
	    	}
	    	if ($info['mdpUser'] =="" ){
	            $msg .= "<p>vous n'avez pas entré de mot de passe</p>";
	            $tableauMsg = [ 'message' => $passwordcheck];
	        }else if(strlen($info['mdpUser'] ) < 5 || strlen($info['mdpUser'] ) > 21) {
	            $msg .= '<p>Le mot de passe doit être compris entre 6 et 20 caractères';
	           
	        }else if ($info['mdpUser'] != $info['confirMdpUser']) {
	            $msg .= '<p>Les mots de passes ne correspondent pas.';
	            $tableauMsg = [ 'message' => $passwordcheck];
	        }else{
	            $pass = password_hash($info['mdpUser'], PASSWORD_DEFAULT);
	           
	        }
	    

			if (empty($msg)) {
				
				$datas = [$info['nomUser'],$info['prenomUser'],$info['dttnUser'],$info['adresseUser'],$info['adresseBisUser'],$info['cpUser'],$info['villeUser'],$info['paysUser'],$info['mailUser'],$pass,$info['Civilite']];
				$newUser = new UserModel();
				$retour = $newUser->register($datas);

				if ($retour > 0) {
					$message = 'Votre enregistrement c\'est bien passé.';
					$donnees = ['message' => $message, 'color' => 'green'];
				}else{
					$message = "Une erreur c'est produitedd lors de votre enregistrement.";
					$donnees = [ 'message' => $message];
				}
				
			}else{
				//$message = "Une erreur c'est produite lors de votre ensdregistrement.";
				$donnees = [ 'message' => $msg];
			}

			echo json_encode($donnees);
		}


	}