<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200228005537 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__follow AS SELECT id, created_at, follower_id, follwed_id FROM follow');
        $this->addSql('DROP TABLE follow');
        $this->addSql('CREATE TABLE follow (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_at DATETIME NOT NULL, follower_id INTEGER DEFAULT NULL, followed_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO follow (id, created_at, follower_id, followed_id) SELECT id, created_at, follower_id, follwed_id FROM __temp__follow');
        $this->addSql('DROP TABLE __temp__follow');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__follow AS SELECT id, created_at, follower_id, followed_id FROM follow');
        $this->addSql('DROP TABLE follow');
        $this->addSql('CREATE TABLE follow (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_at DATETIME NOT NULL, follower_id INTEGER DEFAULT NULL, follwed_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO follow (id, created_at, follower_id, follwed_id) SELECT id, created_at, follower_id, followed_id FROM __temp__follow');
        $this->addSql('DROP TABLE __temp__follow');
    }
}
