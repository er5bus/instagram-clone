<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200228004829 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE follow (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_at DATETIME NOT NULL, follower_id INTEGER DEFAULT NULL, follwed_id INTEGER DEFAULT NULL)');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE thread');
        $this->addSql('DROP INDEX UNIQ_5A8A6C8DE2904019');
        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, description, author_id FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, description CLOB DEFAULT NULL COLLATE BINARY, author_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO post (id, description, author_id) SELECT id, description, author_id FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL COLLATE BINARY, ancestors VARCHAR(1024) NOT NULL COLLATE BINARY, depth INTEGER NOT NULL, created_at DATETIME NOT NULL, state INTEGER NOT NULL, thread_id VARCHAR(255) DEFAULT NULL COLLATE BINARY, author_id INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE thread (id VARCHAR(255) NOT NULL COLLATE BINARY, permalink VARCHAR(255) NOT NULL COLLATE BINARY, is_commentable BOOLEAN NOT NULL, num_comments INTEGER NOT NULL, last_comment_at DATETIME DEFAULT NULL, post_id INTEGER DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE follow');
        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, description, author_id FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, description CLOB DEFAULT NULL, author_id INTEGER DEFAULT NULL, thread_id VARCHAR(255) DEFAULT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO post (id, description, author_id) SELECT id, description, author_id FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A8A6C8DE2904019 ON post (thread_id)');
    }
}
