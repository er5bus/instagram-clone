<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200227222226 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('ALTER TABLE comment ADD COLUMN author_id INTEGER DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__comment AS SELECT id, body, ancestors, depth, created_at, state, thread_id FROM comment');
        $this->addSql('DROP TABLE comment');
        $this->addSql('CREATE TABLE comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, ancestors VARCHAR(1024) NOT NULL, depth INTEGER NOT NULL, created_at DATETIME NOT NULL, state INTEGER NOT NULL, thread_id VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO comment (id, body, ancestors, depth, created_at, state, thread_id) SELECT id, body, ancestors, depth, created_at, state, thread_id FROM __temp__comment');
        $this->addSql('DROP TABLE __temp__comment');
    }
}
