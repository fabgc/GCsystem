<?php
	/**
	 * @file : modoGc.class.php
	 * @author : fab@c++
	 * @description : class g�rant le filtrage du contenu du site
	 * @version : 2.0 b�ta
	*/
	
	class modoGc{
		use errorGc;                            //trait
		
		protected $_contenu                           ; //contenu � filtrer
		protected $_maxWord                  = 10     ; //contenu � filtrer
		protected $_insulte 				 = array(); //avec la participation de t1307
		protected $_parseInsulte             = array();
		protected $_i                        = array();
		
		protected $_domXml                            ; //pour la modification du fichier route
		protected $_nodeXml                           ;
		protected $_markupXml                         ;
		
		/**
		 * Cr&eacute;e l'instance de la classe
		 * @access	public
		 * @return	void
		 * @param string $contenu : contenu � mod�rer
		 * @param string $maxword : nombre maximum de mot tol�r�, une valeur de 0 entra�ne un nombre illimit� d'insultes tol�r�
		 * @since 2.0
		*/
		
		public  function __construct($contenu, $maxword=0){
			$this->_contenu = $this->_setAccent(strval($contenu));
			$this->_maxWord = intval($maxword);
			$this->_insulte = $this->_setInsulte();
			
			echo $this->_contenu;
		}
		
		/**
		 * Fonction de parsage du message. Retourne soit true soit un array contenant la liste des insultes
		 * @access	public
		 * @return	array ou boolean
		 * @since 2.0
		*/
		
		public function parse(){
			$this->_parseInsulte = array();
			foreach($this->_insulte as $insulte){
				if(preg_match('`'.preg_quote($insulte).' `i', $this->_contenu)){
					array_push($this->_parseInsulte, $insulte);
				}
			}
			
			if(count($this->_parseInsulte) != 0){
				return $this->_parseInsulte;
			}
			else{
				return true;
			}
		}
		
		/**
		 * Fonction de censure du message, renvoie le texte censure ou non
		 * @access	public
		 * @return	string
		 * @since 2.0
		*/
		
		public function censure(){
			$this->_i            = 0;
			$this->_parseInsulte = array();
			foreach($this->_insulte as $insulte){
				if(preg_match('`'.preg_quote($insulte).' `i', $this->_contenu)){
					$this->_i++;
				}
			}
			
			if($this->_i++ > $this->_maxWord){
				$content = $this->_contenu;
				foreach($this->_insulte as $insulte){
					$content = preg_replace('`'.preg_quote($insulte).'`i', '***censur�***', $content);
				}
				return $content;
			}
			else{
				return $this->_contenu;
			}
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
		 * Configuration du tableau de mot vulgaure
		 * @access	public
		 * @return	void
		 * @since 2.0
		*/
		
		protected function  _setInsulte(){
			$this->_domXml = new DomDocument('1.0', CHARSET);
			if($this->_domXml->load(MODOGCCONFIG)){
				$this->_addError('fichier ouvert : '.MODOGCCONFIG);
				
				$this->_nodeXml = $this->_domXml->getElementsByTagName('insultes')->item(0);
				$sentences = $this->_nodeXml->getElementsByTagName('insulte');
				
				foreach($sentences as $sentence){
					if ($sentence->getAttribute("rubrique") == $this->_commandExplode[2]){
						if(CHARSET == strtolower('utf-8')) { $content =  utf8_encode($sentence->firstChild->nodeValue); }
						else { $content =  utf8_decode($sentence->firstChild->nodeValue); }
						array_push($this->_insulte, strtolower($content));
					}
				}
				
				print_r($this->_insulte);
			}
			else{
				$this->_addError('Le fichier '.MODOGCCONFIG.' n\'a pas pu �tre ouvert');
			}
		}
		
		protected function  _setAccent($contenu){
			$search = array ('@[������]@i','@[�����]@i','@[����]@i','@[�����]@i','@[����]@i','@[�]@i');
			$replace = array ('e','a','i','u','o','c');
			$contenu = preg_replace($search, $replace, $contenu);
			return strtolower($contenu);
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