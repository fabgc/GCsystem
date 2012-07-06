<?php
	/*\
	 | ------------------------------------------------------
	 | @file : rubrique.class.php
	 | @author : fab@c++
	 | @description : class m�re de l'application
	 | @version : 2.0 b�ta
	 | ------------------------------------------------------
	\*/
	
	class Gcsystem{
		use errorGc, langInstance, generalGc;                            //trait fonctions g�n�riques
		/* --- infos d'en tete -- */
		
		protected $doctype                     ;
		protected $title                       ;
		protected $metaContentType             ;
		protected $metaKeyword                 ;
		protected $metaDescription             ;
		protected $metaRobot                   ;
		protected $metaGoogleSite              ;
		protected $openSearch                  ;
		protected $js =                 array();
		protected $css =                array();
		protected $jsInFile =           array();
		protected $rss =                array();
		protected $contentMarkupBody           ;
		protected $localisation                ;
		protected $otherHeader =        array();
		protected $fbTitle                     ;
		protected $fbDescription               ;
		protected $fbImage                     ;
		protected $htmlType                    ;
		
		/* --- permet d'affiche le doctype et l'entete (avant la balise body) et </body></html> -- */
		
		protected $header;
		protected $footer;
		
		/* ---------- CONSTRUCTEURS --------- */
		
		public  function __construct($lang=""){
			$this->doctype='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
			$this->doctype.="\n";
			$this->doctype.='<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >';
			$this->title='Page Web';
			$this->metaContentType='text/html; charset='.CHARSET;
			$this->metaKeyword='';
			$this->metaDescription='';
			$this->metaRobot='index,follow';
			$this->metaGoogleSite='';
			$this->openSearch='';
			$this->js= array ('script.js');
			$this->css= array ('default.css');
			$this->jsInFile = array('inpage.js');
			$this->otherHeader = array();
			$this->_langInstance;
			$this->_createLangInstance();
			if($lang==""){ $this->lang=$this->getLangClient(); } else { $this->lang=$lang; }
		}
		
		/* ---------- CONNEXION A LA BASE DE DONNEES --------- */
		
			public function connectDatabase($db){
				foreach ($db as $d){
					switch ($d['extension']){
						case 'pdo':
							try{
								$sql_connect[''.$d['database'].''] = new PDO('mysql:host='.$d['hostname'].';dbname='.$d['database'], $d['username'], $d['password']);
							}
							catch (PDOException $e){
								$this->setErrorLog('errors.log', 'Une exception a �t� lanc�e. Message d\'erreur lors de la connexion � une base de donn�es : '.$e.'');
							}	
						break;
						
						case 'mysqli':
							$sql_connect[''.$d['database'].''] = new mysqli($d['hostname'], $d['username'], $d['password'], $d['database']);
						break;
						
						case 'mysql':
							$sql_connect[''.$d['database'].''] = mysql_connect($d['hostname'], $d['username'], $d['password']);
							$sql_connect[''.$d['database'].''] = mysql_select_db($d['database']);
						break;
						
						default :
							$this->setErrorLog('errors.log', 'L\'extension de cette connexion n\'est pas g�r�e');
						break;
					}
				}
				return $sql_connect;
			}
			
			protected function _createLangInstance(){
				$this->_langInstance = new langGc($this->_lang);
			}
			
			public function useLang($sentence){
				return $this->_langInstance->loadSentence($sentence);
			}
			
			public function GzipinitOutputFilter() {
				ob_start('ob_gzhandler');
				register_shutdown_function('ob_end_flush');
			}
			
			public function setView($name, $var){
				$GLOBALS[''.$name.'']=$var;
			}
			
			public function destroyVarView($name){
				unset($GLOBALS[''.$name.'']);
			}
			
			public function setRubrique($rubrique){
				if(file_exists(SQL_PATH.$rubrique.SQL_EXT.'.php')){ require_once(SQL_PATH.$rubrique.SQL_EXT.'.php');}
				if(file_exists(FORMS_PATH.$rubrique.FORMS_EXT.'.php')){ require_once(FORMS_PATH.$rubrique.FORMS_EXT.'.php'); }
				if(file_exists(INCLUDE_PATH.$rubrique.FUNCTION_EXT.'.php')){ require_once(INCLUDE_PATH.$rubrique.FUNCTION_EXT.'.php');}
				require_once(RUBRIQUE_PATH.$rubrique.'.php');
			}
		
		/* ---------- SETTER --------- */
		
		public function setInfo($info=array()){
			foreach($info as $cle=>$info){
				switch($cle){
					case'doctype':
						switch($info){
							case 'xhtml11':
								$this->doctype='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';
								$this->doctype.="\n";
								$this->doctype.='<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >';
							break;
							
							case 'xhtml1-strict':
								$this->doctype='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
								$this->doctype.="\n";
								$this->doctype.='<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >';
							break;
							
							case 'xhtml1-trans':
								$this->doctype='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
								$this->doctype.="\n";
								$this->doctype.='<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >';
							break;
							
							case 'xhtml1-frame':
								$this->doctype='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">';
								$this->doctype.="\n";
								$this->doctype.='<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >';
							break;
							
							case 'html5':
								$this->doctype='<!DOCTYPE html>';
								$this->doctype.="\n";
								$this->doctype.='<html lang="fr">';
								$this->htmlType = 'html5';
							break;
						}
					break;
					
					case 'title': 
						$this->title=$info;
					break;

					case 'type': 
						$this->metacontenttype=$info;
					break;

					case 'key':
						$this->metakeyword=$info;
					break;

					case 'description':
						$this->metadescription=$info;
					break;

					case 'metarobot':
						$this->metarobot=$info;
					break;

					case 'metagooglesite':
						$this->metagooglesite=$info;
					break;

					case 'opensearch':
						$this->opensearch=$info;
					break;

					case 'js':
						$this->js=$info;
					break;

					case 'css':
						$this->css=$info;
					break;

					case 'jsinfile':
						$this->jsinfile=$info;
					break;

					case 'rss':
						$this->rss=$info;
					break;

					case 'contentmarkupbody':
						$this->contentmarkupbody=$info;
					break;

					case 'otherheader':
						$this->otherheader=$info;
					break;
					
					case 'localisation':
						$this->localisation=$info;
					break;
					
					case 'lang':
						$this->lang=$info;
					break;
					
					case 'fb_title':
						$this->fbTitle=$info;
					break;
					
					case 'fb_desccription':
						$this->fbDesccription=$info;
					break;
					
					case 'fb_image':
						$this->fbImage=$info;
					break;
				}
			}
		}
		
		public function setDoctype($Doctype){
			$this->doctype=$Doctype;
		}
		
		public function setTitle($Title){
			$this->title=$Title;
		}
		
		public function setMetaContentType($Type){
			$this->metaContentType=$Type;
		}
		
		public function setMetaKeyword($Key){
			$this->metaKeyword=$Key;
		}
		
		public function setMetaDescription($Description){
			$this->metaDescription=$Description;
		}
		
		public function setMetaRobot($MetaRobot){
			$this->metaRobot=$MetaRobot;
		}
		
		public function setMetaGoogleSite($MetaGoogleSite){
			$this->metaGoogleSite=$MetaGoogleSite;
		}   

		public function setOpenSearch($OpenSearch){
			$this->openSearch=$OpenSearch;
		} 

		public function setRss($Rss){
			$this->rss=$Rss;
		}   		
		
		public function setJs($Js){
			$this->js=$Js;
		}   
		
		public function setCss($Css){
			$this->css=$Css;
		}   
		
		public function setJsInFile($JsInFile){
			$this->jsInFile=$JsInFile;
		}
		
		public function setLocalisation($Localisation){
			$this->localisation=$Localisation;
		}
		
		public function setContentMarkupBody($ContentMarkupBody){
			$this->contentMarkupBody=$ContentMarkupBody;
		}
		
		public function SetotherHeader($OtherHeader){
			$this->otherHeader=$OtherHeader;
		} 
		
		public function SetFbTitle($FbTitle){
			$this->fbTitle=$FbTitle;
		} 
		
		public function SetFbDescription($FbDescription){
			$this->fbDescription=$FbDescription;
		} 
		
		public function SetFbImage($FbImage){
			$this->fbImage=$FbImage;
		} 
		
		public function setLang($Lang){
			$this->lang=$Lang;
			$this->_langInstance->setLang($this->lang);
		} 
		
		/* ---------- GETTER --------- */
		
		public function getDoctype(){
			return $this->doctype;
		}
		
		public function getTitle(){
			return $this->title;
		}
		
		public function getMetaContentType(){
			return $this->metaContentType;
		}
		
		public function getMetaKeyword(){
			return $this->metaKeyword;
		}
		
		public function getMetaDescription(){
			return $this->metaDescription;
		}
		
		public function getMetaRobot(){
			return $this->metaRobot;
		}
		
		public function getMetaGoogleSite(){
			return $this->metaGoogleSite;
		}   

		public function getOpenSearch(){
			return $this->openSearch;
		}     	 
		
		public function getJs(){
			return $this->js;
		}   
		
		public function getCss(){
			return $this->css;
		}   
		
		public function getJsInFile(){
			return $this->jsInFile;
		}
		
		public function getContentMarkupBody(){
			return $this->contentMarkupBody;
		}
		
		public function getOtherHeader(){
			return $this->otherHeader;
		}  
		
		public function getLocalisation(){
			return $this->localisation;
		}
		
		public function getLang(){
			return $this->lang;
		} 
		
		public function getFbTitle(){
			return $this->fbTitle;
		} 
		
		public function getFbDescription(){
			return $this->fbDescription;
		} 
		
		public function getFbImage(){
			return $this->fbImage;
		} 
		
		public  function __desctuct(){
		
		}
		
		/* ---------- FONCTIONS ------------- */
		
		public function setMaintenance(){
			$tpl = new templateGC('GCmaintenance', 'GCmaintenance', 0, $this->lang);				
			$tpl->show();
		}
		
		public function affHeader(){
			$this->header.=$this->doctype."\n";
			$this->header.="  <head>\n";
			$this->header.="    <title>".($this->title)."</title>\n";
			if($this->htmlType !='html5'){ $this->header.="    <meta http-equiv=\"Content-Type\" content=\"".$this->metaContentType."\" />\n"; }
				else { $this->header.="    <meta charset=\"utf-8\" />"; }
			$this->header.="    <meta http-equiv=\"content-language\" content=\"fr\"/>\n";
			$this->header.="    <meta name=\"keywords\" content=\"".$this->metaKeyword."\"/>\n";
			$this->header.="    <meta name=\"description\" content=\"".$this->metaDescription."\" />\n";
			$this->header.="    <meta name=\"robots\" content=\"".$this->metaRobot."\" />\n";
			$this->header.="    <meta name=\"geo.placename\" content=\"".$this->localisation."\" />\n";
			
			if($this->fbTitle!=""){
				$this->header.="    <meta property=\"og:description\" content=\"".$this->fbTitle."\" />\n";
			}
			if($this->fbDescription!=""){
				$this->header.="    <meta property=\"og:description\" content=\"".$this->fbDescription."\" />\n";
			}
			if($this->fbImage!=""){
				$this->header.="    <meta property=\"og:description\" content=\"".$this->fbImage."\" />\n";
			}
			if($this->metaGoogleSite!=""){
				$this->header.="    <meta name=\"google-site-verification\" content=\"".$this->metaGoogleSite."\" />\n";
			}
			if($this->openSearch!=""){
				$this->header.="    <link href=\"".$this->openSearch."\"  rel=\"search\" type=\"application/opensearchdescription+xml\" title=\"open search\" />\n";
			}
			
			if(is_file(FAVICON_PATH)){
				$this->header.="     <link rel=\"icon\" type=\"image/png\" href=\"".FAVICON_PATH."\" />\n";
			}
			
			if(JQUERY==true){
				$this->header.="    <script type=\"text/javascript\" src=\"".JQUERYFILE."\" ></script> \n";
				$this->header.="    <script type=\"text/javascript\" src=\"".JQUERYUIJS."\" ></script> \n";
				$this->header.="    <link href=\"".JQUERYUICSS."\" rel=\"stylesheet\" type=\"text/css\" media=\"screen, print, handheld\" />\n";
			}
			
			foreach($this->js as $element){
				if(is_file(JS_PATH.$element)){
					$this->header.="    <script type=\"text/javascript\" src=\"".JS_PATH.$element."\" ></script> \n";
				}
			}
			foreach($this->css as $element){
				if(!preg_match('#http:#', $element)){
					if(is_file(CSS_PATH.$element)){
						$this->header.="    <link href=\"".CSS_PATH.$element."\" rel=\"stylesheet\" type=\"text/css\" media=\"screen, print, handheld\" />\n";
					}
				}
				else{
					$this->header.="    <link href=\"".$element."\" rel=\"stylesheet\" type=\"text/css\" media=\"screen, print, handheld\" />\n";
				}	
			}
			
			foreach($this->jsInFile as $element){
				$this->header.="    <script type=\"text/javascript\">\n";
				if(is_file(JS_PATH.$element)){
					$fichier=JS_PATH.$element;
					$contenu = fread(fopen($fichier, "r"), filesize($fichier));
					$this->header.="    ".$contenu."\n";
				}
				$this->header.="    </script>\n";
			}
			
			foreach($this->rss as $element){
				if(is_file($element)){
					$this->header.="    <link rel=\"alternate\" type=\"application/rss+xml\" title=\"".$element."\" href=\"".$element."\" />\n";
				}
				else{
					$this->header.="    <link rel=\"alternate\" type=\"application/rss+xml\" title=\"".$element."\" href=\"".$element."\" />\n";
				}
			}
			
			if($this->otherHeader){
				foreach($this->otherHeader as $element){
					$this->header.="    ".$element."\n";
				}
			}
			
			$this->header.="  </head>\n";
			
			if($this->contentMarkupBody!=""){
				$this->header.="  <body ".$this->contentMarkupBody.">\n";
			}
			else{
				$this->header.="  <body>\n";
			}
			
			return $this->header;			
		}   
		
		public function affFooter(){
			$this->footer="  </body>\n</html>";
			return $this->footer;
		}
		
		public function genererToken(){
			$token = uniqid(rand(), true);
			return $token;
		}
		
		public function affTemplate($nom_template){
			if(is_file(TEMPLATE_PATH.$nom_template.TEMPLATE_EXT)) { 
				include(TEMPLATE_PATH.$nom_template.TEMPLATE_EXT);
			} 
			else { 
				$this->setErrorLog('errors.log', 'Le template '.$nom_template.' n\'a pas �t� trouv�');
			}
		}
		
		public function getIp(){
			return $_SERVER['REMOTE_ADDR'];
		}
	
		public function getQuery(){
			return $_SERVER['QUERY_STRING'];
		}
		
		public function getPhpSelf(){
			return $_SERVER['PHP_SELF'];
		}
		
		public function getHost(){
			return $_SERVER['HTTP_HOST'];
		}
		
		public function getUri(){
			return $_SERVER['REQUEST_URI'];
		}
		
		public function getReferer(){
			return $_SERVER['HTTP_REFERER'];
		}
		
		public function getServerName(){
			return $_SERVER['SERVER_NAME'];
		}
	}
?>