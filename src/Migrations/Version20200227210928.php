<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200227210928 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE image_file (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, file_name CLOB DEFAULT NULL, file_size INTEGER NOT NULL, file CLOB DEFAULT NULL, updated_at DATETIME DEFAULT NULL, post_id INTEGER DEFAULT NULL)');
        $this->addSql('DROP TABLE uploaded_file');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE uploaded_file (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, file_name CLOB DEFAULT NULL COLLATE BINARY, file_size INTEGER NOT NULL, file CLOB DEFAULT NULL COLLATE BINARY, updated_at DATETIME DEFAULT NULL, post_id INTEGER DEFAULT NULL)');
        $this->addSql('DROP TABLE image_file');
    }
}
