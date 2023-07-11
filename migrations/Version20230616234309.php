<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230616234309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create messenger_messages table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE messenger_messages (
            id INT AUTO_INCREMENT NOT NULL,
            created_at DATETIME NOT NULL,
            available_at DATETIME NOT NULL,
            delivered_at DATETIME DEFAULT NULL,
            PRIMARY KEY(id)
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE messenger_messages');
    }
}

