<?php
	/*\
	 | ------------------------------------------------------
	 | @file : cacheGc.class.php
	 | @author : fab@c++
	 | @description : class g�rant la mise en cache de fa�on g�n�rale
	 | @version : 2.0 b�ta
	 | ------------------------------------------------------
	\*/
	
	class CacheGc{
		private $name              ; //nom du cache
		private $nameFile          ; //nom du fichier de cache
		private $time              ; //temps de mise en cache
		private $val               ; //contenu � mettre en cache
		
		public function __construct($name, $val, $time=0){
			$this->time = $time;
			$this->name = $name;
			$this->nameFile = CACHE_PATH.$name.'.cache';
			$this->val = $val;
		}
		
		public function setCache(){
			if(!file_exists($this->nameFile)){
				$fichier = fopen($this->nameFile, 'w+');
				fwrite($fichier, $this->compress(serialize($this->val)));
				fclose($fichier);
			}
		 
			$time_ago = time() - filemtime($this->nameFile);
		 
			if($time_ago > $this->time){
				$fichier = fopen($this->nameFile, 'w+');
				fwrite($fichier, $this->compress(serialize($this->val)));
				fclose($fichier);
			}
		}
		
		public function setName($name){
			$this->name = $name;
			$this->nameFileFile = CACHE_PATH.$name.'.cache';
		}
		
		public function setVal($val){
			$this->val = $val;
		}
		
		public function setTime($time=0){
			$this->time = $time;
		}
	 
		public function getCache(){
			if(file_exists($this->nameFile)){
				return unserialize($this->uncompress(file_get_contents($this->nameFile)));
			}
			else{
				$this->setCache();
			}
		}
	 
		public function isDie(){
			$rep = false;
			if(!file_exists($this->nameFile)){
				$rep = false;
			}
			else{
				$time_ago = time() - filemtime($this->nameFile);
		 
				if($time_ago > $this->time){
					$rep = true;
				}
			}
			return $rep;
		}
		
		public function isExist(){
			if(file_exists($this->nameFile)){
				return true;
			}
			else{
				return false;
			}
		}
		
		private function compress($val){
			return gzcompress($val,9);
		}
		
		private function uncompress($val){
			return gzuncompress($val);
		}
	}
?>