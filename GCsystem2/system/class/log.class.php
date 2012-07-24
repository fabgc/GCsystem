<?php
class TestErrorHandling { 
    protected $error; 

    public function __construct () 
    { 
        $this->error = new TestErrorHandler; 
        set_error_handler( array($this->error, 'errorManager' ) ); 
    } 
} 

class TestErrorHandler{ 
    function errorManager($errno, $errstr, $errfile, $errline){
		switch($errno){
			case E_USER_NOTICE:
				// On ignore :
				break;

			case E_USER_WARNING:
				// on ignore aussi :
				break;

			case E_WARNING:
				// On ignore toujours :
				break;

			case E_USER_ERROR:
				// On envoie un mail aux dev :
				$dest = "contact@legeekcafe.com";
				$sujet = "Erreur sur l'appli legeekcafe.com";
				$d = date("d/m/Y � H:i !",time());
				$msg = sprintf("%s : Erreur n�%d (%s) dans le fichier %s � la ligne %d\n", $d, $errno, $errstr, $errfile, $errline);
	  
				error_log($msg, 1, $dest, "subject: ".$sujet);
				break;

			default:
				// Par d�faut, on log l'erreur dans un fichier :
				$d = date("d/m/Y � H:i !",time());
				$msg = sprintf("%s : Erreur n�%d (%s) dans le fichier %s � la ligne %d\n", $d, $errno, $errstr, $errfile, $errline);
				
				error_log($msg, 3, LOG_PATH."errors.log");
				break;
		}

		// Ne pas executer le gestionnaire natif de PHP :
	   return TRUE;
	}
} 
?>