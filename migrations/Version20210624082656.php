<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210624082656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_2CCC2E2C6B01BC5B ON patients');
        $this->addSql('ALTER TABLE patients CHANGE phone_number phone_number VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patients CHANGE phone_number phone_number NUMERIC(13, 0) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2CCC2E2C6B01BC5B ON patients (phone_number)');
    }
}
