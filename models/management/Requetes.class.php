<?php


  class Requetes
  {   /**
    * Requete d'insertion, mise à jour et suppression
    *
    * $Requete = Requête SQL
    */
    public function requete($laRequete,$data = [])
    {
		$code = false;
		$requete = $this->getBDD()->prepare($laRequete) ;
		$requete->execute($data);
		//si le nombre de lignes affectées sont supérieur a 0 alors on rentre dans la condition
		if ( $requete->rowCount() < 0 ) {

			$code = true;
		}

		return $code;
    }
    /**
    * Retourne le dernier identifiant généré par un champ de type AUTO_INCREMENT
    *
    */
        /**
    * Insertion
    *
    * $Requete = Requête SQL
    */
    public function insertionExec($laRequete,$data = [])
    {

        $requete = $this->getBDD();
        $stmt = $requete->prepare($laRequete) ;
        $stmt->execute($data);
        //$arr = $stmt->errorInfo();

        $retunNum = $requete->lastInsertId();

        return $retunNum;
    }

    /**
    * SELECT retourn 1 element
    *
    * $Requete = Requête SQL
    */
    public function requeteExec($laRequete,$data = [])
    {
		$requete = $this->getBDD()->prepare($laRequete) ;
		$requete->execute($data);
		$tabData = $requete->fetch();
		return $tabData;
    }

    /**
    * SELECT retourn plusieurs éléments
    *
    * $Requete = Requête SQL
    */
    public function requetesExec($laRequete,$data = [])
    {
		$code = false;
		$requete = $this->getBDD()-> prepare($laRequete) ;
		$requete->execute($data);
		$tabData = $requete->fetchAll(PDO::FETCH_BOTH);
		return $tabData;
    }
}