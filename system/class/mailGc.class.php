<?php
	/**
	 * @file : mailGc.class.php
	 * @author : fab@c++
	 * @description : class g�n�rant des mails
	 * @version : 2.0 b�ta
	*/
	
	class mailGc{
		use errorGc;                           			    //trait fonctions g�n�riques
		
		protected $_destinataire                          ; //email du destinataire
		protected $_message                               ; //message
		protected $_piece                       = array() ; //liste des pi�ces jointes
		
		/**
		 * Cr&eacute;e l'instance de la classe
		 * @access	public
		 * @return	void
		 * @since 2.0
		*/
		
		public  function __construct(){
		}
		
		/**
		 * Desctructeur
		 * @access	public
		 * @return	boolean
		 * @since 2.0
		*/
		
		public  function __desctuct(){
		
		}
	}
?>