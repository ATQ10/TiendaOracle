<?php
class BD{
	private static $conn;

	public function __construct(){}

	public static function conn(){
		if(is_null(self::$conn)){
			self::$conn = new PDO('mysql:host=localhost;dbname=videoaula', "root",  "");
		}

        return self::$conn;
	}
}
?>