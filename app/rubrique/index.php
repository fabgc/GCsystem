<?php
	$GLOBALS['rubrique']->setInfo(array('title'=>'� bijour'));
	echo $GLOBALS['rubrique']->affHeader();
		$t= new templateGC('GCsystem', 'GCsystem', '0');
		$t->setShow(FALSE);
		echo $t->show();
	echo $GLOBALS['rubrique']->affFooter();