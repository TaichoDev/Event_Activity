<?php 
	class CommentaireControlleur
	{

		public function delCommentaire(){
			// recupération des commemtaire de levements
			$datas = [$_GET['idcom'],
				$_GET['idEvent']
			];
			if(isset($_SESSION['USER']['ADMIN'])){

				$obj = new CommentaireModel();
				$idCommentaire = $obj->deleteCom($datas);
				$event = new EvenementsControlleur();
				$event->displayEvenement($_GET['idEvent']);
			}else{
				$message = "Seul l'administrateur peut supprimer un commentaire!";
			}
					
    	}



		public function addCom(){

			$commentaire = valid_donnees($_POST['moncommentaire']);


			$datas = ['idUser' => $_POST['idUser'],
				'idEvent' => $_POST['idEvent'],
				'commentaire' => $commentaire
			];

			$obj = new CommentaireModel();
			$idCommentaire = $obj->addCom($datas);
			
			if ($idCommentaire > 0) {

				$lescommentaires = new CommentaireModel();
				$resCommentaires = $lescommentaires->getCommentsOfEvent($_POST['idEvent']);
				$tableau = [
					'resCommentaires' => $resCommentaires			
				];

				$vue = new View($tableau,"commentaires",$resCommentaires['nomEvent']);			
				$vue->getView2();

			}else{
				$message = "une erreur c'est produite pendant l'ajout du commentaire";
			}
		

		



		}

	}