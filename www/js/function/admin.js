	'use strict';

	/**
	 * function qui permet de creer un administrateur, aussi d'ajouter un event
	 */
	function handler_click_show_admin(element){
		vide_all();
		var id  = element.dataset.id ;
		var page  = element.dataset.page ;			

		var contenaire_reponse_article = document.querySelector("#affiche_article");
		contenaire_reponse_article.addEventListener("click", function(e) {
			if(e.target && e.target.className == "modifyAdmin") {
				modifyAdmin()
			}
		});
		ajaxRequestMethod("index.php?page="+ page +"&ID="+id, null, "affiche_article","GET");
		
	}



 	function modifyAdmin()
 	{
		var form = document.querySelector('#accountAdmin');
		var parametres = new FormData(form);
		ajaxRequestMethod("index.php?page=modifyadmin",parametres,"contenaire_reponse","POST");
 	}

 	