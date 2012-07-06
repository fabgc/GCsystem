<?php
	/*\
	 | ------------------------------------------------------
	 | @file : langGc.class.php
	 | @author : fab@c++
	 | @description : class permettant la gestion de plusieurs langues
	 | @version : 2.0 b�ta
	 | ------------------------------------------------------
	\*/
	
    class langGc{
		use errorGc;                            //trait fonctions g�n�riques
		
		protected $_lang = 'fr';
		protected $_langFile = true;
		protected $_domXml;
		protected $_sentence;
		protected $_content;
		
		public function __construct($lang){
			$this->_lang = $lang;
			$this->loadFile();
		}
		
		public function setLang($lang){
			$this->_lang = $lang;
			$this->_addError('fichier � ouvrir : '.$lang);
			$this->loadFile();
		}
		
		public function loadFile(){
			if(is_file(LANG_PATH.$this->_lang.LANG_EXT)){
				$this->_langFile=true;
				$this->_domXml = new DomDocument('1.0', 'iso-8859-15');
				if($this->_domXml->load(LANG_PATH.$this->_lang.LANG_EXT)){
					$this->_langFile=true;
					$this->_addError('fichier ouvert : '.$this->_lang);
				}
				else{
					$this->_langFile=false;
					$this->_addError('Le fichier de langue n\'a pas pu �tre ouvert.');
				}
			}
			else{
				$this->_addError('Le fichier de langue n\'a pas �t� trouv�, passage par la langue par d�faut.');
				$this->_lang = DEFAULTLANG;
				$this->_langFile=true;
				$this->_domXml = new DomDocument('1.0', 'iso-8859-15');
				if($this->_domXml->load(LANG_PATH.$this->_lang.LANG_EXT)){
					$this->_langFile=true;
					$this->_addError('fichier ouvert : '.$this->_lang);
				}
				else{
					$this->_langFile=false;
					$this->_addError('Le fichier de langue n\'a pas pu �tre ouvert.');
				}
			}
		}
		
		public function loadSentence($nom){
			if($this->_langFile==true){
				$blog = $this->_domXml->getElementsByTagName('lang')->item(0);
				$sentences = $blog->getElementsByTagName('sentence');
				
				foreach($sentences as $sentence){
					if ($sentence->getAttribute("id") == $nom){
						$this->_content =  $sentence->firstChild->nodeValue;
					}
				}
				
				if($this->_content!=""){
					return utf8_decode($this->_content);
				}
				else{
					return 'texte non trouv�';
				}
			}
			else{
				$this->_addError('Le fichier de langue ne peut pas �tre lu.');
			}
		}
		
		public function __destruct(){
		}
	}