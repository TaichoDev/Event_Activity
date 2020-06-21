<?php
    class GestionAdmin
    {
        public function selectGestion($laRequete,$donnee = []){

            $bdd = new Bdd(HOST,BASE,USER,PWD);
            $bdd->getBDD();
            $resultats = $bdd->requeteExec($laRequete,$donnee);
            return $resultats;
        }
    }
