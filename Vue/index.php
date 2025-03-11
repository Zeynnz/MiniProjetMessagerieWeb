<?php
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Messagerie</title>

</head>
<body>
<div class="sidebar">
    <h2>Conversations</h2>
        <button>Option 1</button>
        <button>Option 2</button>
        <button>Option 3</button>
    </div>

    <div class="chat-container">
        <div class="messages">
            <p class="textMess"><strong>Contact 1:</strong> Bonjour !</p>
            <p class="textMessU"><strong>Vous:</strong> Salut, comment ça va ?</p>
        </div>
        <div class="input-container">
            <button id="valider">Envoyer</button>
            <div class="pseudoInput">
                <label>
                    <input type="text" name="pseudo" placeholder="Pseudo ...">
                </label>
            </div>
        </div>

    </div>
</body>
</html>
