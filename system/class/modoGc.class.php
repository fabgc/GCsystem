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
		
		public $contenu                       ; //contenu � filtrer
		protected $insulte =array(
			'salaud', 'merde', 'salope', 'pute', 'putain', 'fils de pute', 'encul�', 'connasse'); //array contenant toutes les erreurs enregistr�es
		
		public  function __construct(){
		}
		
		protected function _showError(){
			foreach($this->error as $error){
				$erreur .=$error."<br />";
			}
			return $erreur;
		}
		
		protected function _addError($error){
			array_push($this->error, $error);
		}
		
		public  function __desctuct(){
		
		}
	}
?>