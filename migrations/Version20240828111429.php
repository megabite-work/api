<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240828111429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client_article_attribute (id INT AUTO_INCREMENT NOT NULL, multi_store_id INT NOT NULL, article VARCHAR(255) NOT NULL, attribute VARCHAR(255) NOT NULL, INDEX IDX_A045DCE7B4D9FBF (multi_store_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_article_attribute_value (id INT AUTO_INCREMENT NOT NULL, attribute_id INT NOT NULL, web_nomenclature_id INT NOT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_FEDBD297B6E62EFA (attribute_id), INDEX IDX_FEDBD2974DCFF56D (web_nomenclature_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_article_attribute ADD CONSTRAINT FK_A045DCE7B4D9FBF FOREIGN KEY (multi_store_id) REFERENCES multi_store (id)');
        $this->addSql('ALTER TABLE client_article_attribute_value ADD CONSTRAINT FK_FEDBD297B6E62EFA FOREIGN KEY (attribute_id) REFERENCES client_article_attribute (id)');
        $this->addSql('ALTER TABLE client_article_attribute_value ADD CONSTRAINT FK_FEDBD2974DCFF56D FOREIGN KEY (web_nomenclature_id) REFERENCES web_nomenclature (id)');
        $this->addSql('ALTER TABLE article_attribute CHANGE article article VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE cashbox_detail CHANGE surrender surrender NUMERIC(10, 2) DEFAULT \'0\', CHANGE sale sale NUMERIC(10, 2) DEFAULT \'0\', CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0\', CHANGE nds nds NUMERIC(10, 2) DEFAULT \'0\', CHANGE advance advance NUMERIC(10, 2) DEFAULT \'0\', CHANGE credit credit NUMERIC(10, 2) DEFAULT \'0\', CHANGE remain remain NUMERIC(10, 2) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE cashbox_global CHANGE qty qty NUMERIC(10, 3) DEFAULT \'0\' NOT NULL, CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE nds_sum nds_sum NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE discount_sum discount_sum NUMERIC(15, 3) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE cashbox_payment CHANGE amount amount NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE counter_part CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE nomenclature CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE store_nomenclature CHANGE qty qty NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE web_nomenclature CHANGE article article VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_article_attribute DROP FOREIGN KEY FK_A045DCE7B4D9FBF');
        $this->addSql('ALTER TABLE client_article_attribute_value DROP FOREIGN KEY FK_FEDBD297B6E62EFA');
        $this->addSql('ALTER TABLE client_article_attribute_value DROP FOREIGN KEY FK_FEDBD2974DCFF56D');
        $this->addSql('DROP TABLE client_article_attribute');
        $this->addSql('DROP TABLE client_article_attribute_value');
        $this->addSql('ALTER TABLE cashbox_payment CHANGE amount amount NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
        $this->addSql('ALTER TABLE cashbox_detail CHANGE surrender surrender NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE sale sale NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE nds nds NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE advance advance NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE credit credit NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE remain remain NUMERIC(10, 2) DEFAULT \'0.00\'');
        $this->addSql('ALTER TABLE nomenclature CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL');
        $this->addSql('ALTER TABLE store_nomenclature CHANGE qty qty NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
        $this->addSql('ALTER TABLE article_attribute CHANGE article article BIGINT NOT NULL');
        $this->addSql('ALTER TABLE cashbox_global CHANGE qty qty NUMERIC(10, 3) DEFAULT \'0.000\' NOT NULL, CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE nds_sum nds_sum NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE discount_sum discount_sum NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL');
        $this->addSql('ALTER TABLE counter_part CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
        $this->addSql('ALTER TABLE web_nomenclature CHANGE article article BIGINT DEFAULT NULL');
    }
}
