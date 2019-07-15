<?php
	namespace App;

	/**
	* 
	*/
	class Db{
		private static $_connexion;
		public  static function getDb(){
			if(is_null(self::$_connexion)){
				try {
					self::$_connexion=new \PDO("mysql:host=localhost;dbname=baseprojetwebfindannee","ange","aegn1996");
					//self::$_connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);// pour deboguer les erreur sql
				} catch (Exception $e) {
					die("Erreur lors de la connexion");
				}
				
			}
			return self::$_connexion;
		}


	}
?>