	'use strict';


    function ajaxRequestMethod(url,parametre = null,text = null,method = 'POST') {

		var xmlhttp = new XMLHttpRequest();      
        xmlhttp.onreadystatechange = function() {			
            if (this.readyState == 4 && this.status == 200){ 

                try {
                    var message = JSON.parse(this.responseText);
                   
                    var rtrMsg = "<ul>"
                    Object.getOwnPropertyNames(message.message).forEach(function(key){
                      var word = message.message[key];
                      rtrMsg += "<li>"+ word +"</li>";
                    });
                    rtrMsg += "</ul>";

                    console.log(rtrMsg)
                    
                 
                    document.getElementById("information").innerHTML = rtrMsg;
                    document.getElementById("information").classList.add(message.color)
                    showModal("myInformation");

                } catch (e) {
                    if (text != null ) {

                        document.getElementById(text).innerHTML = this.responseText;
                    }else{
                        location.reload();
                    }
                }
                
            }
        };
        xmlhttp.open(method,url,true);
        xmlhttp.send( parametre);
	}

