<?php


	class ConnectionAdmin
	{
		/**
		 * Affiche la page de connection
		 */
		public function displayConnection()
		{

	        //Si on est deja connecter en tant qu'admin on n'affache pas cet page
	        if (isset( $_SESSION['USER']['ADMIN'])){
	            header("Location: index.php?page=adminDashboard");

	        }elseif (!isset( $_SESSION['USER']['ADMIN']) && isset($_SESSION['USER'])){// un simple utilisateur n'a pas acces a cette page
	            header("Location: index.php");
	        }


			$maVue = new View(NULL, "pageConnectionAdmin","Connection");
            $maVue->getViewBack2();
		}

		/**
		 * Permet de se deconnecter de l'administration
		 */
		public function deco()
		{
			// Finalement, on détruit la session.
			session_destroy();
			$monNewUser = new Accueil();
			$monNewUser->displayHome();
		}

		/**
		 * Verification des informations pour se connecter
		 */
		public function getConnect()
		{

			$tabDonnees = array();
	 		$erreur = array();
			//Traitement des informations du client
			if (isset($_POST["loguer"]))
			{
				$adresseMail = trim($_POST["mail"]);
				$passUser = trim($_POST["mdp"]);

				if(empty($adresseMail)){
					$erreur['adresseMail'] =  "Il y a une erreur dans votre mail.";
				}elseif(!filter_var($adresseMail, FILTER_VALIDATE_EMAIL) ){
					$erreur['adresseMail'] = "Vous avez une erreur dans votre adressse mail";
				}else{
					$tabDonnees = array( $adresseMail);
				}

				if(empty($passUser)){
					$erreur['mdpCrypte'] = "Vous n'avez pas saisi de mot de passe";
				}
				if (count($erreur)==0)
				{

					$monNewUser = new GestionAdmin();
					$laRequete = "SELECT * FROM `admin` WHERE `mailAdmin` = ?";
					$user = $monNewUser->selectGestion($laRequete, $tabDonnees);
					//on test le password
					if (password_verify($passUser, $user["passwordAdmin"]))
					{
						$_SESSION= array();
						$_SESSION['USER']['TYPE'] = $user["idTypeAdmin"];
						$_SESSION['USER']['ADMIN'] = $user["pseudo"];
						$_SESSION['USER']['MAIL'] = $user["mailAdmin"];
						$_SESSION['USER']['ID'] = $user["idAdmin"];
						$gestion = new GestionControlleur();
						$gestion->displayGestion();
					} else {
					    $this->displayConnectionErreur($erreur);
					}

				}else{
					$this->displayConnectionErreur($erreur);
				}
			}else{
				$this->displayConnectionErreur();
			}
		}

		public function displayConnectionErreur($erreurs = NULL)
		{

			$maVue = new View(NULL, "pageConnectionAdmin","Connection");
            $maVue->getViewBack2();
		}

	}
