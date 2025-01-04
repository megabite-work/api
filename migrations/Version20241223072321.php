<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241223072321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create web_event table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE web_event (id INT AUTO_INCREMENT NOT NULL, multi_store_id INT NOT NULL, title VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, type_ids VARCHAR(255) NOT NULL, animation VARCHAR(255) NOT NULL, move VARCHAR(255) NOT NULL, delay INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE web_event');
    }
}
