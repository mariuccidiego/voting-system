CREATE TABLE `risultato`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `tipo_risultato` ENUM(
        'candidato',
        'lista',
        'candidati_di_lista',
        'proposta'
    ) NOT NULL,
    `n_voti` BIGINT NOT NULL,
    `data_ora` DATETIME NOT NULL
);
CREATE TABLE `lista_votanti`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `titolo` VARCHAR(255) NOT NULL,
    `descrizione` TEXT NULL
);
CREATE TABLE `voto_lista`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `data_ora` DATETIME NOT NULL
);
CREATE TABLE `candidato`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `descrizione` VARCHAR(255) NOT NULL,
    `sesso` BOOLEAN NULL,
    `immagine` VARCHAR(255) NULL
);
CREATE TABLE `voto_pesato`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `peso_voto` BIGINT NULL
);
CREATE TABLE `sezione`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `caratteristiche` TEXT NULL
);
CREATE TABLE `voto_candidato`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `data_ora` DATETIME NOT NULL
);
CREATE TABLE `delega`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY
);
CREATE TABLE `votazione-votanti`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `votato` BOOLEAN NOT NULL DEFAULT '0'
);
CREATE TABLE `candidato_di_lista`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `cognome` VARCHAR(255) NOT NULL,
    `sesso` BOOLEAN NULL,
    `immagine` VARCHAR(255) NULL
);
CREATE TABLE `votante`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user` VARCHAR(255) NOT NULL,
    `pwd` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `ruolo` VARCHAR(255) NULL,
    `cf` VARCHAR(255) NULL
);
CREATE TABLE `amministratore`(
    `username` VARCHAR(255) NOT NULL,
    `nome` VARCHAR(255) NULL,
    `cognome` VARCHAR(255) NULL,
    `email` CHAR(255) NOT NULL,
    `data_nascita` DATE NULL,
    `pwd` VARCHAR(255) NOT NULL,
    PRIMARY KEY(`username`)
);
CREATE TABLE `voto_proposta`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `data_ora` DATETIME NOT NULL
);
CREATE TABLE `lista_votanti_mm`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `titolo` VARCHAR(255) NOT NULL,
    `descrizione` TEXT NULL
);
CREATE TABLE `votante_sezione`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY
);
CREATE TABLE `tipo_votazione`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `tipo` ENUM(
        'solo_candidato',
        'candidato_lista',
        'lista',
        'lista_e_candidato',
        'completo',
        'a_proposta'
    ) NOT NULL
);
CREATE TABLE `lista`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `logo` VARCHAR(255) NULL,
    `descrizione` TEXT NULL
);
CREATE TABLE `proposta`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `titolo` VARCHAR(255) NOT NULL,
    `descrizione` TEXT NULL,
    `logo` VARCHAR(255) NULL
);
CREATE TABLE `risposta_testo`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `testo` TEXT NULL,
    `data_ora` DATETIME NOT NULL
);
CREATE TABLE `voto_candidato_di_lista`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `data_ora` DATETIME NOT NULL
);
CREATE TABLE `impostazioni`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `impostazioni` TEXT NULL
);
CREATE TABLE `votazione`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `codice_votazione` BIGINT NOT NULL,
    `titolo` VARCHAR(255) NOT NULL,
    `descrizione` TEXT NULL,
    `immagine` VARCHAR(255) NULL,
    `inizio_votazione` DATETIME NULL,
    `fine_votazione` DATETIME NULL,
    `voto_segreto` BOOLEAN NOT NULL DEFAULT '1',
    `voto_disgiunto` BOOLEAN NOT NULL DEFAULT '0',
    `voto_pesato` BOOLEAN NOT NULL DEFAULT '0',
    `voto_tramite_delega` BOOLEAN NOT NULL DEFAULT '0',
    `scheda_bianca` BOOLEAN NOT NULL DEFAULT '1',
    `voto_per_sesso` BOOLEAN NOT NULL DEFAULT '0',
    `risposta_testo_libero` BOOLEAN NOT NULL DEFAULT '0',
    `voto_a_sezione` BOOLEAN NOT NULL DEFAULT '0',
    `archiviata` BOOLEAN NOT NULL DEFAULT '0',
    `min_candidato` FLOAT(53) NOT NULL DEFAULT '0',
    `min_lista` FLOAT(53) NOT NULL DEFAULT '0',
    `min_candidato_lista` FLOAT(53) NOT NULL DEFAULT '0',
    `min_votanti` FLOAT(53) NOT NULL DEFAULT '0',
    `min_proposta` FLOAT(53) NOT NULL DEFAULT '0',
    `link` VARCHAR(255) NULL,
    `max_candidati` INT NOT NULL DEFAULT '1',
    `max_liste` INT NOT NULL DEFAULT '1',
    `max_candidati_lista` INT NOT NULL DEFAULT '1',
    `max_proposte` INT NOT NULL DEFAULT '1'
);
ALTER TABLE
    `risultato` ADD CONSTRAINT `risultato_id_foreign` FOREIGN KEY(`id`) REFERENCES `lista`(`id`);
ALTER TABLE
    `votante_sezione` ADD CONSTRAINT `votante_sezione_id_foreign` FOREIGN KEY(`id`) REFERENCES `sezione`(`id`);
ALTER TABLE
    `voto_candidato_di_lista` ADD CONSTRAINT `voto_candidato_di_lista_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);
