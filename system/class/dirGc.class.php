<?php
	/*\
	 | ------------------------------------------------------
	 | @file : dirGc.class.php
	 | @author : fab@c++
	 | @description : class g�rant les op�rations sur les fichiers
	 | @version : 2.0 b�ta
	 | ------------------------------------------------------
	\*/
	
    class dirGc{
		private $dir;
		private $error              = array() ; //array contenant toutes les erreurs enregistr�es
		
		public function __construct($dir){
			$this->dir = $dir;
		}
		
		public function setDir($dir){
			$this->dir = $dir;
		}
		
		public function setChmod($chmod){
		}
		
		public function setChmodFiles($chmod){
		}
		
		public function moveTo($dir){
		
		}
		
		public function copyTo($dir){
		
		}
		
		public function showdir($dir){
		
		}
		
		private function _showError(){
			foreach($this->error as $error){
				$erreur .=$error."<br />";
			}
			return $erreur;
		}
		
		private function _addError($error){
			array_push($this->error, $error);
		}

		public function __destruct(){
		}
	}