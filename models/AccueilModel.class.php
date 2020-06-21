<?php

	/**
	 *
	 */
	class AccueilModel
	{

		public function requeteAccueil()
		{	
			

			//liste des evenements ajouter récemment
			$requete1 = "SELECT idEvent, nomEvent,nomPhoto,urlPhoto,nomCategorie, nomSSCateg,dateEvent FROM evenement e INNER JOIN photo p ON p.idPhoto = e.idPhoto INNER JOIN ss_categorie ssc ON ssc.idSSCateg = e.idSsCategorie INNER JOIN categorie c ON c.idCategorie = ssc.idCategorie WHERE e.dateevent > now() ORDER BY idEvent desc LIMIT 4";
			
			//liste des evenements passé
			$requete2 = "SELECT idEvent, nomEvent,nomPhoto,urlPhoto,nomCategorie, nomSSCateg,dateEvent FROM evenement e INNER JOIN photo p ON p.idPhoto = e.idPhoto INNER JOIN ss_categorie ssc ON ssc.idSSCateg = e.idSsCategorie INNER JOIN categorie c ON c.idCategorie = ssc.idCategorie WHERE e.dateevent < now() ORDER BY dateEvent DESC LIMIT 4";

			$event = new Bdd(HOST,BASE,USER,PWD);
			$eventFutur = $event->requetesExec($requete1,NULL);
			$eventPast  = $event->requetesExec($requete2,NULL);
			//liste des evenements passé
			$lesSliders = new BanniereModel();
			$Sliders = $lesSliders->AllSlider();
			$tab = [
				'eventFutur' => $eventFutur,
				'eventPast' => $eventPast,
				'Sliders' => $Sliders
			];
			
			return $tab;

		}
	}