ALTER TABLE
    `lista_votanti_mm` ADD CONSTRAINT `lista_votanti_mm_id_foreign` FOREIGN KEY(`id`) REFERENCES `lista_votanti`(`id`);
ALTER TABLE
    `voto_candidato` ADD CONSTRAINT `voto_candidato_id_foreign` FOREIGN KEY(`id`) REFERENCES `candidato`(`id`);
ALTER TABLE
    `votante` ADD CONSTRAINT `votante_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione-votanti`(`id`);
ALTER TABLE
    `voto_lista` ADD CONSTRAINT `voto_lista_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);
ALTER TABLE
    `risultato` ADD CONSTRAINT `risultato_id_foreign` FOREIGN KEY(`id`) REFERENCES `candidato_di_lista`(`id`);
ALTER TABLE
    `voto_candidato` ADD CONSTRAINT `voto_candidato_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);
ALTER TABLE
    `delega` ADD CONSTRAINT `delega_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);
ALTER TABLE
    `risposta_testo` ADD CONSTRAINT `risposta_testo_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);
ALTER TABLE
    `candidato_di_lista` ADD CONSTRAINT `candidato_di_lista_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);
ALTER TABLE
    `lista_votanti_mm` ADD CONSTRAINT `lista_votanti_mm_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);
ALTER TABLE
    `risultato` ADD CONSTRAINT `risultato_id_foreign` FOREIGN KEY(`id`) REFERENCES `candidato`(`id`);
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
    `risultato` ADD CONSTRAINT `risultato_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);
ALTER TABLE
    `voto_pesato` ADD CONSTRAINT `voto_pesato_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);
ALTER TABLE
    `voto_proposta` ADD CONSTRAINT `voto_proposta_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);
ALTER TABLE
    `lista_votanti` ADD CONSTRAINT `lista_votanti_id_foreign` FOREIGN KEY(`id`) REFERENCES `amministratore`(`username`);
ALTER TABLE
    `delega` ADD CONSTRAINT `delega_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);
ALTER TABLE
    `voto_proposta` ADD CONSTRAINT `voto_proposta_id_foreign` FOREIGN KEY(`id`) REFERENCES `proposta`(`id`);
ALTER TABLE
    `voto_pesato` ADD CONSTRAINT `voto_pesato_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);
ALTER TABLE
    `risultato` ADD CONSTRAINT `risultato_id_foreign` FOREIGN KEY(`id`) REFERENCES `proposta`(`id`);
ALTER TABLE
    `amministratore` ADD CONSTRAINT `amministratore_username_foreign` FOREIGN KEY(`username`) REFERENCES `impostazioni`(`id`);
ALTER TABLE
    `votazione-votanti` ADD CONSTRAINT `votazione_votanti_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);
ALTER TABLE
    `voto_lista` ADD CONSTRAINT `voto_lista_id_foreign` FOREIGN KEY(`id`) REFERENCES `votante`(`id`);
ALTER TABLE
    `voto_candidato` ADD CONSTRAINT `voto_candidato_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);
ALTER TABLE
    `proposta` ADD CONSTRAINT `proposta_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);
ALTER TABLE
    `lista` ADD CONSTRAINT `lista_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);
ALTER TABLE
    `delega` ADD CONSTRAINT `delega_id_foreign` FOREIGN KEY(`id`) REFERENCES `votazione`(`id`);