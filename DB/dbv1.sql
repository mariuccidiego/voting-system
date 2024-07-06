CREATE TABLE `amministratore` (
    `username` VARCHAR(255) NOT NULL,
    `nome` VARCHAR(255) NULL,
    `cognome` VARCHAR(255) NULL,
    `email` CHAR(255) NOT NULL,
    `data_nascita` DATE NULL,
    `pwd` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`username`)
);

CREATE TABLE `tipo_votazione` (
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

CREATE TABLE `votazione` (
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
    `max_proposte` INT NOT NULL DEFAULT '1',
    `tipo_votazione_id` BIGINT UNSIGNED,
    `amministratore_username` VARCHAR(255),
    CONSTRAINT `votazione_tipo_votazione_foreign` FOREIGN KEY (`tipo_votazione_id`) REFERENCES `tipo_votazione`(`id`),
    CONSTRAINT `votazione_amministratore_foreign` FOREIGN KEY (`amministratore_username`) REFERENCES `amministratore`(`username`)
);

CREATE TABLE `candidato` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `descrizione` VARCHAR(255) NOT NULL,
    `sesso` BOOLEAN NULL,
    `immagine` VARCHAR(255) NULL,
    `votazione_id` BIGINT UNSIGNED,
    CONSTRAINT `candidato_votazione_foreign` FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`)
);

CREATE TABLE `candidato_di_lista` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `cognome` VARCHAR(255) NOT NULL,
    `sesso` BOOLEAN NULL,
    `immagine` VARCHAR(255) NULL,
    `votazione_id` BIGINT UNSIGNED,
    `lista_id` BIGINT UNSIGNED,
    CONSTRAINT `candidato_di_lista_votazione_foreign` FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`),
    CONSTRAINT `candidato_di_lista_lista_foreign` FOREIGN KEY (`lista_id`) REFERENCES `lista`(`id`)
);

CREATE TABLE `delega` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `votante_id` BIGINT UNSIGNED,
    `votazione_id` BIGINT UNSIGNED,
    CONSTRAINT `delega_votante_foreign` FOREIGN KEY (`votante_id`) REFERENCES `votante`(`id`),
    CONSTRAINT `delega_votazione_foreign` FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`)
);

CREATE TABLE `impostazioni` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `impostazioni` TEXT NULL
);

CREATE TABLE `lista` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `logo` VARCHAR(255) NULL,
    `descrizione` TEXT NULL,
    `votazione_id` BIGINT UNSIGNED,
    CONSTRAINT `lista_votazione_foreign` FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`)
);

CREATE TABLE `lista_votanti` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `titolo` VARCHAR(255) NOT NULL,
    `descrizione` TEXT NULL,
    `amministratore_username` VARCHAR(255),
    CONSTRAINT `lista_votanti_amministratore_foreign` FOREIGN KEY (`amministratore_username`) REFERENCES `amministratore`(`username`)
);

CREATE TABLE `lista_votanti_mm` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `titolo` VARCHAR(255) NOT NULL,
    `descrizione` TEXT NULL,
    `lista_votanti_id` BIGINT UNSIGNED,
    `votante_id` BIGINT UNSIGNED,
    CONSTRAINT `lista_votanti_mm_lista_votanti_foreign` FOREIGN KEY (`lista_votanti_id`) REFERENCES `lista_votanti`(`id`),
    CONSTRAINT `lista_votanti_mm_votante_foreign` FOREIGN KEY (`votante_id`) REFERENCES `votante`(`id`)
);

CREATE TABLE `proposta` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `titolo` VARCHAR(255) NOT NULL,
    `descrizione` TEXT NULL,
    `logo` VARCHAR(255) NULL,
    `votazione_id` BIGINT UNSIGNED,
    CONSTRAINT `proposta_votazione_foreign` FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`)
);

CREATE TABLE `risposta_testo` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `testo` TEXT NULL,
    `data_ora` DATETIME NOT NULL,
    `votazione_id` BIGINT UNSIGNED,
    `votante_id` BIGINT UNSIGNED,
    CONSTRAINT `risposta_testo_votazione_foreign` FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`),
    CONSTRAINT `risposta_testo_votante_foreign` FOREIGN KEY (`votante_id`) REFERENCES `votante`(`id`)
);

