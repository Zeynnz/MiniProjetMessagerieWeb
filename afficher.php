<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
header('Content-Type: text/html; charset=UTF-8');

if (isset($_GET['action']) && $_GET['action'] === 'getSession') {
    echo json_encode(["user_id" => isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null]);
    exit;
}
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Vue/style.css">
    <title>Messagerie</title>

    <script>


        let userId = null;
        document.addEventListener("DOMContentLoaded", function() {
            checkSession()

            document.getElementById("valider").addEventListener("click", envoyer);
            document.getElementsByName("contenu")[0].addEventListener("keypress", function(event) {
                if (event.key === "Enter") {
                    envoyer();
                }
            });
            document.getElementById("logout").addEventListener("click", function() {
                fetch("PHP/deconnexion.php", { method: "POST" })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = "Vue/accueil.php"; // Redirection vers la page de connexion
                        } else {
                            alert("Erreur lors de la déconnexion !");
                        }
                    })
                    .catch(error => console.error("Erreur AJAX :", error));
            });
            recuperer();
            // Mettre à jour l'historique toutes les 5 secondes
            setInterval(recuperer, 5000);
        });


        function checkSession() {
            fetch("afficher.php?action=getSession")
                .then(response => response.json())
                .then(data => {
                    console.log("Données reçues :", data); // Vérifie la réponse JSON
                    if (data.user_id) {
                        userId = data.user_id;
                        let pseudoInput = document.getElementsByName("pseudo")[0];
                        console.log("Champ pseudo récupéré :", pseudoInput);

                        if (pseudoInput) {
                            pseudoInput.value = userId;
                            console.log("Valeur du champ pseudo mise à jour :", pseudoInput.value);
                        } else {
                            console.error("Champ pseudo introuvable !");
                        }
                    } else {
                        window.location.href = "Vue/accueil.php";
                        alert("Vous n'êtes pas connecté !");
                    }
                })
                .catch(error => console.error("Erreur AJAX :", error));
        }


        function envoyer() {
            var auteur = userId;
            var contenu = document.getElementsByName("contenu")[0].value.trim();

            if (contenu === "") {
                alert("Le message ne peut pas être vide !");
                return;
            }

            var formData = new FormData();
            formData.append("pseudo", auteur);
            formData.append("contenu", contenu);

            fetch("PHP/enregistre.php", {
                method: "POST",
                body: formData
            })
                .then(response => response.json()) // Convertir la réponse en JSON
                .then(data => {
                    if (data.success) {
                        console.log("Réponse du serveur :", data);
                        recuperer();
                        document.getElementsByName("contenu")[0].value = "";
                    } else {
                        console.error("Erreur lors de l'envoi :", data.message);
                        alert("Erreur : " + data.message); // Affiche l'erreur exacte
                    }
                })
                .catch(error => {
                    console.error("Erreur AJAX :", error);
                    alert("Une erreur réseau est survenue !");
                });
        }


        function recuperer() {
            fetch("PHP/recupere.php")  // Assure-toi que le chemin est correct
                .then(response => response.json())
                .then(messages => {
                    let messagesContainer = document.querySelector(".messages");
                    messagesContainer.innerHTML = ""; // Vide les anciens messages

                    //Récupère le pseudo de l'utilisateur connecté (si l'input existe)
                    let pseudoInput = document.getElementsByName("pseudo")[0];
                    let userPseudo = pseudoInput ? pseudoInput.value.trim() : "";

                    // Ajoute les messages en respectant l'ordre du plus ancien au plus récent
                    messages.reverse().forEach(msg => {
                        let messageElement = document.createElement("p");

                        //Si l'auteur est l'utilisateur, appliquer une classe différente
                        if (msg.auteur === userPseudo) {
                            messageElement.classList.add("textMessU"); // Message utilisateur
                        } else {
                        messageElement.classList.add("textMess"); // Message autre utilisateur
                        }

                        // Insérer le contenu du message
                        messageElement.innerHTML = `<strong>${msg.auteur}:</strong> ${msg.contenu}`;
                        messagesContainer.appendChild(messageElement);
                    });
                })
                .catch(error => {
                    console.error("Erreur lors de la récupération des messages :", error);
                });
        }



    </script>

</head>
<body>
<div class="sidebar">
    <h2>Conversations</h2>
    <button>Option 1</button>
    <button>Option 2</button>
    <button>Option 3</button>
    <button id="logout">Déconnexion</button>
</div>

<div class="chat-container">
    <div class="messages">
    </div>
    <div class="input-container">
        <button id="valider">Envoyer</button>
        <div class="pseudoInput">
            <label>
                <input type="text" name="pseudo" readonly>
            </label>
        </div>
        <div class="contenuInput">
            <label>
                <input type="text" name="contenu" id="contenu" placeholder="Entrez votre message ...">
            </label>
        </div>
    </div>

</div>
</body>
</html>
