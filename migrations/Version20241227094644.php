<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241227094644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update web_banner_setting and web_event table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE web_banner_setting CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE web_banner_ids web_banner_ids VARCHAR(255) DEFAULT NULL, CHANGE animation animation VARCHAR(255) DEFAULT NULL, CHANGE move move VARCHAR(255) DEFAULT NULL, CHANGE delay delay INT DEFAULT NULL, CHANGE speed speed INT DEFAULT NULL');
        $this->addSql('ALTER TABLE web_event CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE type type VARCHAR(255) DEFAULT NULL, CHANGE type_ids type_ids VARCHAR(255) DEFAULT NULL, CHANGE animation animation VARCHAR(255) DEFAULT NULL, CHANGE move move VARCHAR(255) DEFAULT NULL, CHANGE delay delay INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE web_banner_setting CHANGE title title VARCHAR(255) NOT NULL, CHANGE web_banner_ids web_banner_ids VARCHAR(255) NOT NULL, CHANGE animation animation VARCHAR(255) NOT NULL, CHANGE move move VARCHAR(255) NOT NULL, CHANGE delay delay INT NOT NULL, CHANGE speed speed INT NOT NULL');
        $this->addSql('ALTER TABLE web_event CHANGE title title VARCHAR(255) NOT NULL, CHANGE type type VARCHAR(255) NOT NULL, CHANGE type_ids type_ids VARCHAR(255) NOT NULL, CHANGE animation animation VARCHAR(255) NOT NULL, CHANGE move move VARCHAR(255) NOT NULL, CHANGE delay delay INT NOT NULL');
    }
}
