CREATE TABLE IF NOT EXISTS `document_types` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) UNIQUE NOT NULL,
    PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `job_titles` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) UNIQUE NOT NULL,
    PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `contract_types` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) UNIQUE NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `employees` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(60) NOT NULL,
    `document` VARCHAR(20) NOT NULL,
    `document_type_id` INT NOT NULL,
    `job_title_id` INT NOT NULL,
    `contract_type_id` INT NOT NULL,
    `hire_date` DATE NOT NULL,
    `status` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (`document_type_id`) REFERENCES `document_types`(`id`),
    FOREIGN KEY (`job_title_id`) REFERENCES `job_titles`(`id`),
    FOREIGN KEY (`contract_type_id`) REFERENCES `contract_types`(`id`)
) DEFAULT CHARSET=utf8mb4;

# Create initial data for document types
INSERT INTO `document_types` (`name`) VALUES
('Cédula de ciudadanía'),
('Tarjeta de identidad'),
('Cédula de extranjería');

# Create initial data for job titles
INSERT INTO `job_titles` (`name`) VALUES
('Médico General'),
('Auxiliar en salud'),
('Líder Médico');

# Create initial data for contract types
INSERT INTO `contract_types` (`name`) VALUES
('Indefinido'),
('Fijo'),
('Obra Labor'),
('Por prestación de servicios');
