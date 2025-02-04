<?php


    function tabIsEmpty($tableau){
         $isEmpty  = ( 
            empty(
                array_filter($tableau, 
                    function($value, $key)
                    {
                        return $value != "";
                    },ARRAY_FILTER_USE_BOTH
                )
            ) 
        ) ? true : false;

         return $isEmpty;
    }



    function valid_donnees($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }

    function checkEmptyField($info){
         $tableauMsg = null;
        if (empty($info['nomUser']) || empty($info['prenomUser']) || empty($info['dttnUser']) || empty($info['adresseUser']) || empty($info['cpUser']) || empty($info['villeUser']) || empty($info['mailUser']) || empty($info['paysUser']))
        {
            $emptycheck = 'un ou plusieurs champs ne sont pas renseignés.';
            $tableauMsg = [ 'message' => $emptycheck];
        }

        return  $tableauMsg;
    }


    function checkPassword($info){
        if ($info['mdpUser'] != $info['confirMdpUser']) {
            $passwordcheck = 'Les mots de passes ne correspondent pas.';
            $tableauMsg = [ 'message' => $passwordcheck];
        }else{
            $pass = password_hash($info['mdpUser'], PASSWORD_DEFAULT);
            $tableauMsg = [ 
                'passwordAdmin' => $pass,
                1 => null 
            ];
        }

        return $tableauMsg;
    }


    function checkMail($info){
        $tableauMsg = null;
        if (!filter_var($info['mailUser'], FILTER_VALIDATE_EMAIL)) {
           
            $mailcheck = ['L\'adresse mail fourni n\'est pas valide'];
            $tableauMsg =  [ 'message' => $mailcheck];
        }

        return $tableauMsg;
    }




    function traitementUser($donnees){

        $tab['Civilite']       = valid_donnees($donnees['Civilite']);
        $tab['nomUser']        = valid_donnees($donnees['nomUser']);
        $tab['prenomUser']     = valid_donnees($donnees['prenomUser']);
        $tab['dttnUser']      = valid_donnees($donnees['dttnUser']);
        $tab['adresseUser']    = valid_donnees($donnees['adresseUser']);
        $tab['adresseBisUser'] = valid_donnees($donnees['adresseBisUser']);
        $tab['cpUser']       = valid_donnees($donnees['cpUser']);
        $tab['villeUser']      = valid_donnees($donnees['villeUser']);
        $tab['paysUser']      = valid_donnees($donnees['paysUser']);
        $tab['mailUser']       = valid_donnees($donnees['mailUser']);
        $tab['mdpUser']        = valid_donnees($donnees['mdpUser']);
        $tab['confirMdpUser']  = valid_donnees($donnees['confirMdpUser']);


        return $tab;
    }

    function  traitementPhoto($donnees)
    {
        if (!empty($donnees['image'])) 
        {

            if ($donnees['image']["error"]==0)
            {
                $tab =pathinfo($donnees["image"]["name"]);
               
                $extentions=strtolower($tab["extension"]);
                $extentionsAutorises=array('png','jpeg','jpg');
                $maxSize=2097152;
                if ($donnees['image']['size']>$maxSize) {
                    $tab["erreur"] = "L'image est trop grosse";
                }
                else if (!in_array($extentions,$extentionsAutorises)) {
                     $tab["erreur"] = "extension non autorisé";
                }
                else{
                    $chemin= BASE_URL.'www/img/photo';
                    $tab["photo"]=$donnees['image']['name'];
                    $chemins= $chemin . "/" . $donnees['image']['name'];

                    if(move_uploaded_file($donnees['image']['tmp_name'],$chemins)){
                         $tab["info"] = "Le transfert c'est bien passé";
                    }else{
                         $tab["erreur"] = "Il y a eu une erreur dans le chargement.";
                    }
                }        
               
            }else{
                 $tab["erreur"] = "ça ne marche pas";
            }
        } else {
            $tab["photo"]="";
        }
        return $tab; 
    }


    /**
    * Affiche la pagination à l'endroit où cette fonction est appelée
    * @param string $url L'URL ou nom de la page appelant la fonction, ex: 'index.php' ou 'http://example.com/'
    * @param string $link La nom du paramètre pour la page affichée dans l'URL, ex: '?page=' ou '?&p='
    * @param int $total Le nombre total de pages
    * @param int $current Le numéro de la page courante
    * @param int $adj (facultatif) Le nombre de pages affichées de chaque côté de la page courante (défaut : 3)
    * @return La chaîne de caractères permettant d'afficher la pagination
    */
    function paginate($url, $link, $total, $current, $adj=2) {
        // Initialisation des variables
        $prev = $current - 1; // numéro de la page précédente
        $next = $current + 1; // numéro de la page suivante
        $penultimate = $total - 1; // numéro de l'avant-dernière page
        $pagination = ''; // variable retour de la fonction : vide tant qu'il n'y a pas au moins 2 pages
    
        if ($total > 1) {
            // Remplissage de la chaîne de caractères à retourner
            $pagination .= "<div class=\"pagination\">\n";
    
            /* =================================
             *  Affichage du bouton [précédent]
             * ================================= */
            if ($current == 2) {
                // la page courante est la 2, le bouton renvoie donc sur la page 1, remarquez qu'il est inutile de mettre $url{$link}1
                $pagination .= "<a href=\"{$url}\" class=\"gauche commun\"></a>";
            } elseif ($current > 2) {
                // la page courante est supérieure à 2, le bouton renvoie sur la page dont le numéro est immédiatement inférieur
                $pagination .= "<a href=\"{$url}{$link}{$prev}\" class=\"gauche commun\"></a>";
            } else {
                // dans tous les autres, cas la page est 1 : désactivation du bouton [précédent]
                $pagination .= '<span class="inactive gauche commun"></span>';
            }
    
            /**
             * Début affichage des pages, l'exemple reprend le cas de 3 numéros de pages adjacents (par défaut) de chaque côté du numéro courant
             * - CAS 1 : il y a au plus 12 pages, insuffisant pour faire une troncature
             * - CAS 2 : il y a au moins 13 pages, on effectue la troncature pour afficher 11 numéros de pages au total
             */
    
            /* ===============================================
             *  CAS 1 : au plus 12 pages -> pas de troncature
             * =============================================== */
            if ($total < 7 + ($adj * 2)) {
                // Ajout de la page 1 : on la traite en dehors de la boucle pour n'avoir que index.php au lieu de index.php?p=1 et ainsi éviter le duplicate content
                $pagination .= ($current == 1) ? '<span class="active">1</span>' : "<a href=\"{$url}\">1</a>"; // Opérateur ternaire : (condition) ? 'valeur si vrai' : 'valeur si fausse'
    
                // Pour les pages restantes on utilise itère
                for ($i=2; $i<=$total; $i++) {
                    if ($i == $current) {
                        // Le numéro de la page courante est mis en évidence (cf. CSS)
                        $pagination .= "<span class=\"active\">{$i}</span>";
                    } else {
                        // Les autres sont affichées normalement
                        $pagination .= "<a href=\"{$url}{$link}{$i}\">{$i}</a>";
                    }
                }
            }
            /* =========================================
             *  CAS 2 : au moins 13 pages -> troncature
             * ========================================= */
            else {
                /**
                 * Troncature 1 : on se situe dans la partie proche des premières pages, on tronque donc la fin de la pagination.
                 * l'affichage sera de neuf numéros de pages à gauche ... deux à droite
                 * 1 2 3 4 5 6 7 8 9 … 16 17
                 */
                if ($current < 2 + ($adj * 2)) {
                    // Affichage du numéro de page 1
                    $pagination .= ($current == 1) ? "<span class=\"active\">1</span>" : "<a href=\"{$url}\">1</a>";
    
                    // puis des huit autres suivants
                    for ($i = 2; $i < 4 + ($adj * 2); $i++) {
                        if ($i == $current) {
                            $pagination .= "<span class=\"active\">{$i}</span>";
                        } else {
                            $pagination .= "<a href=\"{$url}{$link}{$i}\">{$i}</a>";
                        }
                    }
    
                    // ... pour marquer la troncature
                    $pagination .= '&hellip;';
    
                    // et enfin les deux derniers numéros
                    $pagination .= "<a href=\"{$url}{$link}{$penultimate}\">{$penultimate}</a>";
                    $pagination .= "<a href=\"{$url}{$link}{$total}\">{$total}</a>";
                }
                /**
                 * Troncature 2 : on se situe dans la partie centrale de notre pagination, on tronque donc le début et la fin de la pagination.
                 * l'affichage sera deux numéros de pages à gauche ... sept au centre ... deux à droite
                 * 1 2 … 5 6 7 8 9 10 11 … 16 17
                 */
                elseif ( (($adj * 2) + 1 < $current) && ($current < $total - ($adj * 2)) ) {
                    // Affichage des numéros 1 et 2
                    $pagination .= "<a href=\"{$url}\">1</a>";
                    $pagination .= "<a href=\"{$url}{$link}2\">2</a>";
                    $pagination .= '&hellip;';
    
                    // les pages du milieu : les trois précédant la page courante, la page courante, puis les trois lui succédant
                    for ($i = $current - $adj; $i <= $current + $adj; $i++) {
                        if ($i == $current) {
                            $pagination .= "<span class=\"active\">{$i}</span>";
                        } else {
                            $pagination .= "<a href=\"{$url}{$link}{$i}\">{$i}</a>";
                        }
                    }
    
                    $pagination .= '&hellip;';
    
                    // et les deux derniers numéros
                    $pagination .= "<a href=\"{$url}{$link}{$penultimate}\">{$penultimate}</a>";
                    $pagination .= "<a href=\"{$url}{$link}{$total}\">{$total}</a>";
                }
                /**
                 * Troncature 3 : on se situe dans la partie de droite, on tronque donc le début de la pagination.
                 * l'affichage sera deux numéros de pages à gauche ... neuf à droite
                 * 1 2 … 9 10 11 12 13 14 15 16 17
                 */
                else {
                    // Affichage des numéros 1 et 2
                    $pagination .= "<a href=\"{$url}\">1</a>";
                    $pagination .= "<a href=\"{$url}{$link}2\">2</a>";
                    $pagination .= '&hellip;';
    
                    // puis des neuf derniers numéros
                    for ($i = $total - (2 + ($adj * 2)); $i <= $total; $i++) {
                        if ($i == $current) {
                            $pagination .= "<span class=\"active\">{$i}</span>";
                        } else {
                            $pagination .= "<a href=\"{$url}{$link}{$i}\">{$i}</a>";
                        }
                    }
                }
            }
    
            /* ===============================
             *  Affichage du bouton [suivant]
             * =============================== */
            if ($current == $total)
                $pagination .= "<span class=\"inactive droite commun\"></span>\n";
            else
                $pagination .= "<a href=\"{$url}{$link}{$next}\" class=\"droite commun\"></a>\n";
    
            // Fermeture de la <div> d'affichage
            $pagination .= "</div>\n";
        }
    
        return ($pagination);
    }