<?php
	/**
	 * @file : fileGc.class.php
	 * @author : fab@c++
	 * @description : class g&eacute;rant les op&eacute;rations sur les fichiers, tr�s compl�te
	 * @version : 2.0 b�ta
	*/
	
    class fileGc{
		use errorGc;                           				   //trait
		
		protected $_filePath                                   ;
		protected $_fileName                                   ;
		protected $_fileExt                                    ;
		protected $_fileContent                                ;
		protected $_fileChmod                                  ;
		protected $_info                              = array();
		protected $_isExist                           = false  ;
		
		const NOFILE   = 'Aucun fichier n\'a �t� difini'     ;
		const NOACCESS = 'le fichier n\'est pas accessible'                ;
		const NOREAD   = 'le fichier n\'est pas lisible'                   ;
		
		const CHMOD0644                              = 0644  ;
		const CHMOD0755                              = 0755  ;
		const CHMOD0777                              = 0777  ;
		const CHMOD0004                              = 0004  ;
		
		/**
		 * Cr&eacute;e l'instance de la classe
		 * @access	public
		 * @param string $filepath : chemin complet ou relatif vers le fichier
		 * @return	void
		 * @since 2.0
		*/
		
		public function __construct($filepath){
			if($filepath == NULL) { $filepath = 'empty.txt'; $this->_setFileDefault($filepath); }
			if($filepath!=NULL && !is_file($filepath)) { $this->_setFileDefault($filepath); }
			
			$filepath = strval($filepath);
			if(is_file($filepath)){
				$this->setFile($filepath);
			}
			else{
				$this->_addError(self::NOACCESS);
			}
		}
		
		/**
		 * Retourne le chemin vers le fichier
		 * @access	public
		 * @return	string
		 * @since 2.0
		*/
		
		public function getFilePath(){
			return $this->_filePath;
		}
		
		/**
		 * Retourne le nom du fichier (avec son extension)
		 * @access	public
		 * @return	string
		 * @since 2.0
		*/
		
		public function getFileName(){
			return $this->_fileName;
		}
		
		/**
		 * Retourne l'extension du fichier
		 * @access	public
		 * @return	string
		 * @since 2.0
		*/
		
		public function getFileExt(){
			return $this->_fileExt;
		}
		
		/**
		 * Retourne l'extension du fichier pass&eacute; en param&egrave;tre
		 * @access	public
		 * @param string $ext : chemin du fichier
		 * @return	string
		 * @since 2.0
		*/
		
		public function getExtension($ext){
			$extension = explode('.', basename($ext));
			return $extension[count($extension)-1];
		}
		
		/**
		 * Retourne les informations du fichier dans un array<br />
		 *	0	dev	volume<br />
		 *	1	ino	Num&eacute;ro d'inode (*)<br />
		 *	2	mode	droit d'acc�s � l'inode<br />
		 *	3	nlink	nombre de liens<br />
		 *	4	uid	userid du propri&eacute;taire (*)<br />
		 *	5	gid	groupid du propri&eacute;taire (*)<br />
		 *	6	rdev	type du volume, si le volume est une inode<br />
		 *	7	size	taille en octets<br />
		 *	8	atime	date de dernier acc�s (Unix timestamp)<br />
		 *	9	mtime	date de derni�re modification (Unix timestamp)<br />
		 *	10	ctime	date de dernier changement d'inode (Unix timestamp)<br />
		 *	11	blksize	taille de bloc (**)<br />
		 *	12	blocks	nombre de blocs de 512 octets allou&eacute;s (**)<br />
		 * @access	public
		 * @return	array
		 * @since 2.0
		*/
		
		public function getFileInfo(){
			return $this->_fileInfo;
		}
		
		/**
		 * Retourne le contenu du fichier
		 * @access	public
		 * @return	string
		 * @since 2.0
		*/
		
		public function getFileContent(){
			return $this->_fileContent;
		}
		
		/**
		 * Retourne le chmod du fichier
		 * @access	public
		 * @return	int
		 * @since 2.0
		*/
		
		public function getFileChmod(){
			return $this->_fileChmod;
		}
		
		/**
		 * Retourne la taille du fichier
		 * @access	public
		 * @return	int
		 * @since 2.0
		*/
		
		public function getSize(){
			if($this->_isExist == true){
				return $this->_fileInfo['size'];
			}
			else{
				$this->_addError(self::NOFILE);
				return false;
			}
		}
		
		/**
		 * Retourne true si le fichier existe et false si le fichier n'existe pas
		 * @access	public
		 * @return	boolean
		 * @since 2.0
		*/
		
		public function getExist(){
			return $this->_isExist;
		}
		
		/**
		 * Retourne la date du dernier acc�s au fichier sous la forme d'un timestamp UNIX
		 * @access	public
		 * @return	int
		 * @since 2.0
		*/
		
		public function getLastAccess(){
			if($this->_isExist == true){
				return $this->_fileInfo['atime'];
			}
			else{
				$this->_addError(self::NOFILE);
				return false;
			}
		}
		
		/**
		 * Retourne la date de la derni�re modification du fichier sous la forme d'un timestamp UNIX
		 * @access	public
		 * @return	int
		 * @since 2.0
		*/
		
		public function getLastUpdate(){
			if($this->_isExist == true){
				return $this->_fileInfo['ctime'];
			}
			else{
				$this->_addError(self::NOFILE);
				return false;
			}
		}
		
		/**
		 * Retourne le r&eacute;pertoire contenant le fichier
		 * @access	public
		 * @return	string
		 * @since 2.0
		*/
		
		public function getFolder(){
			return dirname($this->_filePath);
		}
		
		/**
		 * Configure le chemin vers le fichier. Si aucun chemin n'est sp�cifi�, la valeur par d�faut est empty.txt
		 * @access	public
		 * @return	void
		 * @param string $filepath : chemin d'acc�s vers le fichier
		 * @since 2.0
		*/
		
		public function setFile($filepath){
			if($filepath == NULL) $filepath = 'empty.txt'; $this->_setFileDefault($filepath);
			if($filepath!=NULL && !is_file($filepath)) { $this->_setFileDefault($filepath); }
			
			$filepath = strval($filepath);
			if(is_file($filepath)){
				$this->_setFilePath($filepath);
				$this->_setFileName($filepath);
				$this->_setFileExt($filepath);
				$this->_setFileInfo($filepath);
				$this->_setFileContent($filepath);
				$this->_setFileChmod($filepath);
				$this->_isExist = true;
			}
			else{
				$this->_addError(self::NOACCESS);
			}
		}
		
		/**
		 * Configure le chmod du fichier
		 * @access	public
		 * @return	void
		 * @param string $chmod : contient le chmod � appliquer au fichier. La valeur par d�faut est 0644
		 * @since 2.0
		*/
		
		public function setChmod($chmod =self::CHMOD644){
			chmod($this->_filePath, $chmod);
			$this->_setFileChmod($this->_filePath);
		}
		
		/**
		 * Configure le contenu du fichier
		 * @access	public
		 * @return	void
		 * @param string $content : contient le contenu du fichier
		 * @since 2.0
		*/
		
		public function setContent($content){
			file_put_content($this->_fileContent, $content);
			$this->_setFileContent($this->_filePath);
		}
		
		/**
		 * D�place le fichier dans un autre r�pertoire. Le fichier de d�part sera alors supprim�
		 * @access	public
		 * @return	boolean
		 * @param string $dir : r�pertoire o&ugrave; sera d�plac� le fichier
		 * @since 2.0
		*/
		
		public function moveTo($dir){
			if($this->_isExist == true){
				if(copy($this->_filePath, $dir.$this->_fileName)){
					if(unlink($this->_filePath)){
						$this->setFile($dir.$this->_fileName);
						return true;
					}
					else{
						$this->_addError('le fichier n\'a pas pu �tre d&eacute;plac&eacute; du r&eacute;pertoire original');
						return false;
					}
				}
				else{
					$this->_addError('le fichier n\'a pas pu �tre d&eacute;plac&eacute;');
					return false;
				}
			}
			else{
				$this->_addError(self::NOFILE);
				return false;
			}
		}
		
		/**
		 * Copie le fichier dans un autre r�pertoire.
		 * @access	public
		 * @return	boolean
		 * @param string $dir : r�pertoire o&ugrave; sera copi� le fichier
		 * @since 2.0
		*/
		
		public function copyTo($dir){
			if($this->_isExist == true){
				if(copy($this->_filePath, $dir.$this->_fileName)){
					return true;
				}
				else{
					$this->_addError('le fichier n\'a pas pu �tre copi&eacute;');
					return false;
				}
			}
			else{
				$this->_addError(self::NOFILE);
				return false;
			}
		}
		
		/**
		 * Copie le contenu du fichier dans un autre fichier
		 * @access	public
		 * @return	boolean
		 * @param string $file : fichier dans lequelle sera copi� le contenu du fichier de d�part
		 * @since 2.0
		*/
		
		public function contentTo($file){
			if(is_file($file)){
				if(is_readable($file)){
					file_put_contents($file, $this->_fileContent);
				}
				else{
					$this->_addError(self::NOAREAD);
					return false;
				}
			}
			else{
				$this->_addError(self::NOACCESS);
				return false;
			}
		}
		
		/**
		 * Permet de savoir si le fichier est accessible en �criture
		 * @access	public
		 * @return	boolean
		 * @since 2.0
		*/
		
		public function isWritable() {
			if(is_writable($this->_filePath)){
				return true;
			}
			else{
				return false;
			}
		}
		
		/**
		 * Permet de savoir si le fichier est ex�cutable
		 * @access	public
		 * @return	boolean
		 * @since 2.0
		*/
		
		public function iseExecutable() {
			if(is_executable($this->_filePath)){
				return true;
			}
			else{
				return false;
			}
		}
		
		/**
		 * Permet de savoir si le fichier est accessible en lecture
		 * @access	public
		 * @return	boolean
		 * @since 2.0
		*/
		
		public function iseReadable() {
			if(is_readable($this->_filePath)){
				return true;
			}
			else{
				return false;
			}
		}
		
		/**
		 * Configure le fichier par d�faut
		 * @access	public
		 * @return	void
		 * @param string $file : chemin d'acc�s vers le fichier
		 * @since 2.0
		*/
		
		protected function _setFileDefault($file){
			$fileCreate = fopen($file, 'a');
			fclose($fileCreate);
		}
		
		/**
		 * Configure le chemin d'acc�s vers le fichier
		 * @access	public
		 * @return	boolean
		 * @param string $file : chemin d'acc�s vers le fichier
		 * @since 2.0
		*/
		
		protected function _setFilePath($file){
			if(is_file($file)){
				$this->_filePath = $file;
				return true;
			}
			else{
				$this->_addError(self::NOACCESS);
				return false;
			}
		}
		
		/**
		 * Configure le nom du fichier (avec son extension)
		 * @access	public
		 * @return	boolean
		 * @param string $file : chemin d'acc�s vers le fichier
		 * @since 2.0
		*/
		
		protected function _setFileName($file){
			if(is_file($file)){
				$this->_fileName = basename($file);
				return true;
			}
			else{
				$this->_addError(self::NOACCESS);
				return false;
			}
		}
		
		/**
		 * Configure l'extension du fichier
		 * @access	public
		 * @return	boolean
		 * @param string $file : chemin d'acc�s vers le fichier
		 * @since 2.0
		*/
		
		protected function _setFileExt($file){
			if(is_file($file)){
				$extension = explode('.', basename($file));
				$this->_fileExt = $extension[count($extension)-1];
				return true;
			}
			else{
				$this->_addError(self::NOACCESS);
				return false;
			}
		}
		
		/**
		 * Configure le contenu du fichier
		 * @access	public
		 * @return	boolean
		 * @param string $file : chemin d'acc�s vers le fichier
		 * @since 2.0
		*/
		
		protected function _setFileContent($file){
			if(is_file($file)){
				if(is_readable($file)){
					$this->_fileContent = file_get_contents($file);
					return true;
				}
				else{
					$this->_addError(self::NOAREAD);
					return false;
				}
			}
			else{
				$this->_addError(self::NOACCESS);
				return false;
			}
		}
		
		/**
		 * Configure les infos du fichier
		 * @access	public
		 * @return	boolean
		 * @param string $file : chemin d'acc�s vers le fichier
		 * @since 2.0
		*/
		
		protected function _setFileInfo($file){
			if(is_file($file)){
				$this->_fileInfo = stat($file);
				return true;
			}
			else{
				$this->_addError(self::NOACCESS);
				return false;
			}
		}
		
		/**
		 * Configure le chmod du fichier
		 * @access	public
		 * @return	boolean
		 * @param string $file : chemin d'acc�s vers le fichier
		 * @since 2.0
		*/
		
		protected function _setFileChmod($file){
			if(is_file($file)){
				$this->_fileChmod = substr(sprintf('%o', fileperms($file)), -4);;
				return true;
			}
			else{
				$this->_addError(self::NOACCESS);
				return false;
			}
		}
		
		/**
		 * Desctructeur
		 * @access	public
		 * @return	void
		 * @since 2.0
		*/
		
		public function __destruct(){
		}
	}