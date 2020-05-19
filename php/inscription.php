<?php
	require_once('PDO.php');

	$connexion = DBConnection('ppe2_doublage');

	function getCategorie($dateNaissance) {
		$age = floor((time() - strtotime($dateNaissance)) / 31556926);

		if($age < 12) {
			$categorie = 1;
		}
		elseif($age < 16) {
			$categorie = 2;
		}
		elseif($age < 18) {
			$categorie = 3;
		}
		else {
			$categorie = 4;
		}

		return $categorie;
	}
	
	if($connexion) {
		if( isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) &&  isset($_POST['dateNaiss']) && isset($_POST['login']) && isset($_POST['pass'])) {
			$categorie = getCategorie($_POST['dateNaiss']);
			
			$selectQuery = "INSERT INTO adherent (idcategorie, idequipe, nomadherent, prenomadherent, adresseadherent, codepostal, teladherent, emailadherent, datenaissadherent, username, pass) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			$connexion->prepare($selectQuery)->execute([$categorie, '1', $_POST["nom"], $_POST["prenom"], (isset($_POST["adresse"])? $_POST["adresse"] : ""), (isset($_POST["codePostal"])? $_POST["codePostal"] : ""), (isset($_POST["tel"])? $_POST["tel"] : ""), $_POST["mail"], $_POST['dateNaiss'], $_POST['login'], $_POST['pass']]);
		}
	}

	DBDeconnection($connexion);
	header('Location: ../index.html');
?>