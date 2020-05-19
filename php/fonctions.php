<?php
		function checkSession() {
			if(isset($_SESSION['login']) && isset($_SESSION['login'])) {
				echo "<li><p class='loginSession'>" . ucfirst($_SESSION['login']) . "</li>";
				echo "<li><a href='#' onclick=\"<?php destroySession() ?>\">Deconnexion</a></li>";
            }
            else {
                echo "<li><a href='#' onclick=\"displayMenu('inscription')\">Inscription</a></li>";
                echo "<li><a href='#' onclick=\"displayMenu('connexion')\">Connexion</a></li>"; 		
            }
		}

        function destroySession() {
            session_destroy();
            $_SESSION = array();

            header('Location: ../index.html');
        }

        function getAdh() {
            require_once('php/PDO.php');
            $connexion = DBConnection('ppe2_doublage');

            if(!isset($_POST['tri'])) {
                $selectQuery = "SELECT * FROM adherent ORDER BY idAdherent";
            }
            else {
                switch($_POST['tri']) {
                    case 1:
                        $selectQuery = "SELECT * FROM adherent ORDER BY idcategorie";
                        break;
                    case 2:
                        $selectQuery = "SELECT * FROM adherent ORDER BY nomadherent";
                        break;
                    case 3:
                        $selectQuery = "SELECT * FROM adherent ORDER BY prenomadherent";
                        break;
                    case 4:
                        $selectQuery = "SELECT * FROM adherent ORDER BY emailadherent";
                        break;
                }
            }

            $raw = $connexion->query($selectQuery);
            $result = $raw->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                switch($row['idcategorie']) {
                    case 1:
                        $cat = "- 12 ans";
                        break;
                    case 2:
                        $cat = "12 à 16 ans";
                        break;
                    case 3:
                        $cat = "16 à 18 ans";
                        break;
                    case 4:
                        $cat = "+ 18 ans";
                        break;
                }
                echo "<tr><td>" . $cat . "</td><td>" . $row['nomadherent'] . "</td><td>" . $row['prenomadherent'] . "</td><td>" . $row['emailadherent'] . "</td><td><button type='submit' class='bouton'>Modifier</button><button type='submit' class='bouton'>Supprimer</button></td></tr>";
            }
        }

        function getStats() {
            $moyage = 0;
            $compteur = 0;
            $minage = 200;
            $maxage = 0;
            $departement = array();
            $dep = 0;
            $nb = 0;

            require_once('php/PDO.php');
            $connexion = DBConnection('ppe2_doublage');

            $selectQuery = "SELECT * FROM adherent";

            $raw = $connexion->query($selectQuery);
            $result = $raw->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $age = floor((time() - strtotime($row['datenaissadherent'])) / 31556926);

                $moyage += $age;
                $compteur+=1;
                if(substr($row['codepostal'], 0, 2) != "") {
                    $departement[] = substr($row['codepostal'], 0, 2);
                }

                if($age > $maxage) {
                    $maxage = $age;
                }
                if($age < $minage) {
                    $minage = $age;
                }
            }

            for($i = 0; $i < count($departement); $i++) {
                if(count(array_keys($departement, $departement[$i])) > $nb) {
                    $dep = $departement[$i];
                    $nb = count(array_keys($departement, $departement[$i]));
                }
            }

            echo "<p>La moyenne d'âge de tous les adhérents est de " . $moyage / $compteur . " ans.</p>";
            echo "<p>L'adhérent le plus jeune a  " . $minage . " ans.</p>";
            echo "<p>L'adhérent le plus vieux a  " . $maxage . " ans.</p>";
            echo "<p>Le département comportant le plus d'adhérents est le " . $dep . ".</p>";
        }
    ?>