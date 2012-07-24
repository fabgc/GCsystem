<?php
session_start();

/*\

 | ------------------------------------------------------

 | @file : index.php
 | @author : fab@c++
 | @description : Controlleur central de l'application
 | @version : 0.1 Alpha
 
 | ------------------------------------------------------
 
\*/
require_once('web.config.php');
require_once(CLASS_LANG);
require_once(CLASS_GENERAL_INTERFACE);
require_once(CLASS_RUBRIQUE);
require_once(CLASS_LOG);
require_once(CLASS_EXCEPTION);
require_once(CLASS_CAPTCHA);
require_once(FUNCTION_GENERIQUE);
require_once(CLASS_FORMSGC);
require_once(CLASS_CACHE);
require_once(CLASS_TEMPLATE);
require_once(CLASS_FILE);
require_once(CLASS_DIR);
require_once(CLASS_PICTURE);

/* ---------- creation de la page -------------- */

$GLOBALS['rubrique'] = new rubrique(); //constructeur

/* ---------- gestion des erreurs (log) ----------- */

$c = new TestErrorHandling(); 

/* ---------- connexion SQL ----------------- */

$GLOBALS['base']=$rubrique->connectDatabase($db);

/* --------------- Gzip --------- */

$GLOBALS['rubrique']->GzipinitOutputFilter();

switch(ENVIRONMENT){	
	case 'development' :		
		error_reporting(E_ALL | E_NOTICE);			
	break;
					
	case 'production' :	
		error_reporting(0);					
	break;					
}

$GLOBALS['css']= array('default.css');
$GLOBALS['js'] = array('jquery-1.5.min.js', 'script.js');

/* ---------- protection des variables GET (faille XSS) -------------- */

if(isset($_GET['rubrique'])) { $_GET['rubrique']=htmlentities($_GET['rubrique']); }
if(isset($_GET['action'])) { $_GET['action']=htmlentities($_GET['action']); }
if(isset($_GET['sousaction'])) { $_GET['sousaction']=htmlentities($_GET['sousaction']); }
if(isset($_GET['id'])) { $_GET['id']=intval(htmlentities($_GET['id'])); }
if(isset($_GET['page'])) { $_GET['page']=intval(htmlentities($_GET['page'])); }
if(isset($_GET['search'])) { $_GET['search']=htmlentities($_GET['search']); }
if(isset($_GET['design'])) { $_GET['design']=intval(htmlentities($_GET['design'])); }
if(isset($_GET['menu'])) { $_GET['menu']=intval(htmlentities($_GET['menu'])); }
if(isset($_GET['cat'])) { $_GET['cat']=intval(htmlentities($_GET['cat'])); }
if(isset($_GET['soucat'])) { $_GET['soucat']=intval(htmlentities($_GET['soucat'])); }

/* ------ enregistrement de la rubrique et de l'url -------- */
$GLOBALS['rubrique']->setErrorLog('errors.log','Page rewrite : http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].' rubrique : '.$_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"].'?'.$_SERVER["QUERY_STRING"].' / origine : '.$_SERVER['HTTP_REFERER'].' / IP : '.$_SERVER['REMOTE_ADDR']);

/* ------ articulation du site web -------- */
  
if(isset($_GET['rubrique'])){
	switch($_GET['rubrique']){
		default:
			$GLOBALS['rubrique']->windowInfo('Erreur', RUBRIQUE_NOT_FOUND, 0, 'index'.FILES_EXT); 
			$GLOBALS['rubrique']->setErrorLog('errors.log', 'La rubrique '.$_GET['rubrique'].' n\'a pas �t� trouv�e');
		break;
	}
}
else{
	if(is_file(RUBRIQUE_PATH.'index.php')) { 
		require_once(RUBRIQUE_PATH.'index.php') ;
	} 
	else { 
		$GLOBALS['rubrique']->windowInfo('Erreur', RUBRIQUE_NOT_FOUND, 0, 'index'.FILES_EXT); 
		$GLOBALS['rubrique']->setErrorLog('errors.log', 'La rubrique '.$_GET['rubrique'].' n\'a pas �t� trouv�e');
	}
}
?>