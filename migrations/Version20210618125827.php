<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210618125827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE drivers ADD ambulance_id INT NOT NULL');
        $this->addSql('ALTER TABLE drivers ADD CONSTRAINT FK_E410C307EF55E5E1 FOREIGN KEY (ambulance_id) REFERENCES ambulance (id)');
        $this->addSql('CREATE INDEX IDX_E410C307EF55E5E1 ON drivers (ambulance_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE drivers DROP FOREIGN KEY FK_E410C307EF55E5E1');
        $this->addSql('DROP INDEX IDX_E410C307EF55E5E1 ON drivers');
        $this->addSql('ALTER TABLE drivers DROP ambulance_id');
    }
}
