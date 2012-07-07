<?php
	/**
	 * @file : modoGc.class.php
	 * @author : fab@c++
	 * @description : class g�rant le filtrage du contenu du site
	 * @version : 2.0 b�ta
	*/
	
	class modoGc{
		use errorGc;                            //trait
		
		protected $_contenu                       ; //contenu � filtrer
		protected $_maxWord                  = 10  ; //contenu � filtrer
		protected $_insulte                  = array('Agnaflai', 'Amagan', 'Anani Sikerim', 'Anayin Ami', 'Anus De Poulpe', 'Arschloch', 'Arta�l', 'Aspirateur � Bites', 'Aspirateur � Muscadet',
													 'Asshole', 'Ateye', 'Balafamouk', 'Balai De Chiottes', 'Bassine A Foutre', 'Bite Molle', 'Bleubite', 'Bordel', 'Bordel � Cul', 'Bouche � Pipe',
													 'Bouffon', 'Bougre De Con', 'Bougre De Conne', 'Boursemolle', 'Boursouflure', 'Bouseux', 'Boz', 'Branleur', 'Butor', 'Cabron', 'Caja De Miera',
													 'Chancreux', 'Chien D\'infid�le', 'Chien Galeux', 'Chieur', 'Clawi', 'Con', 'Conard', 'Connard', 'Connasse', 'Conne', 'Cono', 'Couille De Loup',
													 'Couille De Moineau', 'Couille De T�tard', 'Couille Molle', 'Couillon', 'Crevard', 'Crevure', 'Cr�tin', 'Cul De Babouin', 'Cul Terreux', 
													 'Degueulasse', 'Ducon', 'D�g�n�r� Chromozomique', 'Embrayage', 'Emmerdeur', 'Encule Ta M�re', 'Enculeur De Mouches', 'encul�', 'Enfant De Tainpu',
													 'Face De Cul', 'Face De Pet', 'Face De Rat', 'Fils De Pute', 'Fouille Merde', 'Grognasse', 'Gros Con', 'Hijo De Puta', 'Lopette', 'Manche � Couille',
													 'Mange Merde', 'Merde', 'Mist', 'Moudlabite', 'Pauvre Con', 'Pendejo', 'Perra', 'Petite Merde', 'Playboy De Superette', 'Pouffiasse', 'Putain',
													 'Pute', 'Pute Au Rabais', 'P�tasse', 'Qu�quette', 'Raclure De Bidet', 'Raclure De Chiotte', 'Sac � Merde', 'Safali', 'Salaud', 'Sale Pute', 'Saligaud',
													 'Salopard', 'Salope', 'Sous Merde', 'Spermatozoide Avari�', 'Suce Bites', 'Trou De Balle', 'Trou Du Cul', 'T�te De Bite', 'Va Te Faire', 'Vieux Con'); //array contenant toutes les erreurs enregistr�es
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
		 * Fonction de parsage du message. Retourne soit true soit un array contenant la liste des insultes
		 * @access	public
		 * @return	array ou boolean
		 * @since 2.0
		*/
		
		public function parse(){
			$this->_parseInsulte = array();
			foreach($this->_insulte as $insulte){
				if(preg_match('`'.preg_quote($insulte).'`i', $tihs->_contenu)){
				
				}
			}
			
			if(count($this->_parseInsulte) == 0){
				return $this->_parseInsulte;
			}
			else{
				return true;
			}
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