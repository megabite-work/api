<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240827123707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attribute_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attribute_entity_category (attribute_entity_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_408B17933C040DDB (attribute_entity_id), INDEX IDX_408B179312469DE2 (category_id), PRIMARY KEY(attribute_entity_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attribute_value (id INT AUTO_INCREMENT NOT NULL, attribute_id INT NOT NULL, value_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_FE4FBB82B6E62EFA (attribute_id), INDEX IDX_FE4FBB82F920BBA2 (value_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE value_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE web_attribute_value (id INT AUTO_INCREMENT NOT NULL, web_nomenclature_id INT NOT NULL, attribute_value_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_233F9A574DCFF56D (web_nomenclature_id), INDEX IDX_233F9A5765A22152 (attribute_value_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attribute_entity_category ADD CONSTRAINT FK_408B17933C040DDB FOREIGN KEY (attribute_entity_id) REFERENCES attribute_entity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE attribute_entity_category ADD CONSTRAINT FK_408B179312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE attribute_value ADD CONSTRAINT FK_FE4FBB82B6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute_entity (id)');
        $this->addSql('ALTER TABLE attribute_value ADD CONSTRAINT FK_FE4FBB82F920BBA2 FOREIGN KEY (value_id) REFERENCES value_entity (id)');
        $this->addSql('ALTER TABLE web_attribute_value ADD CONSTRAINT FK_233F9A574DCFF56D FOREIGN KEY (web_nomenclature_id) REFERENCES web_nomenclature (id)');
        $this->addSql('ALTER TABLE web_attribute_value ADD CONSTRAINT FK_233F9A5765A22152 FOREIGN KEY (attribute_value_id) REFERENCES attribute_value (id)');
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
        $this->addSql('ALTER TABLE attribute_entity_category DROP FOREIGN KEY FK_408B17933C040DDB');
        $this->addSql('ALTER TABLE attribute_entity_category DROP FOREIGN KEY FK_408B179312469DE2');
        $this->addSql('ALTER TABLE attribute_value DROP FOREIGN KEY FK_FE4FBB82B6E62EFA');
        $this->addSql('ALTER TABLE attribute_value DROP FOREIGN KEY FK_FE4FBB82F920BBA2');
        $this->addSql('ALTER TABLE web_attribute_value DROP FOREIGN KEY FK_233F9A574DCFF56D');
        $this->addSql('ALTER TABLE web_attribute_value DROP FOREIGN KEY FK_233F9A5765A22152');
        $this->addSql('DROP TABLE attribute_entity');
        $this->addSql('DROP TABLE attribute_entity_category');
        $this->addSql('DROP TABLE attribute_value');
        $this->addSql('DROP TABLE value_entity');
        $this->addSql('DROP TABLE web_attribute_value');
        $this->addSql('ALTER TABLE cashbox_payment CHANGE amount amount NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
        $this->addSql('ALTER TABLE cashbox_detail CHANGE surrender surrender NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE sale sale NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE nds nds NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE advance advance NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE credit credit NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE remain remain NUMERIC(10, 2) DEFAULT \'0.00\'');
        $this->addSql('ALTER TABLE nomenclature CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL');
        $this->addSql('ALTER TABLE store_nomenclature CHANGE qty qty NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
        $this->addSql('ALTER TABLE cashbox_global CHANGE qty qty NUMERIC(10, 3) DEFAULT \'0.000\' NOT NULL, CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE nds_sum nds_sum NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE discount_sum discount_sum NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL');
        $this->addSql('ALTER TABLE counter_part CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
    }
}
