<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211022100848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gigs ADD id INT AUTO_INCREMENT NOT NULL, ADD name VARCHAR(255) NOT NULL, ADD venue VARCHAR(255) NOT NULL, ADD prefix VARCHAR(255) NOT NULL, ADD web_link VARCHAR(255) NOT NULL, DROP event_name, DROP location, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gigs MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE gigs DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE gigs ADD event_name VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, ADD location VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, DROP id, DROP name, DROP venue, DROP prefix, DROP web_link');
        $this->addSql('ALTER TABLE gigs ADD PRIMARY KEY (event_name)');
    }
}
