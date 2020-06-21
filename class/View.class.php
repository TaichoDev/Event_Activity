<?php
class View
{
    private $nameTemplate;
    private $donnees;
    private $layout;
    private $titre;
    
    /**
     * __construct
     *
     * @param  array $donnees
     * @param  string $titre
     *
     */
    public function __construct (array $donnees = null, string $nameTemplate = null, string $titre = null)
    {
       
        $this->donnees = $donnees;
        $this->titre = $titre;
        $this->nameTemplate = $nameTemplate;
    }

    public function templateBackSimple()
    {   

        if (isset($this->donnees)) {
            extract($this->donnees);
        }
        $title = (empty($this->titre)) ? '' : ' - '.$this->titre;
        $title = 'Event Activity '. $title;
        $template = $this->nameTemplate;

        return  'www/templates/management/'.$this->nameTemplate.'.phtml';
    }
        
    public function templateSimple()
    {   
        if (isset($this->donnees)) {
            extract($this->donnees);
        }

        $title = (empty($this->titre)) ? '' : ' - '.$this->titre;
        $title = 'Event Activity '. $title;
        $template = $this->nameTemplate;

        return 'www/templates/'.$this->nameTemplate.'.phtml';
    }

    public function getViewBack(){

        
        if (isset($this->donnees)) {
            extract($this->donnees);
        }

        $title = (empty($this->titre)) ? '' : ' - '.$this->titre;
        $title = 'Event Activity '. $title;
        $template = $this->nameTemplate;

        include 'www/templates/management/layoutGestion.phtml';
    }


    public function getView()
    {      
        if (isset($this->donnees)) {
            extract($this->donnees);
        }
               
        $title = (empty($this->titre)) ? '' : ' - '.$this->titre;
        $title = 'Event Activity '. $title;
        $template = $this->nameTemplate;
        include 'www/templates/layout.phtml';

    }
}