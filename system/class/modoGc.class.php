<?php
	/**
	 * @file : modoGc.class.php
	 * @author : fab@c++
	 * @description : class g�rant le filtrage du contenu du site
	 * @version : 2.0 b�ta
	*/
	
	class modoGc{
		use errorGc;                            //trait fonctions g�n�riques
		
		protected $_contenu                       ; //contenu � filtrer
		protected $_maxWord                  = 10  ; //contenu � filtrer
		protected $_insulte                  = array(
			'salaud', 'merde', 'salope', 'pute', 'putain', 'fils de pute', 'encul�', 'connasse'); //array contenant toutes les erreurs enregistr�es
		protected $_parseInsulte             = array();
		protected $_i                        = array();
		
		/**
		 * Cr&eacute;e l'instance de la classe
		 * @access	public
		 * @return	void
		 * @param string $contenu : contenu � mod�rer
		 * @param string $maxword : nombre maximum de mot tol�r�, une valeur de 0 entra�ne un nombre illimit� d'insultes tol�r�
		 * @since 2.0
		*/
		
		public  function __construct($contenu, $maxword=0){
			$this->_contenu = strval($contenu);
			$this->_maxWord = intval($maxword);
		}
		
		/**
		 * Fonction de parsage du message
		 * @access	public
		 * @return	array ou boolean
		 * @since 2.0
		*/
		
		public function parse(){
			$this->_i = 0;
		}
		
		/**
		 * Fonction de censure du message
		 * @access	public
		 * @return	boolean
		 * @since 2.0
		*/
		
		public function censure(){
			$this->_i = 0;
		}
		
		/**
		 * R�cup�ration du contenu du message
		 * @access	public
		 * @return	void
		 * @since 2.0
		*/
		
		public function getContenu(){
			return $this->_contenu;
		}
		
		/**
		 * R�cup�ration du nombre de mot vulgaire maximum
		 * @access	public
		 * @return	void
		 * @since 2.0
		*/
		
		public function getMaxWord(){
			return $this->_maxWord;
		}
		
		/**
		 * R�cup�ration du tableau contenant les insultes d�tect�es
		 * @access	public
		 * @return	void
		 * @since 2.0
		*/
		
		public function getInsulte(){
			return $this->_parseInsulte;
		}
		
		/**
		 * R�cup�ration du tableau contenant les insultes d�tect�es en format html
		 * @access	public
		 * @return	void
		 * @since 2.0
		*/
		
		public function getInsulteHtml(){
			foreach($this->_parseInsulte as $valeur){
				$val .=$valeur.'<br />';
			}
			return $val;
		}
		
		/**
		 * Configuration du contenu � mod�rer
		 * @access	public
		 * @return	void
		 * @param string $contenu : contenu � mod�rer
		 * @since 2.0
		*/
		
		public function setContenu($contenu){
			$this->_contenu = strval($contenu);
			$this->_i            = 0      ;
			$this->_parseInsulte = array();
		}
		
		/**
		 * Configuration du nombre de mot vulgaire tol�r�, une valeur de 0 entra�ne un nombre illimit� d'insultes tol�r�
		 * @access	public
		 * @return	void
		 * @param string $max : nombre d'insultes tol�r�
		 * @since 2.0
		*/
		
		public function setMaxWord($max){
			$this->_maxWord = intval($maxu);
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