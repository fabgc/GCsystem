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

		public function __destruct(){
		}
	}