CREATE TABLE `risultato` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `tipo_risultato` ENUM(
        'candidato',
        'lista',
        'candidati_di_lista',
        'proposta'
    ) NOT NULL,
    `n_voti` BIGINT NOT NULL,
    `data_ora` DATETIME NOT NULL,
    `lista_id` BIGINT UNSIGNED,
    `candidato_id` BIGINT UNSIGNED,
    `candidato_di_lista_id` BIGINT UNSIGNED,
    `proposta_id` BIGINT UNSIGNED,
    `votazione_id` BIGINT UNSIGNED,
    CONSTRAINT `risultato_lista_foreign` FOREIGN KEY (`lista_id`) REFERENCES `lista`(`id`),
    CONSTRAINT `risultato_candidato_foreign` FOREIGN KEY (`candidato_id`) REFERENCES `candidato`(`id`),
    CONSTRAINT `risultato_candidato_di_lista_foreign` FOREIGN KEY (`candidato_di_lista_id`) REFERENCES `candidato_di_lista`(`id`),
    CONSTRAINT `risultato_proposta_foreign` FOREIGN KEY (`proposta_id`) REFERENCES `proposta`(`id`),
    CONSTRAINT `risultato_votazione_foreign` FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`)
);

CREATE TABLE `sezione` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `caratteristiche` TEXT NULL
);

CREATE TABLE `votante` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user` VARCHAR(255) NOT NULL,
    `pwd` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `ruolo` VARCHAR(255) NULL,
    `cf` VARCHAR(255) NULL,
    `votazione_votanti_id` BIGINT UNSIGNED,
    CONSTRAINT `votante_votazione_votanti_foreign` FOREIGN KEY (`votazione_votanti_id`) REFERENCES `votazione-votanti`(`id`)
);

CREATE TABLE `votante_sezione` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `votante_id` BIGINT UNSIGNED,
    `sezione_id` BIGINT UNSIGNED,
    CONSTRAINT `votante_sezione_votante_foreign` FOREIGN KEY (`votante_id`) REFERENCES `votante`(`id`),
    CONSTRAINT `votante_sezione_sezione_foreign` FOREIGN KEY (`sezione_id`) REFERENCES `sezione`(`id`)
);

CREATE TABLE `votazione-votanti` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `votato` BOOLEAN NOT NULL DEFAULT '0',
    `votazione_id` BIGINT UNSIGNED,
    CONSTRAINT `votazione_votanti_votazione_foreign` FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`)
);

CREATE TABLE `voto_candidato` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `data_ora` DATETIME NOT NULL,
    `candidato_id` BIGINT UNSIGNED,
    `votante_id` BIGINT UNSIGNED,
    `votazione_id` BIGINT UNSIGNED,
    CONSTRAINT `voto_candidato_candidato_foreign` FOREIGN KEY (`candidato_id`) REFERENCES `candidato`(`id`),
    CONSTRAINT `voto_candidato_votante_foreign` FOREIGN KEY (`votante_id`) REFERENCES `votante`(`id`),
    CONSTRAINT `voto_candidato_votazione_foreign` FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`)
);

CREATE TABLE `voto_candidato_di_lista` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `data_ora` DATETIME NOT NULL,
    `candidato_di_lista_id` BIGINT UNSIGNED,
    `votazione_id` BIGINT UNSIGNED,
    `votante_id` BIGINT UNSIGNED,
    CONSTRAINT `voto_candidato_di_lista_candidato_di_lista_foreign` FOREIGN KEY (`candidato_di_lista_id`) REFERENCES `candidato_di_lista`(`id`),
    CONSTRAINT `voto_candidato_di_lista_votazione_foreign` FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`),
    CONSTRAINT `voto_candidato_di_lista_votante_foreign` FOREIGN KEY (`votante_id`) REFERENCES `votante`(`id`)
);

CREATE TABLE `voto_lista` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `data_ora` DATETIME NOT NULL,
    `votazione_id` BIGINT UNSIGNED,
    `lista_id` BIGINT UNSIGNED,
    `votante_id` BIGINT UNSIGNED,
    CONSTRAINT `voto_lista_votazione_foreign` FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`),
    CONSTRAINT `voto_lista_lista_foreign` FOREIGN KEY (`lista_id`) REFERENCES `lista`(`id`),
    CONSTRAINT `voto_lista_votante_foreign` FOREIGN KEY (`votante_id`) REFERENCES `votante`(`id`)
);

CREATE TABLE `voto_pesato` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `peso_voto` BIGINT NULL,
    `votazione_id` BIGINT UNSIGNED,
    `votante_id` BIGINT UNSIGNED,
    CONSTRAINT `voto_pesato_votazione_foreign` FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`),
    CONSTRAINT `voto_pesato_votante_foreign` FOREIGN KEY (`votante_id`) REFERENCES `votante`(`id`)
);

CREATE TABLE `voto_proposta` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `data_ora` DATETIME NOT NULL,
    `votante_id` BIGINT UNSIGNED,
    `proposta_id` BIGINT UNSIGNED,
    CONSTRAINT `voto_proposta_votante_foreign` FOREIGN KEY (`votante_id`) REFERENCES `votante`(`id`),
    CONSTRAINT `voto_proposta_proposta_foreign` FOREIGN KEY (`proposta_id`) REFERENCES `proposta`(`id`)
);

-- Setting foreign key for amministratore table after impostazioni table is created
ALTER TABLE `amministratore` ADD CONSTRAINT `amministratore_username_foreign` FOREIGN KEY (`username`) REFERENCES `impostazioni`(`id`);
