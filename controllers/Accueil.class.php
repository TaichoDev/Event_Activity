<?php

	/**
	 *
	 */
	class Accueil 
	{
		/**
		 * [displayHome Permet d'afficher la page d'accueil du site]
		 */
		public function displayHome()
		{	
			$accueil = new AccueilModel();
			$donnees = $accueil->requeteAccueil();		
			$vue = new View($donnees,"accueil","Accueil");			
			$vue->getView();

		}
	}
