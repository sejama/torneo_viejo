<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231117163906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE zona (id INT AUTO_INCREMENT NOT NULL, torneo_genero_categoria_id INT DEFAULT NULL, equipo_id INT DEFAULT NULL, INDEX IDX_A786041ED7CF149E (torneo_genero_categoria_id), UNIQUE INDEX UNIQ_A786041E23BFBED (equipo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE zona ADD CONSTRAINT FK_A786041ED7CF149E FOREIGN KEY (torneo_genero_categoria_id) REFERENCES torneo_genero_categoria (id)');
        $this->addSql('ALTER TABLE zona ADD CONSTRAINT FK_A786041E23BFBED FOREIGN KEY (equipo_id) REFERENCES equipo (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE zona DROP FOREIGN KEY FK_A786041ED7CF149E');
        $this->addSql('ALTER TABLE zona DROP FOREIGN KEY FK_A786041E23BFBED');
        $this->addSql('DROP TABLE zona');
    }
}
