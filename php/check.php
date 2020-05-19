<?php
	require_once('PDO.php');

	$connexion = DBConnection('ppe2_doublage');
	
	if(!empty($_POST["login"])) {
  		$selectQuery = "SELECT COUNT(*) FROM adherent WHERE username = '" . $_POST["login"] . "'";
      
  		$result = $connexion->query($selectQuery)->fetchColumn();

  		if($result > 0) {
      		echo "1";
  		}
  		else {
      		echo "0";
      	}
  	}
  	DBDeconnection($connexion);
?>