	'use strict';
	
	/**
	 * function qui permet d'afficher la liste de tout les contacts, aussi d'ajouter un event
	 */
	function handler_click_all_contact(){

		var contenaire_reponse = document.querySelector("#contenaire_reponse");
		var element;
		contenaire_reponse.addEventListener("click", function(e) {
			
			if(e.target && e.target.classList.contains("voir_contact") || e.target.classList.contains("fa-eye") ) {
				element = checkClassName(e.target,'fa-eye');
				voir_contact(element);
			}else if(e.target && e.target.classList.contains("supprimer_contact") || e.target.classList.contains("fa-times") ){
				element = checkClassName(e.target,'fa-times');
				supprimer_contact(element);
			}
		});
		
		vide_all();
		ajaxRequestMethod("index.php?page=lescontacts", null, "contenaire_reponse", "GET");
	}



	/**
	 * Permet de creer un nouveau contact 
	 */
	function handler_click_create_contact(){

		var contenaire_reponse_article = document.querySelector("#affiche_article");
		contenaire_reponse_article.addEventListener("click", function(e) {
			if(e.target && e.target.className == "addContact") {
				addContact(e.target);
			}
		});
		vide_all();
		ajaxRequestMethod("index.php?page=createcontact", null, "affiche_article", "GET");
	}


	/**
	 * function pour supprimer un contact 
	 */
	function suppressionContact(element){
		
		var element = element.parentElement.parentElement.previousElementSibling.children[0];
		ajaxRequestMethod("index.php?page="+element.dataset.page+"&ID=" + element.dataset.id, null, "contenaire_reponse","GET");
		var modal = document.getElementById("myModal");
		modal.style.display = "none";

		vide_affiche_article()
	}



	function voir_contact(element){
		
		var id  = element.parentElement.dataset.id ;
		var page  = element.parentElement.dataset.page ;			

		var contenaire_reponse_article = document.querySelector("#affiche_article");
		contenaire_reponse_article.addEventListener("click", function(e) {
			if(e.target && e.target.className == "modifyContact") {
				modifyContact()
			}else if(e.target && e.target.className == "modifyAdmin") {
				modifyAdmin()
			}
		});

		ajaxRequestMethod("index.php?page="+ page +"&ID="+id, null, "affiche_article","GET");

	}

	function supprimer_contact(element){
		var suppression  = element.parentElement.dataset.suppression ;
		showModal("myModal");
		insertInformationModal("contactModal",element.parentElement)
	}



	function selectContact(){

		var idEvent = document.querySelector('input[name="idEvent"]').value;
		var valeurs = document.querySelectorAll("#idAjoutContact input[name=contacts]:checked");
		var parametres = new FormData();
		var tab = [];
		// on recupere que les inputs qui sont checked
		for (var i = 0; i < valeurs.length; i++) {
			tab[i] = valeurs[i].value			
		}
		parametres.append("contactslist",tab);
		parametres.append("idEvent",idEvent);
		parametres.append("noActive",true);
		ajaxRequestMethod("index.php?page=insertcontactevent",parametres,"contactevent","POST");
	}


	function addContact(){		
		/**
		 * 
		 * Verifier si tout les champs essentiels sont remplies
		 *		  
		 */

		/**
		 * ajoute d'un contact dans la base de données
		**/
		var parametres = new FormData();
		var valeurs = document.querySelectorAll("#section1_contact input");	
		var select = document.querySelector("#section1_contact #civilite option:checked").value;
		for (var i = 0; i < valeurs.length; i++) {
			parametres.append(valeurs[i].name, valeurs[i].value);
		}
		parametres.append('idCivlie', select);
		
		if (document.querySelector('input[name="idEvent"]').value !== "") {

			var idEvent = document.querySelector('input[name="idEvent"]').value;
			parametres.append('idEvent', idEvent);
		}

		ajaxRequestMethod("index.php?page=addnewcontact",parametres,"listeContact","POST");
		ajaxRequestMethod("index.php?page=createcontact",null,"id_section_contact","GET");
		document.getElementById('information').innerHTML = "Le contact a bien été ajouté";
		showModal("myInformation")
	}

 	function modifyContact()
 	{ 		
		var parametres = new FormData();
		var valeurs = document.querySelectorAll("#section1_contact input");
		var select = document.querySelector("#section1_contact #civilite option:checked").value;
		for (var i = 0; i < valeurs.length; i++) {
			parametres.append(valeurs[i].name, valeurs[i].value);
		}
		parametres.append('idCivlie', select);
		ajaxRequestMethod("index.php?page=saveModifContact",parametres,"liste_des_contacts","POST");
 	}