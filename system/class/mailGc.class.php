<?php
	/*\
	 | ------------------------------------------------------
	 | @file : mailGc.class.php
	 | @author : fab@c++
	 | @description : class g�n�rant des mails
	 | @version : 2.0 b�ta
	 | ------------------------------------------------------
	\*/
	
	class mailGc{
		use errorGc;                           			    //trait fonctions g�n�riques
		
		protected $_destinataire                          ; //email du destinataire
		protected $_message                               ; //message
		protected $_piece                       = array() ; //liste des pi�ces jointes
		
		public  function __construct(){
		}
		
		public  function __desctuct(){
		
		}
	}
?>