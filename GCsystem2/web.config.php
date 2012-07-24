<?php
/*\

 | ------------------------------------------------------

 | @file : web.config.php
 | @author : fab@c++
 | @description : Configuration g�n�rale de l'application web et des connexions SQL
 | @version : 1.0 B�ta
 
 | ------------------------------------------------------
 
\*/

//asset
define('ASSET_PATH', 'asset/');

//app
define('APP_PATH', 'app/');

//system
define('SYSTEM_PATH', 'system/');

//chemin d'acc�s fichiers css
define('CSS_PATH', ASSET_PATH.'css/');

//chemin d'acc�s fichiers javascript
define('JS_PATH', ASSET_PATH.'js/');

//chemin d'acc�s fichiers javascript
define('IMG_PATH', ASSET_PATH.'image/');

//chemin d'acc�s fichiers d'upload
define('UPLOAD_PATH', ASSET_PATH.'upload/');

//chemin d'acc�s fichiers de log
define('LOG_PATH', APP_PATH.'log/');

//chemin d'acc�s fichiers de log
define('CACHE_PATH', APP_PATH.'cache/');

//chemin d'acc�s fichiers divers
define('FILE_PATH', ASSET_PATH.'file/');

//chemin d'acc�s rubriques (controleur)
define('RUBRIQUE_PATH', APP_PATH.'rubrique/');

//chemin d'acc�s des includes (vue+modele)
define('INCLUDE_PATH', APP_PATH.'include/');

//chemin d'acc�s des includes (vue+modele)
define('SQL_PATH', APP_PATH.'sql/');

//chemin d'acc�s des formulaires
define('FORMS_PATH', APP_PATH.'forms/');

//chemin d'acc�s des templates
define('TEMPLATE_PATH', APP_PATH.'template/');

//chemin d'acc�s fichiers class
define('CLASS_PATH', SYSTEM_PATH.'class/');

//chemin d'acc�s librairies
define('LIB_PATH', SYSTEM_PATH.'lib/');

//chemin d'acc�s fichiers de langues
define('LANG_PATH', SYSTEM_PATH.'lang/');

//extension fichiers de langues
define('LANG_EXT', '.xml');

// D�finit l'extension des fichiers
define('FILES_EXT', '.html');

//fonction generique
define('FUNCTION_GENERIQUE', INCLUDE_PATH.'function.php');

//class mere gerant l'application
define('CLASS_GENERAL_INTERFACE', CLASS_PATH.'general.class.php');

//class mere gerant l'application
define('CLASS_RUBRIQUE', CLASS_PATH.'rubrique.class.php');

//class gerant les log
define('CLASS_LOG', CLASS_PATH.'log.class.php');

//class gerant les log
define('CLASS_CACHE', CLASS_PATH.'cache.class.php');

//class gerant les captchas
define('CLASS_CAPTCHA', CLASS_PATH.'captcha.class.php');

//class gerant des exceptions
define('CLASS_EXCEPTION', CLASS_PATH.'exceptionGc.class.php');

//class gerant les templates
define('CLASS_TEMPLATE', CLASS_PATH.'templateGc.class.php');

//class formsGC
define('CLASS_FORMSGC', LIB_PATH.'FormsGC/formsGC.php');

//class lang
define('CLASS_LANG', CLASS_PATH.'lang.class.php');

//class file
define('CLASS_FILE', CLASS_PATH.'file.class.php');

//class file
define('CLASS_DIR', CLASS_PATH.'dir.class.php');

//class picture
define('CLASS_PICTURE', CLASS_PATH.'picture.class.php');

//extension des fichiers de fonctions
define('FUNCTION_EXT', '.function');

//extension des fichiers de fonctions
define('SQL_EXT', '.sql');

//extension des fichiers de fonctions
define('FORMS_EXT', '.forms');

//extension des fichiers de template
define('TEMPLATE_EXT', '.tpl');

//erreur script rubrique not found
define('RUBRIQUE_NOT_FOUND', 'Une erreur relative au script s\'est produite.');

//erreur variabels manquantes
define('RUBRIQUE_MISSING_PARAMETERS', 'Il manque des param�tre pour r�pondre � votre demande.');

//erreur variabels manquantes
define('ACTION_NOT_FOUND', 'La rubrique n\'existe pas.');

//charset
define('CHARSET', 'iso-8859-15');

//favicon
define('FAVICON_PATH', 'no');

//erreur acces interdit
define('RUBRIQUE_FORBIDDEN', 'Vous n\'�te pas autoris�(e) � acc�der � cette page.');

/** Definit l'environnement dans lequel est effectu� l'application :
* development : erreurs affich�es
* production : erreurs non affich�es **/
define('ENVIRONMENT', 'development');

/* --------------parametres de connexion a la base de donnees------------------*/

$db['bdd']['hostname'] = "localhost";
$db['bdd']['username'] = "root";
$db['bdd']['password'] = "";
$db['bdd']['database'] = "db_legeekcafe";
$db['bdd']['extension'] = "pdo";

/* -------------- CONSTANTE RELATIVE AU SITE ----------------- */

//base du site (utile pour eviter les repetition et faciliter  les changements de bdd
define('BDD', 'db_legeekcafe');