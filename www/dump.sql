
-- Créer la table `chall_user`
CREATE TABLE IF NOT EXISTS "chall_users" (
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
CREATE TABLE IF NOT EXISTS "chall_page" (
                                            "id" SERIAL PRIMARY KEY,
                                            "title" VARCHAR(50) NOT NULL,
    "description" VARCHAR(350) NOT NULL,
    "content" VARCHAR NOT NULL,
    "user_id" INT NOT NULL,
    "slug" VARCHAR(20) UNIQUE NOT NULL,
    CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES chall_user(id),
    "date_inserted" TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "date_updated" TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    );
