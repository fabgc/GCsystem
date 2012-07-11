<?php
session_start();

/*\
 | ------------------------------------------------------
 | @file : index.php
 | @author : fab@c++
 | @description : Controlleur central de l'application
 | @version : 2.0 b�ta
 | ------------------------------------------------------
\*/

require_once('web.config.php');
require_once(CLASS_AUTOLOAD);

/* ---------- creation de la page -------------- */
$GLOBALS['appDevGc'] = new appDevGc('nl');
$GLOBALS['rubrique'] = new Gcsystem('nl');

/* ---------- d�marrage de l'application ----------------- */
$GLOBALS['rubrique']->init();

/* ------ articulation du site web -------- */

/* ------ appelez ici vos classes personnelles -------- */

if(MAINTENANCE==false){ $GLOBALS['rubrique']->route(); }
elseif(MAINTENANCE==true){ $GLOBALS['rubrique']->setMaintenance(); }
if(ENVIRONMENT == 'development') $GLOBALS['appDevGc']->show();