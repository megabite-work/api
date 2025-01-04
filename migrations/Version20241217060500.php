<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241217060500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update wab banner table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE web_banner ADD title VARCHAR(255) NOT NULL, ADD description LONGTEXT NOT NULL, ADD devices LONGTEXT NOT NULL, ADD click_type VARCHAR(255) NOT NULL, ADD click_max INT NOT NULL, ADD click_current INT NOT NULL, ADD view_type VARCHAR(255) NOT NULL, ADD view_max INT NOT NULL, ADD view_current INT NOT NULL, ADD begin_at DATETIME NOT NULL, ADD end_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE web_banner DROP title, DROP description, DROP devices, DROP click_type, DROP click_max, DROP click_current, DROP view_type, DROP view_max, DROP view_current, DROP begin_at, DROP end_at');
    }
}
