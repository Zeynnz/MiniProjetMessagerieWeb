<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleForm.css">
    <title>Inscription</title>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Empêcher la soumission normale du formulaire
            document.getElementById("loginForm").addEventListener("submit", function(event) {
                event.preventDefault(); // Empêche le rechargement de la page
                inscrire();
            });

            // Optionnel : Permettre d'appuyer sur "Entrée" dans le champ mot de passe
            document.getElementById("password").addEventListener("keypress", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    inscrire();
                }
            });
        });

        function inscrire() {
            var identifiant = document.getElementById("identifiant").value;
            var pwd = document.getElementById("password").value;
            var pwd_confirm = document.getElementById("pwd_confirm").value;

            console.log("Identifiant:", identifiant);
            console.log("Mot de passe:", pwd);
            console.log("pwd_confirm:", pwd_confirm)

            if (identifiant === "" || pwd === "" || pwd_confirm === "") {
                alert("Veuillez remplir tous les champs.");
                return;
            }

            var formData = new FormData();
            formData.append("identifiant", identifiant);
            formData.append("pwd", pwd);
            formData.append("pwd_confirm", pwd_confirm)

            fetch("../PHP/inscriptionUser.php", {
                method: "POST",
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Inscription réussie !");
                        window.location.href = "accueil.php"; // Redirection
                    } else {
                        alert("Erreur d'inscription : " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Erreur AJAX :", error);
                    alert("Une erreur est survenue lors de l'inscription.");
                });
        }

    </script>

</head>

<body>
<div class="formulaire">
    <h2>Inscription</h2>

    <form id="loginForm">
        <div class="login">
            <label for="identifiant">Identifiant :</label>
            <input type="text" id="identifiant" name="identifiant" required>
        </div>

        <div class="pwd">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="pwd_confirm">
            <label for="pwd_confirm">Confirmer le mot de passe :</label>
            <input type="password" id="pwd_confirm" name="pwd_confirm" required>
        </div>

        <div class="button">
            <button type="submit" name="valider" class="valider">S'inscrire</button>
        </div>
    </form>

    <div class="retour">
        <a href="accueil.php"><button class="retour"> Annuler</button></a>
    </div>

</div>

</body>
</html>