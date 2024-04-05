<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240405131608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ric_participant ADD adress VARCHAR(255) NOT NULL, ADD zip_code VARCHAR(10) NOT NULL, ADD school_level VARCHAR(150) NOT NULL, ADD prescriber VARCHAR(150) NOT NULL, ADD grade VARCHAR(50) NOT NULL, ADD is_got TINYINT(1) NOT NULL, ADD birth_city VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ric_participant DROP adress, DROP zip_code, DROP school_level, DROP prescriber, DROP grade, DROP is_got, DROP birth_city');
    }
}
