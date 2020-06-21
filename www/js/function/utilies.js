	'use strict';
	
	

	function addClasse(textAddClass,textRemoveClass){
	
		var contenaire_reponse_article = document.querySelectorAll("#contenaire_reponse > article");
		
		for (let i = 0; i < contenaire_reponse_article.length; i++) {
			contenaire_reponse_article[i].classList.remove(textRemoveClass);
			contenaire_reponse_article[i].classList.add(textAddClass);
		}
		
	}

	function getLaDate(){
		var laDate;
		var mydate = new Date();
		
		
		return  mydate.getFullYear()+"-"+doubleZero(mydate.getMonth()+1)+"-"+doubleZero(mydate.getDate())
	}

	function doubleZero(nombre){
		var valeur = nombre;
		if(nombre<10){
			valeur = "0"+ nombre;
		}	
		return valeur
	}



	/***
	*Sous-menu
	***/
	function sousmenu(element){

		var elementNext = element.target.nextElementSibling;
        elementNext.classList.toggle("toogleActive");
	}

	/**
	 * Fonction qui verifie si la chaine de caractere correspend a l'une des classes presentent dans l'element passé en parametre
	 * si c'est le cas on remonte au parent de l'element.
	 */
	function checkClassName(element, classname = null){
		if (element.classList.contains(classname) && classname != null) {
			element  = element.parentElement ;
		}
		return element
	}


	function deconnexion(){


		ajaxRequestMethod("index.php?page=deco",null,null,"GET");	
	}



	/**
	 * Permet d'effacer tous les composants présent dans la balise affiche_article
	 * 
	 */
	function vide_affiche_article(){
		var affiche_article = document.querySelector("#affiche_article");
		affiche_article.innerHTML = ""
	}
	/**
	 * Combine 2 methodes permetant d'effacer les composants présent dans les basiles contenaire_reponse et affiche_articles
	 * 
	 */
	function vide_all(){
		vide_affiche_article();
		vide_champ_contenaire_reponse();
	}
	/**
	 * Permet d'effacer tous les composants présent dans la balise contenaire_reponse
	 * 
	 */
	function vide_champ_contenaire_reponse(){
		var contenaire_reponse_article = document.querySelector("#contenaire_reponse");		
		contenaire_reponse_article.innerHTML = "";
		
	}


	function deleteEvent(element,page,retour){
		
		
		ajaxRequestMethod("index.php?page="+page+"&PARA="+element, null, retour, "GET");
		
	}


	/**
	 * Fonction permet afficher la liste des sliders et d'ajouter un ecouteur sur les  differents
	 * slides et en cas de clique permet de afficher le slide en selectionner
	 */
	function handler_click_gestion_banniere(){

		var contenaire_reponse_article = document.querySelector("#contenaire_reponse");
		contenaire_reponse_article.addEventListener("click", function(e) {
			if(e.target && e.target.className == "showSlider") {
				showSlider(e.target)
			}
		});

		vide_all();
		ajaxRequestMethod("index.php?page=lessliders", null, "contenaire_reponse", "GET");
	}

	/**
	 * Affiche le slide selectionner 
	 */
	function showSlider(element){
		var contenaire_reponse_article = document.querySelector("#affiche_article");
		contenaire_reponse_article.addEventListener("click", function(e) {
			if(e.target && e.target.className == "saveBaniere") {
				var element = document.querySelector("#newSlider");
				
				saveBaniere(element)
			}
		});

		ajaxRequestMethod("index.php?page=showmonslide&PARA="+element.dataset.slide, null, "affiche_article","GET");
	}




	/**
	 * Ajoute des informations dans le modal
	 */
	function insertInformationModal(idModal,element){
		
		var contactModal = document.getElementById(idModal);
			contactModal.innerHTML  = element.innerText;
			contactModal.dataset.id = element.dataset.id
			contactModal.dataset.page = element.dataset.suppression
	}

	function showModal(texte){
		
		var modal = document.getElementById(texte);
		var span = document.querySelector("#" + texte + " .close");	

		modal.style.display = "block";
		
		span.onclick = function() {
			modal.style.display = "none";
		}
		modal.onclick = function() {
			modal.style.display = "none";
		}
	}


	function addRemoveActive(num){
		var basile_contenaire_reponse_article = document.querySelectorAll("#contenaire_reponse > article");
		var basile_article = basile_contenaire_reponse_article[num].children;
		for (var i = 0; i < basile_article.length; i++) {
			basile_article[i].classList.remove("active");
		}
	}
	/**
	 * Permet de sauvegarder les modification effectuer sur un slide
	 */
	function saveBaniere(form){
		var parametres = new FormData(form);
		console.log(parametres)
		
		if (form[0].value !="" || form[2].value !="") {
			ajaxRequestMethod("index.php?page=saveBaniere",parametres,"information","POST");
		}else {
			document.getElementById('information').innerHTML = "Vous n'avez pas selectionné d'image";
		}
		showModal("myInformation")
	}



	function delete_element(id,page){
 		var idevent = document.querySelector('input[name="'+ id +'"]').value;
		ajaxRequestMethod("index.php?page=" + page + "&PARA="+idevent, null, "affiche_article","GET");		
	}

	function handler_change(e) {
		switch (e.target.id ) {
			case 'charger':
				readURL(e.target);
				break;
			case 'categorie':
				var valeur = document.getElementById("categorie").value;
				ajaxRequestMethod("index.php?page=showSsCateg&id="+valeur,null,"sscategorie","GET");
				break;	
		}
	}

	function readURL(input) {
		
	    if (input.files && input.files[0])
	    {
	    	var reader = new FileReader();
	        reader.onload = function (e) 
	        {
				var x =  document.querySelector("#imageEvent");
				var monImage = new Image();
				monImage.src = e.target.result;
				x.setAttribute("src",monImage.src);
	    	}
	    	reader.readAsDataURL(input.files[0]);
	    }
	}



