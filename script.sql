CREATE TABLE
  `message` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `estampille` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `auteur` varchar(50) NOT NULL,
    `contenu` TEXT NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

create TABLE `utilisateur` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    'identifiant' varchar(50) NOT NULL,
    'mdp' varchar(255) NOT NULL,
    primary key(`id`)
)