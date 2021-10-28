<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20211028091129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insert inital gig data';
    }

    public function up(Schema $schema): void
    {
        $gigs = [
            ['name' => 'Various Artists', 'date' => '2016-11-15', 'venue' => 'Rewind, Wrexham, UK', 'prefix' => ''],
            ['name' => 'Various Artists', 'date' => '2017-04-18', 'venue' => 'Helsinki, Finland', 'prefix' => ''],
            ['name' => 'Various Artists', 'date' => '2017-04-21', 'venue' => 'Hyvinkää, Finland', 'prefix' => ''],
            ['name' => 'Various Artists', 'date' => '2017-04-30', 'venue' => 'Comrades Club, Church St, Conwy', 'prefix' => ''],
            ['name' => 'Attic',           'date' => '2017-07-01', 'venue' => 'Ye Olde Salutation, Nottingham, UK', 'prefix' => 'With'],
            ['name' => 'Various Artists', 'date' => '2017-07-01', 'venue' => 'The Station, Ashton Under Lyne, UK', 'prefix' => ''],
            ['name' => 'Various Artists', 'date' => '2017-08-05', 'venue' => 'The Lock Keeper, Chester, UK', 'prefix' => ''],
            ['name' => 'Vice Squad',      'date' => '2017-09-09', 'venue' => 'Mcleans Pub, Deeside, UK', 'prefix' => 'Supporting'],
            ['name' => 'Various Artists', 'date' => '2017-10-05', 'venue' => 'The North, Rhyl, UK', 'prefix' => ''],
            ['name' => 'The Sex Pistols Experience', 'date' => '2017-10-20', 'venue' => 'Tivoli, Buckley, UK', 'prefix' => 'Supporting'],
            ['name' => 'The Sex Pistols Experience', 'date' => '2017-10-21', 'venue' => 'o2 Academy, Manchester, UK', 'prefix' => 'Supporting'],
        ];

        foreach ($gigs as $gig) {
            $this->addSql('INSERT INTO gigs(name, date, venue, prefix) VALUES (:name, :date, :venue, :prefix)', $gig);
        }
    }

    public function down(Schema $schema): void
    {
    }
}
