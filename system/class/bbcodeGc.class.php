<?php
	/*\
	 | ------------------------------------------------------
	 | @file : bbcodeGc.class.php
	 | @author : fab@c++
	 | @description : class g�rant le parsage des messages
	 | @version : 2.0 b�ta
	 | ------------------------------------------------------
	\*/
	
	class bbcodeGc{
		public $contenu                       ; //contenu � parser
		private $error              = array() ; //array contenant toutes les erreurs enregistr�es
		
		public  function __construct(){
		}
		
		private function showError(){
			foreach($this->error as $error){
				$erreur .=$error."<br />";
			}
			return $erreur;
		}
		
		private function addError($error){
			array_push($this->error, $error);
		}
		
		public  function __desctuct(){
		
		}
	}
?>