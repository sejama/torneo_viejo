<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115183734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipo (id INT AUTO_INCREMENT NOT NULL, torneo_genero_categoria_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, INDEX IDX_C49C530BD7CF149E (torneo_genero_categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipo ADD CONSTRAINT FK_C49C530BD7CF149E FOREIGN KEY (torneo_genero_categoria_id) REFERENCES torneo_genero_categoria (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipo DROP FOREIGN KEY FK_C49C530BD7CF149E');
        $this->addSql('DROP TABLE equipo');
    }
}
