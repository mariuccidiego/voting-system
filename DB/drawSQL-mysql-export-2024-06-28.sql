CREATE TABLE `lista_votanti`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `titolo` VARCHAR(255) NOT NULL,
    `descrizione` TEXT NOT NULL
);
CREATE TABLE `voto_lista`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY
);
CREATE TABLE `candidato`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `descrizione` VARCHAR(255) NOT NULL
);
CREATE TABLE `voto_candidato`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY
);
CREATE TABLE `delega`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY
);
CREATE TABLE `votazione-votanti`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY
);
CREATE TABLE `votante`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user` VARCHAR(255) NOT NULL,
    `pwd` VARCHAR(255) NOT NULL,
    `peso_voto` INT NOT NULL,
    `email` VARCHAR(255) NOT NULL
);
CREATE TABLE `amministratore`(
    `username` VARCHAR(255) NOT NULL,
    `nome` VARCHAR(255) NOT NULL,
    `cognome` VARCHAR(255) NOT NULL,
    `email` CHAR(255) NOT NULL,
    `data_nascita` DATE NOT NULL,
    `pwd` VARCHAR(255) NOT NULL,
    PRIMARY KEY(`username`)
);
CREATE TABLE `lista_candidato`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY
);
CREATE TABLE `votazione`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `codice_votazione` BIGINT NOT NULL,
    `titolo` VARCHAR(255) NOT NULL,
    `descrizione` TEXT NOT NULL,
    `logo` VARCHAR(255) NOT NULL,
    `inizio_votazione` DATETIME NOT NULL,
    `fine_votazione` DATETIME NOT NULL,
    `voto_segreto` BOOLEAN NOT NULL DEFAULT '1',
    `voto_disgiunto` BOOLEAN NOT NULL,
    `voto_pesato` BOOLEAN NOT NULL,
    `voto_tramite_delega` BOOLEAN NOT NULL,
    `scheda_bianca` BOOLEAN NOT NULL
);
ALTER TABLE
    `voto_candidato` ADD CONSTRAINT `voto_candidato_id_foreign` FOREIGN KEY(`id`) REFERENCES `candidato`(`id`);
ALTER TABLE
    `voto_candidato` ADD CONSTRAINT `voto_candidato_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);
ALTER TABLE
    `delega` ADD CONSTRAINT `delega_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);
ALTER TABLE
    `votazione-votanti` ADD CONSTRAINT `votazione_votanti_id_foreign` FOREIGN KEY(`id`) REFERENCES `lista_votanti`(`id`);
ALTER TABLE
    `votazione` ADD CONSTRAINT `votazione_id_foreign` FOREIGN KEY(`id`) REFERENCES `amministratore`(`username`);
ALTER TABLE
    `voto_lista` ADD CONSTRAINT `voto_lista_id_foreign` FOREIGN KEY(`id`) REFERENCES `lista_candidato`(`id`);
ALTER TABLE
    `candidato` ADD CONSTRAINT `candidato_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);
ALTER TABLE
    `lista_candidato` ADD CONSTRAINT `lista_candidato_id_foreign` FOREIGN KEY(`id`) REFERENCES `candidato`(`id`);
ALTER TABLE
    `lista_votanti` ADD CONSTRAINT `lista_votanti_id_foreign` FOREIGN KEY(`id`) REFERENCES `amministratore`(`username`);
ALTER TABLE
    `delega` ADD CONSTRAINT `delega_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);
ALTER TABLE
    `lista_votanti` ADD CONSTRAINT `lista_votanti_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);
ALTER TABLE
    `votazione-votanti` ADD CONSTRAINT `votazione_votanti_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);
ALTER TABLE
    `voto_lista` ADD CONSTRAINT `voto_lista_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);