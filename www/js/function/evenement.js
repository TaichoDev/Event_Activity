	'use strict';
	
	/**
	 * Cette fonction reçoit en parametre une date en cas de date null c'est la date du jour qui est attibué.
	 * elle permet d'afficher tous les évènements de la date passé en parametre
	 * @param  {date} ladate [date selectionné par l'utilisateur]
	 */
	function listEvents(ladate = null){
		
		//debugger;

		if (ladate==null) {	
			ladate=getLaDate()
		}	
		
		
		
		var contenaire_reponse = document.querySelector("#contenaire_reponse");
		
		ajaxRequestMethod("index.php?page=listevent&by=eventOfday&PARA="+ladate, null, "contenaire_reponse","GET");
		contenaire_reponse.addEventListener("change", function(e) {



			if(e.target && e.target.className == "myFunction") {
				vide_affiche_article()
				var ladate = (e.target.value)
				ajaxRequestMethod("index.php?page=listevent&by=eventOfday&PARA="+ladate, null, "contenaire_reponse","GET");
			}
		});

		contenaire_reponse.addEventListener("click", function(e) {
			
			if(e.target && e.target.className == "showEvent") {
				showEvent(e.target)
			}
		});

	
	}
		function myFunction(element){			
		listEvents(element.value);
	} 

	/**
	 * Permet de créer un évènement et d'ajoute des ecouteur sur cet evenement
	 */
	function createEvent(){
		var contenaire_reponse_article = document.querySelector("#affiche_article");
		contenaire_reponse_article.addEventListener("click", function(e) {

			if(e.target && e.target.className == "selectContact") {
				selectContact()
			}else if(e.target && e.target.className == "create_event") {
				create_event()
			}
		});
		vide_all();
		ajaxRequestMethod("index.php?page=createevent",null,"affiche_article","GET");
	}




	/**
	 * [showEvent description]
	 */
	function showEvent(element){
		
		var contenaire_reponse_article = document.querySelector("#affiche_article");
		contenaire_reponse_article.addEventListener("click", function(e) {

			if(e.target && e.target.className == "save_modify_event") {
				save_modify_event()
			}else if(e.target && e.target.className == "selectContact") {
				selectContact()
			}else if(e.target && e.target.className == "delete_event") {
				delete_event()
			}else if(e.target && e.target.className == "addContact") {
				addContact()
			}
			
		});


		var article = document.querySelector('#contenaire_reponse > article');
		if(article.classList.contains('liste_evenement')){
			
			ajaxRequestMethod("index.php?page=leEvenement&PARA="+element.dataset.idevent, null, "affiche_article","GET");
			
		}else if(article.classList.contains('liste_commentaire')){
				
			ajaxRequestMethod("index.php?page=lesCommentaires&PARA="+element.dataset.idevent, null, "affiche_article","GET");	
		}
	}


	


	function create_event(){
		var form = document.querySelector('#newEvent');

		//controle evement a faire certains champs sont obligatoires
		var parametres = new FormData(form);
		var tab = [];
		var valeurs = document.querySelectorAll("#contactevent .objContact");

		for (var i = 0; i < valeurs.length; i++) {
			tab[i] = valeurs[i].dataset.id;
		}
		parametres.append("contactevent", tab);
		ajaxRequestMethod("index.php?page=insertevent",parametres,"affiche_article","POST");
		

	}



	/**
	 * Permet de sauvegarder les modificatons effectuer sur un évènement
	 */

	function save_modify_event(){

		var form = document.querySelector('#newEvent');
		var parametres = new FormData(form);
		var tab = [];
		var valeurs = document.querySelectorAll("#contactevent .objContact","POST");
		for (var i = 0; i < valeurs.length; i++) {
			tab[i] = valeurs[i].dataset.id;
		}
		parametres.append("contactevent", tab);
		parametres.append("idEvent", form[0].value);
		ajaxRequestMethod("index.php?page=modifyevent",parametres,"affiche_article","POST");
		showModal("myInformation")
		document.getElementById('information').innerHTML = "Les modifications ont été effectué";
	}

	
	function delete_event(){
 		var idEvent = document.querySelector('input[name="idEvent"]').value;

		ajaxRequestMethod("index.php?page=deleteEvent&PARA="+idEvent, null, "affiche_article","GET");	
		listEvents();
	}
