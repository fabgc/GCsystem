<?php
	/*\
	 | ------------------------------------------------------
	 | @file : modoGc.class.php
	 | @author : fab@c++
	 | @description : class g�rant le filtrage du contenu du site
	 | @version : 2.0 b�ta
	 | ------------------------------------------------------
	\*/
	
	class modoGc{
		use errorGc;                            //trait fonctions g�n�riques
		
		protected $_contenu                       ; //contenu � filtrer
		protected $_maxWord                  = 10  ; //contenu � filtrer
		protected $_insulte                  = array(
			'salaud', 'merde', 'salope', 'pute', 'putain', 'fils de pute', 'encul�', 'connasse'); //array contenant toutes les erreurs enregistr�es
		protected $_parseInsulte             = array();
		protected $_i                        = array();
		
		public  function __construct($contenu, $maxword=0){
			$this->_contenu = strval($contenu);
			$this->_maxWord = intval($maxword);
		}
		
		public function parse(){
			$this->_i = 0;
		}
		
		public function censure(){
			$this->_i = 0;
		}
		
		public function getContenu(){
			return $this->_contenu;
		}
		
		public function getMaxWord(){
			return $this->_maxWord;
		}
		
		public function getInsulte(){
			return $this->_parseInsulte;
		}
		
		public function getInsulteHtml(){
			foreach($this->_parseInsulte as $valeur){
				$val .=$valeur.'<br />';
			}
			return $val;
		}
		
		public function setContenu($contenu){
			$this->_contenu = strval($contenu);
			$this->_i            = 0      ;
			$this->_parseInsulte = array();
		}
		
		public function setMaxWord($max){
			$this->_maxWord = intval($maxu);
		}
		
		public  function __desctuct(){
		
		}
	}
?>