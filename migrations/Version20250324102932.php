<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250324102932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id SERIAL NOT NULL, title VARCHAR(255) NOT NULL, content TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE event_choice (id SERIAL NOT NULL, base_event_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, effect JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F3322DC03B1C4B73 ON event_choice (base_event_id)');
        $this->addSql('CREATE TABLE event_situation (id SERIAL NOT NULL, base_event_id INT DEFAULT NULL, progress INT NOT NULL, defaut_progress INT NOT NULL, max_progress INT NOT NULL, effect JSON NOT NULL, dead_line INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6AB8A4F73B1C4B73 ON event_situation (base_event_id)');
        $this->addSql('CREATE TABLE event_situation_approach (id SERIAL NOT NULL, event_situation_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, cost JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7277A9FBD91BE25C ON event_situation_approach (event_situation_id)');
        $this->addSql('ALTER TABLE event_choice ADD CONSTRAINT FK_F3322DC03B1C4B73 FOREIGN KEY (base_event_id) REFERENCES event (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_situation ADD CONSTRAINT FK_6AB8A4F73B1C4B73 FOREIGN KEY (base_event_id) REFERENCES event (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_situation_approach ADD CONSTRAINT FK_7277A9FBD91BE25C FOREIGN KEY (event_situation_id) REFERENCES event_situation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE event_choice DROP CONSTRAINT FK_F3322DC03B1C4B73');
        $this->addSql('ALTER TABLE event_situation DROP CONSTRAINT FK_6AB8A4F73B1C4B73');
        $this->addSql('ALTER TABLE event_situation_approach DROP CONSTRAINT FK_7277A9FBD91BE25C');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_choice');
        $this->addSql('DROP TABLE event_situation');
        $this->addSql('DROP TABLE event_situation_approach');
    }
}
