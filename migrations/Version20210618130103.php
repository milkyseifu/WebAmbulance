<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210618130103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ambulance ADD hospital_id INT NOT NULL');
        $this->addSql('ALTER TABLE ambulance ADD CONSTRAINT FK_4F20B42E63DBB69 FOREIGN KEY (hospital_id) REFERENCES hospital (id)');
        $this->addSql('CREATE INDEX IDX_4F20B42E63DBB69 ON ambulance (hospital_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ambulance DROP FOREIGN KEY FK_4F20B42E63DBB69');
        $this->addSql('DROP INDEX IDX_4F20B42E63DBB69 ON ambulance');
        $this->addSql('ALTER TABLE ambulance DROP hospital_id');
    }
}
