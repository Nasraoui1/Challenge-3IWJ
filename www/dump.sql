BEGIN;

-- Définir le fuseau horaire
SET TIME ZONE 'UTC';

-- Supprimer la table si elle existe
DROP TABLE IF EXISTS "chall_user";

-- Créer la table `chall_user`
CREATE TABLE IF NOT EXISTS "chall_user" (
                           id SERIAL PRIMARY KEY,
                           firstname VARCHAR(255) NOT NULL,
                           lastname VARCHAR(255) NOT NULL,
                           email VARCHAR(255) UNIQUE NOT NULL,
                           password VARCHAR(255),
                           id_role INT NOT NULL,
                           reset_token VARCHAR(255),
                           reset_expires TIMESTAMP,
                           activation_token VARCHAR(255),
                           birthday DATE,
                           creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
