<?php
	/*\
	 | ------------------------------------------------------
	 | @file : generalGc.class.php
	 | @author : fab@c++
	 | @description : interface
	 | @version : 2.0 b�ta
	 | ------------------------------------------------------
	\*/
	
    interface generalGc{
		public function setErrorLog($file, $message);
		public function sendMail($email, $message_html, $sujet, $envoyeur);
		public function windowInfo($Title, $Content, $Time, $Redirect);
		public function BlockInfo($Title, $Content, $Time, $Redirect);
    }