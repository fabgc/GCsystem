<?php
	/*\
	 | ------------------------------------------------------
	 | @file : fileGc.class.php
	 | @author : fab@c++
	 | @description : class g�rant les op�rations sur les fichiers
	 | @version : 2.0 b�ta
	 | ------------------------------------------------------
	\*/
	
    class fileGc{		
		private $file;
		private $error;
		
		public function __construct($file){
			if(is_file($file)){
				$this->file = $file;
			}
			else{
				$this->addError('le fichier n\'est pas accessible');
			}
		}
		
		public function setFile($file){
			if(is_file($file)){
				$this->file = $file;
			}
			else{
				$this->addError('le fichier n\'est pas accessible');
				return false;
			}
		}
		
		public function setChmod($chmod){
		}
		
		public function moveTo($dir){
			if(copy($file, $dest)){
				if(delete($file)){
					$this->setFile($dir.'/'.array_pop(explode($file)));
					return true;
				}
			}
			else{
				$this->addError('le fichier n\'a pas pu �tre d�plac�');
				return false;
			}
		}
		
		public function copyTo($dir){
			if(copy($file, $dest)){
				return true;
			}
			else{
				$this->addError('le fichier n\'a pas pu �tre copi�');
				return false;
			}
		}
		
		public function showFile($dir){
		
		}
		
		private function addError($error){
			array_push($this->error, $error);
		}
		
		public function showError(){
			foreach($this->error as $error){
				$erreur .=$error."<br />";
			}
			return $erreur;
		}
		
		public function returnRelative(){
		}

		public function __destruct(){
		}
	}