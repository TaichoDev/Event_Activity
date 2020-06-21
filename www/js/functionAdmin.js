	'use strict';

	var clickSousMenu 		= document.querySelectorAll(".menu > button");
	var createMyEvent 		= document.querySelector("#creer_evenement");
	var affiche_article 	= document.querySelector("#affiche_article");
	var listOfMyEvents 		= document.querySelector("#listeevenement");
	var listOfContacts 		= document.querySelector("#liste_tout_contact");
	var createContact 		= document.querySelector("#ajout_contact");
	var showAdmin 	= document.querySelector("#mon_profil");

	var contenaire_reponse 	= document.querySelectorAll("#contenaire_reponse");
	var gestion_banniere 	= document.querySelector("#gestion_banniere");

	var btnSuppressionContact = document.querySelector(".suppressionContact");

	



	document.addEventListener('DOMContentLoaded', function(){
		for (var i = 0; i < clickSousMenu.length; i++) {
			clickSousMenu[i].addEventListener("click",sousmenu);
		}
		

		listOfContacts.addEventListener("click",handler_click_all_contact);
		createContact.addEventListener("click",handler_click_create_contact);
		affiche_article.addEventListener("change",handler_change);

		showAdmin.addEventListener('click',
			function(e){
				handler_click_show_admin(this)
		});
		gestion_banniere.addEventListener('click', function(e){
			handler_click_gestion_banniere(this);
			});

		
		btnSuppressionContact.addEventListener('click', 
			function(e){
				suppressionContact(this)
		});

		/**
		 * Affiche un formulaire pour pouvoir creer une evenement
		 */
		createMyEvent.addEventListener("click",createEvent);
		/**
		 * Affiche l'ensemble des evenements 
		 */


		listOfMyEvents.addEventListener("click",function(e){
			vide_affiche_article();
		
			listEvents();
		});

		
		
		listEvents();
	});






	
	


