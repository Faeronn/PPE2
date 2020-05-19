	<?php
	session_start();

	require_once('PDO.php');

	$connexion = DBConnection('ppe2_doublage');	

	if($connexion) {
		if(isset($_POST['loginC']) && isset($_POST['passC'])) {
			$login = htmlspecialchars($_POST['loginC']);
			$pass = htmlspecialchars($_POST['passC']);

			$selectQuery = "SELECT COUNT(*) FROM adherent WHERE username = '" . $login . "'" . " AND pass = '" . $pass . "'" ;
  			$result = $connexion->query($selectQuery)->fetchColumn();

			if($result > 0) {
				$_SESSION['login'] = $_POST['loginC'];
				$_SESSION['pass'] = $_POST['passC'];
			}
		}
	}

	DBDeconnection($connexion);
	header('Location: ../index.html');
?>