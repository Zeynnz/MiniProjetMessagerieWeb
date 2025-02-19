CREATE TABLE
  `message` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `estampille` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `auteur` varchar(50) NOT NULL,
    `contenu` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

  