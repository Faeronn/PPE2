function beginConnection() {
	var login = $("#loginC").val().trim();
	var pass = $("#passC").val().trim();

	$.ajax({
		url: "php/connexion.php",
		data: {
    		loginC: login,
    		passC: pass
		},
		type: "POST",
		success: function(rep) {
			if(rep > 0) {

            }
            else {
            	document.getElementById('statusLog').innerHTML = "Nom d'utilisateur ou Mot de Passe incorrect.";
            	document.getElementById('statusLog').style.color = "salmon";
            }
		},
		error: function (resultat, statut, erreur) {
		}
	});
}



function displayMenu(menu) {
	if(menu === "connexion") {
		document.getElementById('id02').style.display='none'
		document.getElementById('id01').style.display='block'
	}
	else {
		document.getElementById('id01').style.display='none'
		document.getElementById('id02').style.display='block'
	}
}

function checkUsername() {
	var login = $("#login").val().trim();
	if(login === "") {
		document.getElementById('isValid').innerHTML = "";
		return
	}

	$.ajax({
		url: "php/check.php",
		data:'login=' + login,
		type: "POST",
		success: function(rep) {
			if(rep > 0) {
				document.getElementById('isValid').innerHTML = "Le nom d'utilisateur n'est pas disponible.";
				document.getElementById('isValid').style.color = "salmon";

				document.getElementById('login').style.borderLeftColor = 'salmon';
				document.getElementById('login').style.borderLeftWidth = '3px';

				document.getElementById('submit').disabled = true;
            }
            else {
             	document.getElementById('isValid').innerHTML = "Le nom d'utilisateur est disponible.";
				document.getElementById('isValid').style.color = "#32CD32";

				document.getElementById('login').style.borderLeftColor = '';
				document.getElementById('login').style.borderLeftWidth = '';

				document.getElementById('submit').disabled = false;
            }
		},
		error: function (resultat, statut, erreur) {
			document.getElementById('isValid').innerHTML = erreur;
			document.getElementById('isValid').style.color = "salmon";
		}
	});
}

function checkPass() {
	if(document.getElementById('passVerif').value !== document.getElementById('pass').value) {
		document.getElementById('passVerif').style.borderLeftColor = 'salmon';
		document.getElementById('passVerif').style.borderLeftWidth = '3px';

		document.getElementById('submit').disabled = true;
	}
	else {
		document.getElementById('passVerif').style.borderLeftColor = '';
		document.getElementById('passVerif').style.borderLeftWidth = '';

		document.getElementById('submit').disabled = false;
	}
}

function calculTarif() {
	var pEnfants = document.getElementById('nbEnfants').value;
	var pAdos = document.getElementById('nbAdos').value;
	var pMoyen = document.getElementById('nbMoyen').value;
	var pAdultes = document.getElementById('nbAdultes').value;

	window.document.getElementById('prixEnfants').innerHTML = pEnfants*(50*0.7) + " €";
		window.document.getElementById('prixAdos').innerHTML = pAdos*(50*0.8) + " €";
	window.document.getElementById('prixMoyen').innerHTML = pMoyen*(50*0.9) + " €";
	window.document.getElementById('prixAdultes').innerHTML = pAdultes*50 + " €";
	window.document.getElementById('prixTotal').innerHTML = (pAdultes*50) + (pEnfants*(50*0.7)) + (pAdos*(50*0.8)) + (pMoyen*(50*0.9)) + " €";
}

function eraseData(elemID) {
	window.document.getElementById(elemID).value = 0;
	calculTarif();
}

function showInfos(nb) {
	switch(nb) {
		case 1:
			window.document.getElementById('info1').innerHTML = "Le Directeur Artistique choisit les acteurs qui doubleront le film, et les supervise.";
			break;
		case 2:
			window.document.getElementById('info2').innerHTML = "L'adaptateur modifie le texte original pour le synchroniser aux mouvement des levres d'un acteur.";
			break;
		case 3:
			window.document.getElementById('info3').innerHTML = "Le Doubleur joue en suivant la bande rythmique des dialogues.";
			break;
	}
}