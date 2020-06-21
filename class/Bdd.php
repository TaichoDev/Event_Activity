<?php


  class Bdd
  {
    private
      $base     = '',
      $Bdd         = '',
      $identifiant = '',
      $mdp         = '';
    /**
    * Constructeur de la classe
    * Connexion aux serveur de base de donnée et sélection de la base
    *
    * $Serveur     = L'hôte (ordinateur sur lequel Mysql est installé)
    * $Bdd         = Le nom de la base de données
    * $Identifiant = Le nom d'utilisateur
    * $Mdp         = Le mot de passe
    */
    public function __construct($host = 'localhost', $base = 'base', $identifiant = 'root', $mdp = '')
    {
  		$this->host    		  = $host;
  		$this->base         = $base;
  		$this->identifiant 	= $identifiant;
  		$this->mdp         	= $mdp;
    }
    /**
    * Retourne le nombre de requêtes SQL effectué par l'objet
    */
    public function RetourneNbRequetes()
    {
		return $this->NbRequetes;
    }

    public	function getBDD()
	{

		//var_dump("mysql:host=".HOST.";dbname=".BASE.",". USER.",". PWD);
		$pdo = new PDO("mysql:host=".$this->host.";dbname=".$this->base, $this->identifiant, $this->mdp);

		// Paramétrage de la liaison PHP <-> MySQL, les données sont encodées en UTF-8.
		$pdo->exec('SET NAMES UTF8');

		return $pdo;
	}
    /**
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
     * laRequete contient la requete sql a exécuté
     * data est un tableau contenant toutes données
     * return un entier qui est le dernier id insérer dans la base de données
     * @param  string laRequete
     * @param  array data 
     * @return int 
     */
    public function insertionExec($laRequete,$data = [])
    {
        
        $requete = $this->getBDD();
        $stmt = $requete->prepare($laRequete) ;
        $stmt->execute($data);
        //$stmt->debugDumpParams();
        return $requete->lastInsertId();
    }

    /**
     * laRequete contient la requete sql a exécuté
     * data est un tableau contenant toutes données
     * return le nombre de tuples affecté par la modification
     * @param  string laRequete
     * @param  array data 
     * @return int 
     */
    public function updateDeleteExec($laRequete,$data = [])
    {
        $requete = $this->getBDD();
        $stmt = $requete->prepare($laRequete) ;
       
        
        $stmt->execute($data);
        //$stmt->debugDumpParams();

        return $stmt->rowCount();
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
  		$requete = $this->getBDD()->prepare($laRequete) ;
  		$requete->execute($data);
      //$requete->debugDumpParams();
  		$tabData = $requete->fetchAll(PDO::FETCH_BOTH);
  		return $tabData;
    }
  }
