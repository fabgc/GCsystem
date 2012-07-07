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
define('CLASS_GENERAL_INTERFACE', CLASS_PATH.'generalGc.class.php');

//class mere gerant l'application
define('CLASS_RUBRIQUE', CLASS_PATH.'Gcsystem.class.php');

//class gerant les log
define('CLASS_LOG', CLASS_PATH.'logGc.class.php');

//class gerant les log
define('CLASS_CACHE', CLASS_PATH.'cacheGc.class.php');

//class gerant les captchas
define('CLASS_CAPTCHA', CLASS_PATH.'captchaGc.class.php');

//class gerant des exceptions
define('CLASS_EXCEPTION', CLASS_PATH.'exceptionGc.class.php');

//class gerant les templates
define('CLASS_TEMPLATE', CLASS_PATH.'templateGc.class.php');

//class formsGC
define('CLASS_FORMSGC', LIB_PATH.'FormsGC/formsGC.php');

//class lang
define('CLASS_LANG', CLASS_PATH.'langGc.class.php');

//class file
define('CLASS_FILE', CLASS_PATH.'fileGc.class.php');

//class dir
define('CLASS_DIR', CLASS_PATH.'dirGc.class.php');

//class picture
define('CLASS_PICTURE', CLASS_PATH.'pictureGc.class.php');

//class sql
define('CLASS_SQL', CLASS_PATH.'sqlGc.class.php');

//class appDevGc
define('CLASS_appDevGc', CLASS_PATH.'appDevGc.class.php');

//class zip
define('CLASS_ZIP', CLASS_PATH.'zipGc.class.php');

//class mail
define('CLASS_MAIL', CLASS_PATH.'mailGc.class.php');

//class bbcode
define('CLASS_BBCODE', CLASS_PATH.'bbcodeGc.class.php');

//class modo
define('CLASS_MODO', CLASS_PATH.'modoGc.class.php');

//class modo
define('CLASS_TERMINAL', CLASS_PATH.'terminalGc.class.php');

//class upload
define('CLASS_UPDLOAD', CLASS_PATH.'uploadGc.class.php');

//class download
define('CLASS_DOWNLOAD', CLASS_PATH.'downloadGc.class.php');

//class date
define('CLASS_DATE', CLASS_PATH.'dateGc.class.php');

//class texte
define('CLASS_TEXT', CLASS_PATH.'textGc.class.php');

//class feed
define('CLASS_FEED', CLASS_PATH.'feedGc.class.php');

//class js
define('CLASS_JS', CLASS_PATH.'jsGc.class.php');

//class object
define('CLASS_OBJECT', CLASS_PATH.'objectGc.class.php');

//class social
define('CLASS_SOCIAL', CLASS_PATH.'socialGc.class.php');

//autoload des class
define('CLASS_AUTOLOAD', CLASS_PATH.'autoload.php');

//GESHI
define('GESHI', LIB_PATH.'geshi/geshi.php');

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

/* fichier jquery */
define('JQUERYFILE', JS_PATH.'jquery.min.js');
define('JQUERYUIJS', JS_PATH.'jquery-ui.min.js');
define('JQUERYUICSS', CSS_PATH.'jquery-ui.css');

/* --------------parametres de connexion a la base de donnees------------------*/

$db['bdd']['hostname'] = "localhost";
$db['bdd']['username'] = "root";
$db['bdd']['password'] = "";
$db['bdd']['database'] = "8_legeekcafe";
$db['bdd']['extension'] = "pdo";

/* -------------- CONSTANTE RELATIVE AU SITE ----------------- */

//base du site (utile pour eviter les repetition et faciliter  les changements de bdd
define('BDD', '8_legeekcafe');

//charset
define('CHARSET', 'iso-8859-15');

//favicon
define('FAVICON_PATH', 'no');

//erreur acces interdit
define('RUBRIQUE_FORBIDDEN', 'Vous n\'�te pas autoris�(e) � acc�der � cette page.');

//dossier o� est plac� le framework � partir de la racine du r�pertoire
define('FOLDER', 'GCsystem');

//dossier o� est plac� le framework � partir de la racine du r�pertoire
define('DEFAULTLANG', 'nl');

/** Definit l'environnement dans lequel est effectu� l'application :
* development : erreurs affich�es + barre de d�veloppement et pr�sence d'un terminal
* production : erreurs non affich�es **/
define('ENVIRONMENT', 'development');

/* affiche le message de maintenance */
define('MAINTENANCE', false);

/* mot de passe pour se connecter au terminal */
define('TERMINAL_MDP', 'mdp');

/* mettre � true pour pouvoir utiliser jquery et jquery ui */
define('JQUERY', true);