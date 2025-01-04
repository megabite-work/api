<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240824070431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE web_banner (id INT AUTO_INCREMENT NOT NULL, multi_store_id INT NOT NULL, type VARCHAR(255) NOT NULL, type_id INT NOT NULL, image VARCHAR(255) NOT NULL, is_active TINYINT(1) DEFAULT 1 NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_78E715A07B4D9FBF (multi_store_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE web_banner ADD CONSTRAINT FK_78E715A07B4D9FBF FOREIGN KEY (multi_store_id) REFERENCES multi_store (id)');
        $this->addSql('ALTER TABLE cashbox_detail CHANGE surrender surrender NUMERIC(10, 2) DEFAULT \'0\', CHANGE sale sale NUMERIC(10, 2) DEFAULT \'0\', CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0\', CHANGE nds nds NUMERIC(10, 2) DEFAULT \'0\', CHANGE advance advance NUMERIC(10, 2) DEFAULT \'0\', CHANGE credit credit NUMERIC(10, 2) DEFAULT \'0\', CHANGE remain remain NUMERIC(10, 2) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE cashbox_global CHANGE qty qty NUMERIC(10, 3) DEFAULT \'0\' NOT NULL, CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE nds_sum nds_sum NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE discount_sum discount_sum NUMERIC(15, 3) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE cashbox_payment CHANGE amount amount NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE counter_part CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE nomenclature CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE store_nomenclature CHANGE qty qty NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE web_banner DROP FOREIGN KEY FK_78E715A07B4D9FBF');
        $this->addSql('DROP TABLE web_banner');
        $this->addSql('ALTER TABLE cashbox_payment CHANGE amount amount NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
        $this->addSql('ALTER TABLE cashbox_detail CHANGE surrender surrender NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE sale sale NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE nds nds NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE advance advance NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE credit credit NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE remain remain NUMERIC(10, 2) DEFAULT \'0.00\'');
        $this->addSql('ALTER TABLE nomenclature CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL');
        $this->addSql('ALTER TABLE store_nomenclature CHANGE qty qty NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
        $this->addSql('ALTER TABLE cashbox_global CHANGE qty qty NUMERIC(10, 3) DEFAULT \'0.000\' NOT NULL, CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE nds_sum nds_sum NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE discount_sum discount_sum NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL');
        $this->addSql('ALTER TABLE counter_part CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
    }
}
