<?php
	/*\
	 | ------------------------------------------------------
	 | @file : socialGc.class.php
	 | @author : fab@c++
	 | @description : class g�rant diff�rents r�seaux sociaux
	 | @version : 2.0 b�ta
	 | ------------------------------------------------------
	\*/
	
	class objectGc{
		private $error              = array(); //array contenant toutes les erreurs enregistr�es
		
		public  function __construct(){
			if
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