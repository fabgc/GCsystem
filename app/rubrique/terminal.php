<?php
	$GLOBALS['rubrique']->setInfo(array('title'=>'� bijour', 'css'=>''));
	echo $GLOBALS['rubrique']->affHeader();
		switch($_GET['action']){
			case 'terminal':
				$terminal = new terminalGC(htmlentities($_POST['message']));
				echo $terminal ->parse();
			break;
			
			default:
				$t= new templateGC('GCterminal', 'GCterminal', '0');
				if(ENVIRONMENT == 'development') $t->assign(array('moins' => 60, 'moins2'=>90));
					else $t->assign(array('moins' => 0, 'moins2' => 30));
				$t->show();
			break;
		}
	echo $GLOBALS['rubrique']->affFooter();
?>