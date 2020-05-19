<?php
	function DBConnection($DBname) {
		$login='root';
		$pass='';

		try {
			$connexion = new PDO("mysql:host=localhost;dbname=$DBname", $login, $pass);
			$connexion->exec("SET CHARACTER SET utf8");

			return $connexion;
		}
		catch (PDOException $e) {
			print "Erreur !: " . $e->getMessage() . "<br/>";
			die();
			return 0;
		}
	}

	function DBDeconnection($DBname) { 
		$DBname = null; 
	}
?>