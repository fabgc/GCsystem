<?php
    class lang{
		private $lang = 'fr';
		private $langFile = true;
		private $domXml;
		private $sentence;
		private $error = array();
		private $content;
		
		public function __construct($lang){
			$this->lang = $lang;
			$this->loadFile();
		}
		
		public function setLang($lang){
			$this->lang = $lang;
			$this->addError('fichier � ouvrir : '.$lang);
			$this->loadFile();
			echo $this->showError();
		}
		
		public function loadFile(){
			if(is_file(LANG_PATH.$this->lang.LANG_EXT)){
				$this->langFile=true;
				$this->domXml = new DomDocument();
				if($this->domXml->load(LANG_PATH.$this->lang.LANG_EXT)){
					$this->langFile=true;
					$this->addError('fichier ouvert : '.$this->lang);
				}
				else{
					$this->langFile=false;
					$this->addError('Le fichier de langue n\'a pas pu �tre ouvert.');
				}
			}
			else{
				$this->addError('Le fichier de langue n\'a pas �t� trouv�.');
				$this->langFile=false;
			}
		}
		
		public function loadSentence($nom){
			if($this->langFile==true){
				$blog = $this->domXml->getElementsByTagName('lang')->item(0);
				$sentences = $blog->getElementsByTagName('sentence');
				
				foreach($sentences as $sentence){
					if ($sentence->getAttribute("id") == $nom){
						$this->content =  $sentence->firstChild->nodeValue;
					}
				}
				return $this->content;
			}
			else{
				$this->addError('Le fichier de langue ne peut pas �tre lu.');
			}
		}
		
		public function showError(){
			foreach($this->error as $error){
				$erreur .=$error."<br />";
			}
			return $erreur;
		}
		
		private function addError($error){
			array_push($this->error, $error);
		}
		
		public function __destruct(){
		}
	}