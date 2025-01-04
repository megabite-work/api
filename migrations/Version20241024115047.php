<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241024115047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE permission (id INT AUTO_INCREMENT NOT NULL, name LONGTEXT NOT NULL, icon VARCHAR(255) DEFAULT NULL, resource VARCHAR(255) NOT NULL, action VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_permissions (user_id INT NOT NULL, permission_id INT NOT NULL, INDEX IDX_84F605FAA76ED395 (user_id), INDEX IDX_84F605FAFED90CCA (permission_id), PRIMARY KEY(user_id, permission_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_permissions ADD CONSTRAINT FK_84F605FAA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_permissions ADD CONSTRAINT FK_84F605FAFED90CCA FOREIGN KEY (permission_id) REFERENCES permission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cashbox_detail CHANGE surrender surrender NUMERIC(10, 2) DEFAULT \'0\', CHANGE sale sale NUMERIC(10, 2) DEFAULT \'0\', CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0\', CHANGE nds nds NUMERIC(10, 2) DEFAULT \'0\', CHANGE advance advance NUMERIC(10, 2) DEFAULT \'0\', CHANGE credit credit NUMERIC(10, 2) DEFAULT \'0\', CHANGE remain remain NUMERIC(10, 2) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE cashbox_global CHANGE qty qty NUMERIC(10, 3) DEFAULT \'0\' NOT NULL, CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE nds_sum nds_sum NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE discount_sum discount_sum NUMERIC(15, 3) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE cashbox_payment CHANGE amount amount NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE counter_part CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE delivery_settings CHANGE min_sum min_sum NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, CHANGE first_km first_km NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, CHANGE delivery_sum delivery_sum NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, CHANGE next_km_sum next_km_sum NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE nomenclature CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE store_nomenclature CHANGE qty qty NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user_permissions DROP FOREIGN KEY FK_84F605FAA76ED395');
        $this->addSql('ALTER TABLE user_permissions DROP FOREIGN KEY FK_84F605FAFED90CCA');
        $this->addSql('DROP TABLE permission');
        $this->addSql('DROP TABLE user_permissions');
        $this->addSql('ALTER TABLE cashbox_payment CHANGE amount amount NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
        $this->addSql('ALTER TABLE cashbox_detail CHANGE surrender surrender NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE sale sale NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE nds nds NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE advance advance NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE credit credit NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE remain remain NUMERIC(10, 2) DEFAULT \'0.00\'');
        $this->addSql('ALTER TABLE nomenclature CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL');
        $this->addSql('ALTER TABLE store_nomenclature CHANGE qty qty NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
        $this->addSql('ALTER TABLE delivery_settings CHANGE min_sum min_sum NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL, CHANGE first_km first_km NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL, CHANGE delivery_sum delivery_sum NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL, CHANGE next_km_sum next_km_sum NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
        $this->addSql('ALTER TABLE cashbox_global CHANGE qty qty NUMERIC(10, 3) DEFAULT \'0.000\' NOT NULL, CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE nds_sum nds_sum NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE discount_sum discount_sum NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL');
        $this->addSql('ALTER TABLE counter_part CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
    }
}
