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
    <title>Connexion</title>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Empêche la soumission normale du formulaire
            document.getElementById("loginForm").addEventListener("submit", function(event) {
                event.preventDefault(); // Empêche le rechargement de la page
                connecter();
            });

            // Optionnel : Permettre d'appuyer sur "Entrée" dans le champ mot de passe
            document.getElementById("password").addEventListener("keypress", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    connecter();
                }
            });
        });

        function connecter() {
            var identifiant = document.getElementById("identifiant").value;
            var pwd = document.getElementById("password").value;

            console.log(identifiant);
            console.log(pwd);



            if (identifiant === "" || pwd === "") {
                alert("Veuillez remplir tous les champs.");
                return;
            }

            var formData = new FormData();
            formData.append("identifiant", identifiant);
            formData.append("pwd", pwd); // Correspond au `name="password"` du formulaire

            fetch("../PHP/connexionUser.php", {
                method: "POST",
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Connexion réussie !");
                        window.location.href = "../afficher.php"; // Redirection
                    } else {
                        alert("Erreur de connexion : " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Erreur AJAX :", error);
                    alert("Une erreur est survenue lors de la connexion.");
                });
        }
    </script>

</head>
<body>

<div class="formulaire">
    <h2>Connexion</h2>

    <form id="loginForm">
        <div class="login">
            <label for="identifiant">Identifiant :</label>
            <input type="text" id="identifiant" name="identifiant" required>
        </div>

        <div class="pwd">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="button">
            <button type="submit" name="valider" class="valider">Se connecter</button>
        </div>
    </form>

    <div class="inscription">
        <p>Pas encore de compte ?</p>
        <a href="inscription.php"><button class="inscrire">S'inscrire</button></a>
    </div>

</div>

</body>
</html>
