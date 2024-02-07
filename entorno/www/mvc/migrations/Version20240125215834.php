<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240125215834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partido ADD local_set1 INT DEFAULT NULL, ADD local_set2 INT DEFAULT NULL, ADD local_set3 INT DEFAULT NULL, ADD local_set4 INT DEFAULT NULL, ADD local_set5 INT DEFAULT NULL, ADD visitante_set1 INT DEFAULT NULL, ADD visitante_set2 INT DEFAULT NULL, ADD visitante_set3 INT DEFAULT NULL, ADD visitante_set4 INT DEFAULT NULL, ADD visitante_set5 INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partido DROP local_set1, DROP local_set2, DROP local_set3, DROP local_set4, DROP local_set5, DROP visitante_set1, DROP visitante_set2, DROP visitante_set3, DROP visitante_set4, DROP visitante_set5');
    }
}
