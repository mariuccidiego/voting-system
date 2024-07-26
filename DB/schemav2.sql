CREATE TABLE `amministratore` (
    `username` VARCHAR(255) NOT NULL PRIMARY KEY,
    `nome` VARCHAR(255) NULL,
    `cognome` VARCHAR(255) NULL,
    `email` CHAR(255) NOT NULL,
    `data_nascita` DATE NULL,
    `pwd` VARCHAR(255) NOT NULL
);

CREATE TABLE `tipo_votazione` (
    `id` BIGINT UNSIGNED NOT NULL PRIMARY KEY,
    `tipo` VARCHAR(255) NOT NULL
);

CREATE TABLE `votazione` (
    `id` BIGINT UNSIGNED NOT NULL PRIMARY KEY,
    `codice_votazione` BIGINT UNIQUE NULL,
    `titolo` VARCHAR(255) NOT NULL,
    `descrizione` TEXT NULL,
    `immagine` VARCHAR(255) NULL,
    `inizio_votazione` DATETIME NULL,
    `fine_votazione` DATETIME NULL,
    `voto_segreto` BOOLEAN NOT NULL DEFAULT '1',
    `voto_disgiunto` BOOLEAN NOT NULL DEFAULT '0',
    `voto_pesato` BOOLEAN NOT NULL DEFAULT '0',
    `voto_tramite_delega` BOOLEAN NOT NULL DEFAULT '0',
    `scheda_bianca` BOOLEAN NOT NULL DEFAULT '0',
    `voto_per_sesso` BOOLEAN NOT NULL DEFAULT '0',
    `risposta_testo_libero` BOOLEAN NOT NULL DEFAULT '0',
    `voto_a_sezione` BOOLEAN NOT NULL DEFAULT '0',
    `archiviata` BOOLEAN NOT NULL DEFAULT '0',
    `min_candidati` INT NOT NULL DEFAULT '1',
    `min_liste` INT NOT NULL DEFAULT '1',
    `min_candidati_lista` INT NOT NULL DEFAULT '1',
    `min_proposte` INT NOT NULL DEFAULT '1',
    `max_candidati` INT NOT NULL DEFAULT '1',
    `max_liste` INT NOT NULL DEFAULT '1',
    `max_candidati_lista` INT NOT NULL DEFAULT '1',
    `max_proposte` INT NOT NULL DEFAULT '1',
    `link` VARCHAR(255) NULL,
    `tipo_votazione_id` BIGINT UNSIGNED,
    `amministratore_username` VARCHAR(255),
    FOREIGN KEY (`tipo_votazione_id`) REFERENCES `tipo_votazione`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`amministratore_username`) REFERENCES `amministratore`(`username`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `votante` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NULL,
    `cognome` VARCHAR(255) NULL,
    `username` VARCHAR(255) UNIQUE NOT NULL,
    `pwd` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `ruolo` VARCHAR(255) NULL,
    `cf` VARCHAR(255) NULL,
    `peso_voto` BIGINT NOT NULL DEFAULT 1,
    `votato` BOOLEAN NOT NULL,
    `votazione_id` BIGINT UNSIGNED,
    FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `delega` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `votante_da_id` BIGINT UNSIGNED,
    `votante_a_id` BIGINT UNSIGNED,
    `votazione_id` BIGINT UNSIGNED,
    FOREIGN KEY (`votante_da_id`) REFERENCES `votante`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`votante_a_id`) REFERENCES `votante`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `candidato` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `descrizione` VARCHAR(255) NOT NULL,
    `sesso` BOOLEAN NULL,
    `immagine` VARCHAR(255) NULL,
    `votazione_id` BIGINT UNSIGNED,
    FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `lista` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `logo` VARCHAR(255) NULL,
    `descrizione` TEXT NULL,
    `votazione_id` BIGINT UNSIGNED,
    `candidato_id` BIGINT UNSIGNED,
    FOREIGN KEY (`candidato_id`) REFERENCES `candidato`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `candidato_di_lista` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `cognome` VARCHAR(255) NOT NULL,
    `sesso` BOOLEAN NULL,
    `immagine` VARCHAR(255) NULL,
    `votazione_id` BIGINT UNSIGNED,
    `lista_id` BIGINT UNSIGNED,
    FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`lista_id`) REFERENCES `lista`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `proposta` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `titolo` VARCHAR(255) NOT NULL,
    `descrizione` TEXT NULL,
    `logo` VARCHAR(255) NULL,
    `votazione_id` BIGINT UNSIGNED,
    FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `risposta_testo` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `testo` TEXT NULL,
    `data_ora` DATETIME NOT NULL,
    `votazione_id` BIGINT UNSIGNED,
    `votante_id` BIGINT UNSIGNED,
    FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`votante_id`) REFERENCES `votante`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `voto_candidato` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `data_ora` DATETIME NOT NULL,
    `candidato_id` BIGINT UNSIGNED,
    `votante_id` BIGINT UNSIGNED,
    `votazione_id` BIGINT UNSIGNED,
    FOREIGN KEY (`candidato_id`) REFERENCES `candidato`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`votante_id`) REFERENCES `votante`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `voto_lista` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `data_ora` DATETIME NOT NULL,
    `votazione_id` BIGINT UNSIGNED,
    `lista_id` BIGINT UNSIGNED,
    `votante_id` BIGINT UNSIGNED,
    FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`lista_id`) REFERENCES `lista`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`votante_id`) REFERENCES `votante`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `voto_candidato_di_lista` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `data_ora` DATETIME NOT NULL,
    `candidato_di_lista_id` BIGINT UNSIGNED,
    `votazione_id` BIGINT UNSIGNED,
    `votante_id` BIGINT UNSIGNED,
    FOREIGN KEY (`candidato_di_lista_id`) REFERENCES `candidato_di_lista`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`votante_id`) REFERENCES `votante`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `voto_proposta` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `data_ora` DATETIME NOT NULL,
    `votante_id` BIGINT UNSIGNED,
    `votazione_id` BIGINT UNSIGNED,
    `proposta_id` BIGINT UNSIGNED,
    FOREIGN KEY (`votante_id`) REFERENCES `votante`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`proposta_id`) REFERENCES `proposta`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
    FOREIGN KEY (`lista_id`) REFERENCES `lista`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`candidato_id`) REFERENCES `candidato`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`candidato_di_lista_id`) REFERENCES `candidato_di_lista`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`proposta_id`) REFERENCES `proposta`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`votazione_id`) REFERENCES `votazione`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);