	

	
	var menu = document.querySelector(".menu");
	var btnclose = document.querySelector(".modal .close");
	var btnregister = document.querySelectorAll(".out");
	var btnlogin = document.querySelector("#login");
	var menu = document.querySelectorAll(".menu");
	var cancellog = document.querySelectorAll(".cancellog");
	var btnaccueil = document.querySelector(".accueil");
	var btnvaliderlogout = document.querySelector("#validerlogout");
	var modal_content_section = document.querySelector(".modal-content section");
	var btnvaliderlogin = document.querySelector("#validerlogin");
	var btnvalinscription = document.querySelector("#valinscription");
	var mHamburger = document.querySelector("#menu-hamburger");
	//var delcom = document.querySelector(".delCom");
	var contenaire_evenements = document.querySelectorAll(".contenaire-evenements");


	document.addEventListener('DOMContentLoaded', function(){

		for (var i = 0; i < cancellog.length; i++) {
			cancellog[i].addEventListener('click',function(){
				hide(".modal");
			});
		}
		for (var i = 0; i < menu.length; i++) {
			menu[i].addEventListener('click',handler_click_id);
		}
		for (var i = 0; i < btnregister.length; i++) {
			btnregister[i].addEventListener('click',showmodalregister);
		}
		mHamburger.addEventListener("click",onClickEffectMenu);

		for (var i = 0; i < contenaire_evenements.length; i++) {
			contenaire_evenements[i].addEventListener('click',handler_click_id);
		}

		// delcom.addEventListener("click",function(e){
			
		// 	deleteCom(this);
		// });


		btnaccueil.addEventListener("click",accueil);

		btnvaliderlogin.addEventListener("click",login);
		btnvaliderlogout.addEventListener("click",logout);
		btnvalinscription.addEventListener("click",register);
		btnclose.addEventListener("click",function(){
			hide(".modal");
		});
		//btnregister.addEventListener('click',showmodalregister);
		
		btnlogin.addEventListener('click',showmodallogin);
		
	   
	});

	function onClickEffectMenu() {
		//ajout de la classe change pour l'animation sur le menu hamburger
		this.classList.toggle("change");
		//ciblage de l'élément frère precedent pour ajoute une classe afin de faire apparaitre la barre laterale
		this.previousElementSibling.classList.toggle("active");
	}

	window.onscroll = function() {scrollFunction()};

	function scrollFunction() {
	  if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
	    document.querySelector("header").style.padding = "0px";

		var i;
		for (i = 0; i < document.querySelectorAll("ul.menu li").length; i++) {
			document.querySelectorAll("ul.menu li")[i].style.margin = "20px 20px 0";;
		}
		document.querySelector("#contenaire-recherche").style.margin = "10px auto";
		document.querySelector("#contenaire-recherche").style.flex = "0 100%";
		document.querySelector("#contenaire-recherche").style.left = "-40px";
	    document.querySelector("#logo img").style.width = "75px";

	  } else {
		 
	    document.querySelector("header").style.padding = "30px 0px";
		var i;
		for (i = 0; i < document.querySelectorAll("ul.menu li").length; i++) {
			document.querySelectorAll("ul.menu li")[i].style.margin = "20px";;
		}
		document.querySelector("#contenaire-recherche").style.margin = "0 auto";
		document.querySelector("#contenaire-recherche").style.flex = "0 100%";
		document.querySelector("#contenaire-recherche").style.left = "initial";
	    document.querySelector("#logo img").style.width = "100px";
	  }
	}


	
	





	function handler_click_id(e){
		

		switch (e.target.id) {
			
			case 'logout':
				
				showmodaldeco();
				break;
			case 'delCom':
				deleteCom(this);
				break;
			case 'sendCom':
				
				addcom();
				break;
			case 'modification':
				
				modification();
				break;
			case 'inorout':
				
				showmodalInOrOut();
				break;
			}

	}

	function handler_click_name(e){
		
		var element = e.target;
		if (element.classList.contains('close') || element.classList.contains('cancellog')) {
			var modal = e.target.parentElement.parentElement.parentElement
			modal.style.display = "none";
		}else if(element.classList.contains('validerlogout')) {
			logout()
		}

	}

	function showMyModal(idmodal){
		var modal = document.getElementById(idmodal);
		modal.style.display = "block";
		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
	}

	
	function hide(idmodal){
		var modal = document.querySelector(idmodal);
		modal.style.display = "none";			
	}

	function showSection(idmodal){
		
		var modal = document.getElementById(idmodal);
		modal.style.display = "block";			
	}


	function showmodalInOrOut(){
		showMyModal("myModal");
		hide_section_modal();
		showSection("inOrOut");
	}



	function hide_section_modal(){
		//var modal_content_section = document.querySelector(".modal-content section");
		var section_modal = document.querySelectorAll(".modal-content > section");
		for (var i = 0; i < section_modal.length ;  i++) {
			section_modal[i].style.display = 'none';
		}

	}

	function showmodaldeco(){


		showMyModal("myModal");
		hide_section_modal();
		showSection("myLogOut");
	}
	
	function showmodalregister(){
		
		hide_section_modal();
		showSection("myInsciption");
	}



	function showmodallogin(){		
		hide_section_modal();
		showSection("myLogin");
	}


	function logout(){
		ajaxRequest('index.php?page=logout');
	}

	function accueil(){

		ajaxRequest('index.php', null,null)
	}


	function login(){
		var form = document.querySelector('#datalogin');
		hide_section_modal();
		var datas =  new FormData(form);
		ajaxRequest('index.php?page=login', datas,'msg')

		showSection('accueil');
	}

	function register(){
		
		
		var form = document.querySelector('#dataRegister');
		
		hide_section_modal();
		var datas =  new FormData(form);
		ajaxRequest('index.php?page=register', datas,'info');



		showSection('myRegister');

	}


	function ajaxRequest(url,parametre = null,text = null) {
		var xmlhttp = new XMLHttpRequest();
      
        xmlhttp.onreadystatechange = function() {
			
            if (this.readyState == 4 && this.status == 200) {
        		if (text != null ) {        			
        			var message = JSON.parse(this.responseText);
        			if(message.message != "" ){ 

        				document.getElementById(text).innerHTML = message.message;
        				document.getElementById(text).classList.add(message.color)
        			}else {
        				document.getElementById(text).innerHTML = this.responseText;
        			}
        		}else{ 

        			location.reload();
        		}
            }
        };
        xmlhttp.open("POST",url,false);
        xmlhttp.send( parametre);
	}

	function ajaxRequestSansModal(url,parametre = null,text = null,method = 'POST') {
		var xmlhttp = new XMLHttpRequest();
      
        xmlhttp.onreadystatechange = function() {
			
            if (this.readyState == 4 && this.status == 200) {
        		if (text != null ) {
        			
        			
        			
        				document.getElementById(text).innerHTML = this.responseText;
        			
        		}else{ 

        			location.reload();
        		}
            }
        };
        xmlhttp.open(method,url,false);
        xmlhttp.send( parametre);
	}




	function plusDivs(n) {
	  showDivs(slideIndex += n);
	}

	function currentDiv(n) {
	  showDivs(slideIndex = n);
	}

	

	function deleteCom(element){
		var idEvent = document.querySelector('#idEvent').value;
		var idcom = element.dataset.idcom;
		var parametres = new FormData();
		parametres.append("idcom", idcom);
		parametres.append("idEvent", idEvent);
		ajaxRequestSansModal('index.php?page=delcom', parametres,'lescommentaires')
	}


	function addcom(){
		var form = document.querySelector('#addcom');
		var datas =  new FormData(form);
		form[0].value = "";
		ajaxRequestSansModal('index.php?page=addcom', datas,'lescommentaires')
	}


	function modification(){
		var form = document.querySelector('#infos');
		var datas =  new FormData(form);
		form[0].value = "";
		ajaxRequest('index.php?page=modification', datas,'message')
		showMyModal("myModal");
		hide_section_modal();
		showSection("myInformation");
	}
