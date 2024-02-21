<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220165348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cancha (id INT AUTO_INCREMENT NOT NULL, club_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_9D09C78261190A32 (club_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(64) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_4E10122D3A909126 (nombre), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, direccion VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipo (id INT AUTO_INCREMENT NOT NULL, torneo_genero_categoria_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_C49C530BD7CF149E (torneo_genero_categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genero (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(32) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_A000883A3A909126 (nombre), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partido (id INT AUTO_INCREMENT NOT NULL, cancha_id INT DEFAULT NULL, zona_id INT NOT NULL, equipo_local_id INT DEFAULT NULL, equipo_visitante_id INT DEFAULT NULL, local_set1 INT DEFAULT NULL, local_set2 INT DEFAULT NULL, local_set3 INT DEFAULT NULL, local_set4 INT DEFAULT NULL, local_set5 INT DEFAULT NULL, visitante_set1 INT DEFAULT NULL, visitante_set2 INT DEFAULT NULL, visitante_set3 INT DEFAULT NULL, visitante_set4 INT DEFAULT NULL, visitante_set5 INT DEFAULT NULL, horario DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_4E79750B7997F36E (cancha_id), INDEX IDX_4E79750B104EA8FC (zona_id), INDEX IDX_4E79750B88774E73 (equipo_local_id), INDEX IDX_4E79750B8C243011 (equipo_visitante_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE torneo (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, fecha_inicio DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', fecha_fin DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', fecha_inicio_inscripcion DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', fecha_fin_inscripcion DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE torneo_genero_categoria (id INT AUTO_INCREMENT NOT NULL, torneo_id INT DEFAULT NULL, genero_id INT DEFAULT NULL, categoria_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', cerrado TINYINT(1) NOT NULL, creado TINYINT(1) NOT NULL, INDEX IDX_D2F850FAA0139802 (torneo_id), INDEX IDX_D2F850FABCE7B795 (genero_id), INDEX IDX_D2F850FA3397707A (categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zona (id INT AUTO_INCREMENT NOT NULL, torneo_genero_categoria_id INT DEFAULT NULL, INDEX IDX_A786041ED7CF149E (torneo_genero_categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zona_equipo (id INT AUTO_INCREMENT NOT NULL, zona_id INT DEFAULT NULL, equipo_id INT DEFAULT NULL, INDEX IDX_7FC57583104EA8FC (zona_id), UNIQUE INDEX UNIQ_7FC5758323BFBED (equipo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cancha ADD CONSTRAINT FK_9D09C78261190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE equipo ADD CONSTRAINT FK_C49C530BD7CF149E FOREIGN KEY (torneo_genero_categoria_id) REFERENCES torneo_genero_categoria (id)');
        $this->addSql('ALTER TABLE partido ADD CONSTRAINT FK_4E79750B7997F36E FOREIGN KEY (cancha_id) REFERENCES cancha (id)');
        $this->addSql('ALTER TABLE partido ADD CONSTRAINT FK_4E79750B104EA8FC FOREIGN KEY (zona_id) REFERENCES zona (id)');
        $this->addSql('ALTER TABLE partido ADD CONSTRAINT FK_4E79750B88774E73 FOREIGN KEY (equipo_local_id) REFERENCES equipo (id)');
        $this->addSql('ALTER TABLE partido ADD CONSTRAINT FK_4E79750B8C243011 FOREIGN KEY (equipo_visitante_id) REFERENCES equipo (id)');
        $this->addSql('ALTER TABLE torneo_genero_categoria ADD CONSTRAINT FK_D2F850FAA0139802 FOREIGN KEY (torneo_id) REFERENCES torneo (id)');
        $this->addSql('ALTER TABLE torneo_genero_categoria ADD CONSTRAINT FK_D2F850FABCE7B795 FOREIGN KEY (genero_id) REFERENCES genero (id)');
        $this->addSql('ALTER TABLE torneo_genero_categoria ADD CONSTRAINT FK_D2F850FA3397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
        $this->addSql('ALTER TABLE zona ADD CONSTRAINT FK_A786041ED7CF149E FOREIGN KEY (torneo_genero_categoria_id) REFERENCES torneo_genero_categoria (id)');
        $this->addSql('ALTER TABLE zona_equipo ADD CONSTRAINT FK_7FC57583104EA8FC FOREIGN KEY (zona_id) REFERENCES zona (id)');
        $this->addSql('ALTER TABLE zona_equipo ADD CONSTRAINT FK_7FC5758323BFBED FOREIGN KEY (equipo_id) REFERENCES equipo (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cancha DROP FOREIGN KEY FK_9D09C78261190A32');
        $this->addSql('ALTER TABLE equipo DROP FOREIGN KEY FK_C49C530BD7CF149E');
        $this->addSql('ALTER TABLE partido DROP FOREIGN KEY FK_4E79750B7997F36E');
        $this->addSql('ALTER TABLE partido DROP FOREIGN KEY FK_4E79750B104EA8FC');
        $this->addSql('ALTER TABLE partido DROP FOREIGN KEY FK_4E79750B88774E73');
        $this->addSql('ALTER TABLE partido DROP FOREIGN KEY FK_4E79750B8C243011');
        $this->addSql('ALTER TABLE torneo_genero_categoria DROP FOREIGN KEY FK_D2F850FAA0139802');
        $this->addSql('ALTER TABLE torneo_genero_categoria DROP FOREIGN KEY FK_D2F850FABCE7B795');
        $this->addSql('ALTER TABLE torneo_genero_categoria DROP FOREIGN KEY FK_D2F850FA3397707A');
        $this->addSql('ALTER TABLE zona DROP FOREIGN KEY FK_A786041ED7CF149E');
        $this->addSql('ALTER TABLE zona_equipo DROP FOREIGN KEY FK_7FC57583104EA8FC');
        $this->addSql('ALTER TABLE zona_equipo DROP FOREIGN KEY FK_7FC5758323BFBED');
        $this->addSql('DROP TABLE cancha');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE equipo');
        $this->addSql('DROP TABLE genero');
        $this->addSql('DROP TABLE partido');
        $this->addSql('DROP TABLE torneo');
        $this->addSql('DROP TABLE torneo_genero_categoria');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE zona');
        $this->addSql('DROP TABLE zona_equipo');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
