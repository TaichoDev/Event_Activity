<?php 
    class CommentaireModel{

        public function getCommentsOfEvent($idEvent){

            $requete = "SELECT com.*, nomEvent,u.idUser,u.nomUser FROM rel_user_com_event_statut ruces INNER JOIN commentaire com ON com.idCommentaire = ruces.idCom INNER JOIN evenement e ON e.idEvent = ruces.idEvent INNER JOIN user u ON u.idUser = ruces.idUser WHERE e.idEvent = ?";
            $data = [$idEvent];

            $event = new Bdd(HOST,BASE,USER,PWD);
			$commentairesOfEvent = $event->requetesExec($requete,$data);

			
			return $commentairesOfEvent;
        }

        public function deleteCom($datas){
           
            $commentaire = new Bdd(HOST,BASE,USER,PWD);
            $requete = "DELETE FROM `rel_user_com_event_statut` WHERE idCom = ? AND idEvent = ? ";
            $idCommentaire = $commentaire->updateDeleteExec($requete,$datas);
            $requete = "DELETE FROM `commentaire` WHERE idCommentaire = ? ";
            $idCommentaire = $commentaire->updateDeleteExec($requete,[$datas[0]]);
            return $idCommentaire;
        }


        public function addCom($datas){
            $requete = " INSERT INTO `commentaire`(txtCommentaire , idPereCommentaire, dateValidCommentaire) VALUES ( ? , ?, NOW() ) ";
            $lesdatas = [$datas['commentaire'],0];
            $event = new Bdd(HOST,BASE,USER,PWD);
            $idCommentaire = $event->insertionExec($requete,$lesdatas);
            
            if($idCommentaire > 0){   

                $requete = "INSERT INTO `rel_user_com_event_statut`(`idUser`, `idCom`, `idEvent`, `idStatut`, `dateValid`) VALUES (?, ? , ? , ? , now() )"; 
                $lesdatas = [$datas['idUser'], $idCommentaire, $datas['idEvent'], 2];
                $commentairesOfEvent = $event->insertionExec($requete,$lesdatas);
                 
            }


            return $idCommentaire;

            
        }


    }