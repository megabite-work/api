<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241219071222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create web_banner_setting tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE web_banner_setting (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, web_banner_ids VARCHAR(255) NOT NULL, animation VARCHAR(255) NOT NULL, move VARCHAR(255) NOT NULL, delay INT NOT NULL, speed INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE web_banner_setting');
    }
}
