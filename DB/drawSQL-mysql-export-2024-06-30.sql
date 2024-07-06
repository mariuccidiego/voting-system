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
    `descrizione` VARCHAR(255) NOT NULL,
    `sesso` BOOLEAN NOT NULL
);
CREATE TABLE `voto_pesato`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `peso_voto` BIGINT NOT NULL
);
CREATE TABLE `sezione`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `caratteristiche` TEXT NOT NULL
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
CREATE TABLE `candidato_di_lista`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `cognome` VARCHAR(255) NOT NULL,
    `sesso` BOOLEAN NOT NULL
);
CREATE TABLE `votante`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user` VARCHAR(255) NOT NULL,
    `pwd` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `ruolo` ENUM('') NOT NULL
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
CREATE TABLE `votante_sezione`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY
);
CREATE TABLE `tipo_votazione`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `tipo` ENUM(
        'solo_candidato',
        'candidato_lista',
        'completo'
    ) NOT NULL
);
CREATE TABLE `lista`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY
);
CREATE TABLE `risposta_testo`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `testo` TEXT NOT NULL
);
CREATE TABLE `voto_candidato_di_lista`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY
);
CREATE TABLE `impostazioni`(
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
    `scheda_bianca` BOOLEAN NOT NULL,
    `voto_per_sesso` BOOLEAN NOT NULL,
    `risposta_testo_libero` BOOLEAN NOT NULL,
    `voto_a_sezione` BOOLEAN NOT NULL,
    `archiviata` BOOLEAN NOT NULL
);
ALTER TABLE
    `votante_sezione` ADD CONSTRAINT `votante_sezione_id_foreign` FOREIGN KEY(`id`) REFERENCES `sezione`(`id`);
ALTER TABLE
    `voto_candidato_di_lista` ADD CONSTRAINT `voto_candidato_di_lista_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);
ALTER TABLE
    `voto_candidato` ADD CONSTRAINT `voto_candidato_id_foreign` FOREIGN KEY(`id`) REFERENCES `candidato`(`id`);
ALTER TABLE
    `votante` ADD CONSTRAINT `votante_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione-votanti`(`id`);
ALTER TABLE
    `voto_lista` ADD CONSTRAINT `voto_lista_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);
ALTER TABLE
    `voto_candidato` ADD CONSTRAINT `voto_candidato_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);
ALTER TABLE
    `delega` ADD CONSTRAINT `delega_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);
ALTER TABLE
    `risposta_testo` ADD CONSTRAINT `risposta_testo_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);
ALTER TABLE
    `candidato_di_lista` ADD CONSTRAINT `candidato_di_lista_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);
ALTER TABLE
    `votazione` ADD CONSTRAINT `votazione_id_foreign` FOREIGN KEY(`id`) REFERENCES `tipo_votazione`(`id`);
ALTER TABLE
    `votante_sezione` ADD CONSTRAINT `votante_sezione_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);
ALTER TABLE
    `voto_candidato_di_lista` ADD CONSTRAINT `voto_candidato_di_lista_id_foreign` FOREIGN KEY(`id`) REFERENCES `candidato_di_lista`(`id`);
ALTER TABLE
    `votazione` ADD CONSTRAINT `votazione_id_foreign` FOREIGN KEY(`id`) REFERENCES `amministratore`(`username`);
ALTER TABLE
    `candidato_di_lista` ADD CONSTRAINT `candidato_di_lista_id_foreign` FOREIGN KEY(`id`) REFERENCES `lista`(`id`);
ALTER TABLE
    `voto_candidato_di_lista` ADD CONSTRAINT `voto_candidato_di_lista_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);
ALTER TABLE
    `voto_lista` ADD CONSTRAINT `voto_lista_id_foreign` FOREIGN KEY(`id`) REFERENCES `lista`(`id`);
ALTER TABLE
    `candidato` ADD CONSTRAINT `candidato_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);
ALTER TABLE
    `risposta_testo` ADD CONSTRAINT `risposta_testo_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);
ALTER TABLE
    `lista` ADD CONSTRAINT `lista_id_foreign` FOREIGN KEY(`id`) REFERENCES `candidato`(`id`);
ALTER TABLE
    `voto_pesato` ADD CONSTRAINT `voto_pesato_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);
ALTER TABLE
    `lista_votanti` ADD CONSTRAINT `lista_votanti_id_foreign` FOREIGN KEY(`id`) REFERENCES `amministratore`(`username`);
ALTER TABLE
    `delega` ADD CONSTRAINT `delega_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);
ALTER TABLE
    `lista_votanti` ADD CONSTRAINT `lista_votanti_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);
ALTER TABLE
    `amministratore` ADD CONSTRAINT `amministratore_username_foreign` FOREIGN KEY(`username`) REFERENCES `impostazioni`(`id`);
ALTER TABLE
    `votazione-votanti` ADD CONSTRAINT `votazione_votanti_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);
ALTER TABLE
    `voto_lista` ADD CONSTRAINT `voto_lista_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);
ALTER TABLE
    `voto_candidato` ADD CONSTRAINT `voto_candidato_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);
ALTER TABLE
    `votante` ADD CONSTRAINT `votante_email_foreign` FOREIGN KEY(`email`) REFERENCES `voto_pesato`(`id`);
ALTER TABLE
    `lista` ADD CONSTRAINT `lista_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);
ALTER TABLE
    `delega` ADD CONSTRAINT `delega_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);