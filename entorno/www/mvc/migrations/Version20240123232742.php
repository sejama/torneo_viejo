<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123232742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partido (id INT AUTO_INCREMENT NOT NULL, cancha_id INT NOT NULL, zona_id INT NOT NULL, equipo_local_id INT DEFAULT NULL, equipo_visitante_id INT DEFAULT NULL, INDEX IDX_4E79750B7997F36E (cancha_id), INDEX IDX_4E79750B104EA8FC (zona_id), INDEX IDX_4E79750B88774E73 (equipo_local_id), INDEX IDX_4E79750B8C243011 (equipo_visitante_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partido ADD CONSTRAINT FK_4E79750B7997F36E FOREIGN KEY (cancha_id) REFERENCES cancha (id)');
        $this->addSql('ALTER TABLE partido ADD CONSTRAINT FK_4E79750B104EA8FC FOREIGN KEY (zona_id) REFERENCES zona (id)');
        $this->addSql('ALTER TABLE partido ADD CONSTRAINT FK_4E79750B88774E73 FOREIGN KEY (equipo_local_id) REFERENCES equipo (id)');
        $this->addSql('ALTER TABLE partido ADD CONSTRAINT FK_4E79750B8C243011 FOREIGN KEY (equipo_visitante_id) REFERENCES equipo (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partido DROP FOREIGN KEY FK_4E79750B7997F36E');
        $this->addSql('ALTER TABLE partido DROP FOREIGN KEY FK_4E79750B104EA8FC');
        $this->addSql('ALTER TABLE partido DROP FOREIGN KEY FK_4E79750B88774E73');
        $this->addSql('ALTER TABLE partido DROP FOREIGN KEY FK_4E79750B8C243011');
        $this->addSql('DROP TABLE partido');
    }
}
