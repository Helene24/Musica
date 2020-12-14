<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201204112634 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD id_commercial_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455C67CD679 FOREIGN KEY (id_commercial_id) REFERENCES commercial (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455C67CD679 ON client (id_commercial_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455C67CD679');
        $this->addSql('DROP INDEX UNIQ_C7440455C67CD679 ON client');
        $this->addSql('ALTER TABLE client DROP id_commercial_id');
    }
}
