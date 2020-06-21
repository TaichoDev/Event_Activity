<?php


	require_once("config/config.php");
	require_once("www/php/function.php");
	require_once("class/autoloader.php");

	Autoloader::register();

	/**
	*	Routeur version Front
	**/
	
	if(isset($_GET["page"])){

		switch ($_GET["page"]) {
			
			case 'toutvoir':
				$elements = new EvenementsControlleur();
				$elements->displayListeEvenements();
				break;
	
			case 'unevenement':
				$elements = new EvenementsControlleur();
				$elements->displayEvenement();
				break;
			
			case 'evenement':
				//
				$element = new EvenementsControlleur();
				$element->displayEvenement();
				break;
			case 'photo':
				
				$accueil = new PhotoControlleur();
				$accueil->displayPhoto();
			break;
			case 'leselevements':
				
				$accueil = new PhotoControlleur();
				$accueil->displayPhoto();
				break;

			case 'logout':
				
				$accueil = new UserControlleur();
				$accueil->logout();
				break;
			case 'login':
				
				$accueil = new UserControlleur();
				$accueil->login();
				break;
			case 'register':
				
				$accueil = new UserControlleur();
				$accueil->register();
				break;
			case 'Rechercher':
				
				$accueil = new EvenementsControlleur();
				$accueil->rechercheEvenement();
				break;
			case 'addcom':
				
				$commentaire = new CommentaireControlleur();
				$commentaire->addCom();
				break;
			case 'delcom':
				
				$commentaire = new CommentaireControlleur();
				$commentaire->delCommentaire();
				break;
			case 'moncompte':
				
				$commentaire = new UserControlleur();
				$commentaire->monCompte();
				break;
			case 'modification':
				
				$commentaire = new UserControlleur();
				$commentaire->modificationCompte();
				break;

/**

	PARTIE ADMINISTRATION

**/


			
			case 'admin':
				

				$accueil = new ConnectionAdmin();
				$accueil->displayConnection();
				break;
			
			case 'logAdmin':
					
				$accueil = new ConnectionAdmin();
				$accueil->getConnect();
				break;
			
			case 'adminDashboard':
					
				$accueil = new GestionControlleur();
				$accueil->displayGestion();
				break;

			
			case 'layoutDate':
					
				$accueil = new GestionControlleur();
				$accueil->displayDate();
				break;

			
			case 'showAccountAdmin':
					
				$accueil = new AdminControlleur();
				$accueil->displayCreateAccount();
				break;

			
			case 'allAdmin':
				$vars = new AdminControlleur();
				$vars->selectAllAdmin();
				break;

			case 'selectedAdmin':
				$vars = new AdminControlleur();
				$vars->selectOneAdmin();
				break;

			case 'modifyadmin':
				
				$accueil = new AdminControlleur();
				$accueil->updateAdmin();
				break;

			case 'deleteAdmin':
				
				$accueil = new AdminControlleur();
				$accueil->deleteAdmin();
				break;
			case 'createadmin':
				
				$accueil = new AdminControlleur();
				$accueil->createAdmin();
				break;
			
			case 'createevent':
				
				$accueil = new EventControlleur();
				$accueil->displayCreateEvent();
				break;

			
			case 'showSsCateg':
				
				$accueil = new EventControlleur();
				$accueil->displayCreateEventSous();
				break;
			
			case 'addnewcontact':
				
				$accueil = new ContactControlleur();
				$accueil->addNewContact();
				break;
			
			case 'insertcontactevent':
				
				$accueil = new ContactControlleur();
				$accueil->addContactToEvent();
				break;
			

			case 'insertevent':
				
				$accueil = new EventControlleur();
				$accueil->createEvent();
				break;

			case 'listevent':
				$accueil = new EventControlleur();
				$accueil->dateEventSelected();
				break;

			case 'listeventmois':
				
				$accueil = new EventControlleur();
				$accueil->dateEvenOfMonth();
				break;
			case 'lesCommentaires':
				
				$accueil = new CommentaireControlleur();
				$accueil->getComsOfEvent();
				break;
			case 'listcom':
				
				$eventComs = new EventControlleur();
				$eventComs->dateEventSelected();
				break;
			case 'leEvenement':
				
				$accueil = new EventControlleur();
				$accueil->displayEvent();
				break;
			case 'modifyevent':
				
				$accueil = new EventControlleur();
				$accueil->modifyevent();
				break;


			case 'deleteEvent':
				
				$accueil = new EventControlleur();
				$accueil->deleteEvent();
				break;
				
			case 'lescontacts':
				
				$accueil = new ContactControlleur();
				$accueil->selectAllContactC();
				break;
			case 'createcontact':
				
				$accueil = new ContactControlleur();
				$accueil->createContact();
				break;
			case 'showcontact':
				
				$accueil = new ContactControlleur();
				$accueil->showcontact();
				break;
				
			case 'saveModifContact':
				
				$accueil = new ContactControlleur();
				$accueil->updateContactC();
				break;

			case 'suppressioncontact':
				
				$accueil = new ContactControlleur();
				$accueil->suppressionContactC();
				break;
			case 'lessliders':
				
				$sliders = new BanniereControlleur();
				$sliders->displayListeOfSlider();
				break;
			case 'showmonslide':
				
				$sliders = new BanniereControlleur();
				$sliders->showOneSlider();
				break;

			case 'saveBaniere':
				
				$sliders = new BanniereControlleur();
				$sliders->saveSlider();
				break;

			case 'deco':
				
				$admin = new AdminControlleur();
				$admin->deconnexion();
				break;

			default:
				$accueil = new Accueil();
				$accueil->displayHome();
				break;
		}
	
	}else{

		$accueil = new Accueil();
		$accueil->displayHome();

	}
