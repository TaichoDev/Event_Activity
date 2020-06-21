<?php


	
	class ContactControlleur
	{

      	public function selectAllContactC($data = NULL){

            $obj = new ContactModel();
            $resultats = $obj->selectAllContactM(NULL);
           
            $tableau['obj3']= $resultats;

      		$maVue = new View($tableau,"contactevent","Administration");
            $maVue->getViewBack();
        }

        public function selectAllContactSelectEvent($data = []){

           

            $obj = new ContactModel();
            $resultats = $obj->selectContactSelected($data);;
           
            return $resultats;

    
        }

        public function selectAllContactC_result($data = []){

            $obj = new ContactModel();
            $resultats = $obj->selectAllContactM(   $data);
  
            return $resultats;
        }


      
        /**
         * Ajout d'un contact dans la base de données 
         */
        public function addNewContact(){

            if (!empty($_POST["idEvent"])) {

                $rq3 = "SELECT ct.* FROM evenement e
                INNER JOIN rel_event_contact rec ON rec.idEvent = e.idEvent
                INNER JOIN contact ct ON ct.idContact = rec.idContact
                WHERE e.idEvent = ? ";
                $date = [$_POST["idEvent"]];
                $event = new ContactModel();
                $obj3 = $event->selectContactSelected($rq3,$date);

            }
       
            $nameOrg = valid_donnees(trim($_POST["nameOrg"]));
            $nameContact = valid_donnees(trim($_POST["nomContact"]));
            $prenomContact = valid_donnees(trim($_POST["prenomContact"]));
            $telFixe = valid_donnees(trim($_POST["telFixContact"]));
            $telMob = valid_donnees(trim($_POST["telMobContact"]));
            $idCiv = valid_donnees(trim($_POST["idCivlie"]));

            if(empty($nameOrg)){

                $tabErreur["nameOrg"] = "Vous n'avez pas mis de l'organisation";              
            }
            if(empty($nameContact)){

                $tabErreur["nameContact"] = "Vous n'avez pas mis le nom du contact";
                
            }
            if(empty($telMob) ){

                $tabErreur["telMobContact"] = "Vous n'avez pas le numero du contact";
                
            }
            
            if(tabIsEmpty($tabErreur)  == true){


                $reqInsertContact = "INSERT INTO `contact`(`idContact`, `orgContact`, `nomContact`, `prenomContact`, `telFixeContact`, `telMobContact`, `idCiv`) VALUES (?,?,?,?,?,?,?)";
                $parametre = [NULL, $nameOrg, $nameContact,$prenomContact,$telFixe,$telMob,$idCiv];
                $obj = new ContactModel();
                $resultat = $obj->insertContactM($reqInsertContact,$parametre);            
                if ($resultat > 0) {
                    $message = $nameOrg." a bien été ajouté dans la base de données";
                }else{
                    $message = "Une erreur lors de l'ajout";
                }


                $tableau['obj5']  = $this->selectAllContactC_result();

                $tableau['obj3']  = $this->selectAllContactSelectEvent($_POST["idEvent"]);
                $this->selectAllContactC();
            }else{



                $tableau['nameOrg']            = $nameOrg;
                $tableau['nameContact']            = $nameContact;                     
                $tableau['prenomContact']            = $prenomContact;
                $tableau['telFixe']    = $telFixe;
                $tableau['telMob']            = $telMob;
                $tableau['idCivlie']          = $idCiv;



                $tableau['message']             = $tabErreur;



                //$message = 'Votre identifiant ou mot de passe sont erronnés';
                $donnees = ['message' => $tableau['message'], 'color' => 'red'];
                


                //$maVue = new View($tableau,"createEvenement","Administration");
                //$maVue->getViewBack();

                echo json_encode($donnees);
            }
        }


        //Ajout d'un contact à un évènement
        public function addContactToEvent(){
            //on recupere les contacts déjà présent dans le liste des contacts de l'évènement
            $obj = new ContactModel();
            if (!empty($_POST["idEvent"])) {

                $date = [$_POST["idEvent"]];
                $obj3 = $obj->selectContactSelected($date);

            }
            $contactslist  = explode(",", $_POST["contactslist"] );
         
           
            $obj = new ContactModel();
            $objContact['obj3'] = $obj->selectContactSelectedSP($contactslist);           

            $objContact['noActive'] = $_POST["noActive"]; 
            //include 'www/templates/management/contactevent.phtml';
            $maVue = new View($objContact,"contactevent","Administration");
            $maVue->getViewBack();

        }

                //Ajout d'un contact à un évènement
        public function addContactToEventB($listeContact){
            //on recupere les contacts déjà présent dans le liste des contacts de l'évènement
  

            $contactslist  = explode(",", $listeContact );
         
           
            $obj = new ContactModel();
            $resultat = $obj->selectContactSelectedSP($contactslist);           

            return $resultat;

        }


        public function updateContactC(){

            
            $ID = $_POST["idContact"];
            $nameOrg = trim($_POST["nameOrg"]);
            $nameContact = trim($_POST["nomContact"]);
            $prenomContact = trim($_POST["prenomContact"]);
            $telFixe = trim($_POST["telFixContact"]);
            $telMob = trim($_POST["telMobContact"]);
            $idCiv = trim($_POST["idCivlie"]);
            $parametres = [$nameOrg, $nameContact,$prenomContact,$telFixe,$telMob,$idCiv,$ID];
         
            $obj = new ContactModel();
            $obj->updateContactM($parametres);

            $objContact = $this->selectAllContactC();
            $tableau = [
                'objContact' => $objContact
            ];

            $maVue = new View($tableau,"createContact","Administration");
            $maVue->getViewBack();
        }

        public function suppressionContactC(){
            $ID = [$_GET["ID"]];
            $obj = new ContactModel();
     
            $objContact = $obj->suppressionContactM($ID); 
           
            $resultat = ($objContact>=1) ? "Le contact bien été supprimer" : "Une erreur est survenu dans la suppression du contact";

            $objContact = $this->selectAllContactC();
        

            $tableau = [ 'resultat' => $resultat, 'cas' => "suppression",'objContact' => $objContact ];

            $maVue = new View($tableau,"contactevent","Administration");
            $maVue->getViewBack();
        }

        private function lesChampsContact(array $monContact = null) : array
        {
            
            $tabChamp = [
                'idContact' => (isset($monContact["idContact"])) ? $monContact["idContact"] :  '' ,
                'orgContact' => (isset($monContact["orgContact"])) ? $monContact["orgContact"] :  '' ,
                'nomContact' => (isset($monContact["nomContact"])) ? $monContact["nomContact"] :  '' ,
                'prenomContact' => (isset($monContact["prenomContact"])) ? $monContact["prenomContact"] :  '' ,
                'telFixeContact' => (isset($monContact["telFixeContact"])) ? $monContact["telFixeContact"] :  '' ,
                'telMobContact' => (isset($monContact["telMobContact"])) ? $monContact["telMobContact"] :  '' ,
                'titre' => $monContact["idContact"] ? 'Contact' :  'Nouveau contact',
                'idCiv' => (isset($monContact["idCiv"])) ? $monContact["idCiv"] :  '' ,
            ];
            return $tabChamp;
        }


        public function showContact(){
            // verifie si c'est bien un nombre
            $ID = [$_GET["ID"]];
            $laRequete = "SELECT * FROM contact WHERE idContact = ?";
            $obj = new ContactModel();
            $leschamps = $obj->selectContactSelected($laRequete,$ID); 

            $objContact = $this->lesChampsContact($leschamps[0]);
            
            
            $maVue = new View($objContact,'createContact',"Administration");
            $maVue->getViewBack();
        }

        public function addContactToEventC($donnees){

            $contact  = new ContactModel();
            $resutalts = $contact->addContactToEventM($donnees);
            return $resultats;
        }

        public function createContactEven(){

            $objContact = $this->lesChampsContact();
            $maVue = new View($objContact,"createContactEven","Administration");
            $maVue->getViewBack();

        }

        public function createContact(){

          
            $maVue = new View(null,'createContact',"Administration");
            $maVue->getViewBack();
        }


        public function deleteContactToEvent($donnees){
            $contact  = new ContactModel();
            $resutalt = $contact->deleteContactToEventM($donnees);
            return $return;
        }

    }
