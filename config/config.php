<?php


/***
*
*
*		FICHIER DE CONFIGURATION
*
*
*
***/

define('PATH_FOLDER', $_SERVER['DOCUMENT_ROOT'].'/');
$chemin = 'EventActivity_v2/';
// chemin url du site
define('BASE_URL', PATH_FOLDER.$chemin);
define('SITE_ROOT', __DIR__);
// Nom de l'hote
define('BASE_NAME', $_SERVER['SERVER_NAME'].$chemin);

 // Déclaration des constantes
define('PREFIX_SALT', 'ml5*');
define('SUFFIX_SALT', '!d6D-');

//Nombre de page à afficher par page
define('NOMBRE_ARTICLE_PAGE', '12');
//Chemin stockage photo
define('PHOTO',PATH_FOLDER.'www/img/photo/');
define('PHOTO_SITE','www/img/photo/');
// Racine du site
define('RACINE', $chemin);
//nom de l'utilisateur
define('USER', 'root');
//mot de passe base de donne
define('PWD', 'toor');
//hote base de données
define('HOST', 'mysql');
//nom e la base de données
define('BASE', 'eventactivity');


session_start();
