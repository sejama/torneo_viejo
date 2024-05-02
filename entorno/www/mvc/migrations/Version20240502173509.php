<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240502173509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tercero_cuarto (id INT AUTO_INCREMENT NOT NULL, partido1_id INT NOT NULL, play_off_id INT NOT NULL, UNIQUE INDEX UNIQ_F8CD32801A71DF68 (partido1_id), UNIQUE INDEX UNIQ_F8CD32801B790A7C (play_off_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE triangular (id INT AUTO_INCREMENT NOT NULL, partido1_id INT NOT NULL, partido2_id INT NOT NULL, partido3_id INT NOT NULL, play_off_id INT NOT NULL, UNIQUE INDEX UNIQ_E635B76D1A71DF68 (partido1_id), UNIQUE INDEX UNIQ_E635B76D8C47086 (partido2_id), UNIQUE INDEX UNIQ_E635B76DB07817E3 (partido3_id), INDEX IDX_E635B76D1B790A7C (play_off_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tercero_cuarto ADD CONSTRAINT FK_F8CD32801A71DF68 FOREIGN KEY (partido1_id) REFERENCES partido (id)');
        $this->addSql('ALTER TABLE tercero_cuarto ADD CONSTRAINT FK_F8CD32801B790A7C FOREIGN KEY (play_off_id) REFERENCES play_off (id)');
        $this->addSql('ALTER TABLE triangular ADD CONSTRAINT FK_E635B76D1A71DF68 FOREIGN KEY (partido1_id) REFERENCES partido (id)');
        $this->addSql('ALTER TABLE triangular ADD CONSTRAINT FK_E635B76D8C47086 FOREIGN KEY (partido2_id) REFERENCES partido (id)');
        $this->addSql('ALTER TABLE triangular ADD CONSTRAINT FK_E635B76DB07817E3 FOREIGN KEY (partido3_id) REFERENCES partido (id)');
        $this->addSql('ALTER TABLE triangular ADD CONSTRAINT FK_E635B76D1B790A7C FOREIGN KEY (play_off_id) REFERENCES play_off (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tercero_cuarto DROP FOREIGN KEY FK_F8CD32801A71DF68');
        $this->addSql('ALTER TABLE tercero_cuarto DROP FOREIGN KEY FK_F8CD32801B790A7C');
        $this->addSql('ALTER TABLE triangular DROP FOREIGN KEY FK_E635B76D1A71DF68');
        $this->addSql('ALTER TABLE triangular DROP FOREIGN KEY FK_E635B76D8C47086');
        $this->addSql('ALTER TABLE triangular DROP FOREIGN KEY FK_E635B76DB07817E3');
        $this->addSql('ALTER TABLE triangular DROP FOREIGN KEY FK_E635B76D1B790A7C');
        $this->addSql('DROP TABLE tercero_cuarto');
        $this->addSql('DROP TABLE triangular');
    }
}
