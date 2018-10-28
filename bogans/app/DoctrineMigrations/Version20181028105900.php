<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181028105900 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE gig ALTER COLUMN prefix VARCHAR(100) NULL');
        $this->addSql('ALTER TABLE gig ALTER COLUMN artist VARCHAR(100) NULL');
        $this->addSql('ALTER TABLE gig ALTER COLUMN url VARCHAR(255) NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE gig ALTER COLUMN prefix VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE gig ALTER COLUMN artist VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE gig ALTER COLUMN url VARCHAR(255) NOT NULL');
    }
}
