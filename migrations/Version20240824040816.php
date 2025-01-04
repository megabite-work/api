<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240824040816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, region VARCHAR(255) NOT NULL, district VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, house VARCHAR(255) DEFAULT NULL, latitude VARCHAR(255) DEFAULT NULL, longitude VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cashbox (id INT AUTO_INCREMENT NOT NULL, store_id INT NOT NULL, name VARCHAR(255) NOT NULL, terminal_id VARCHAR(255) DEFAULT NULL, shift_number INT DEFAULT 1 NOT NULL, z_number INT DEFAULT 1 NOT NULL, x_number INT DEFAULT 1 NOT NULL, workplace VARCHAR(255) DEFAULT NULL, humo_arcus_folder VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) DEFAULT 1 NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_53928122B092A811 (store_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cashbox_detail (id INT AUTO_INCREMENT NOT NULL, detail_id INT DEFAULT NULL, user_id INT NOT NULL, cashbox_id INT NOT NULL, counter_part_id INT DEFAULT NULL, cheque_number INT NOT NULL, type VARCHAR(255) NOT NULL, credit_type VARCHAR(255) DEFAULT NULL, return_status TINYINT(1) DEFAULT 0, credit_status TINYINT(1) DEFAULT NULL, surrender NUMERIC(10, 2) DEFAULT \'0\', sale NUMERIC(10, 2) DEFAULT \'0\', discount NUMERIC(10, 2) DEFAULT \'0\', nds NUMERIC(10, 2) DEFAULT \'0\', advance NUMERIC(10, 2) DEFAULT \'0\', credit NUMERIC(10, 2) DEFAULT \'0\', remain NUMERIC(10, 2) DEFAULT \'0\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_2885A3E4D8D003BB (detail_id), INDEX IDX_2885A3E4A76ED395 (user_id), INDEX IDX_2885A3E461110C8F (cashbox_id), INDEX IDX_2885A3E4C28817CD (counter_part_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cashbox_global (id INT AUTO_INCREMENT NOT NULL, cashbox_detail_id INT NOT NULL, nomenclature_id INT NOT NULL, qty NUMERIC(10, 3) DEFAULT \'0\' NOT NULL, oldprice NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, price NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, oldprice_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, price_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, nds NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, nds_sum NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, discount NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, discount_sum NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_EE8657F4D05225E1 (cashbox_detail_id), INDEX IDX_EE8657F490BFD4B8 (nomenclature_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cashbox_payment (id INT AUTO_INCREMENT NOT NULL, cashbox_detail_id INT NOT NULL, payment_type_id INT NOT NULL, amount NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_A34FE34ED05225E1 (cashbox_detail_id), INDEX IDX_A34FE34EDC058279 (payment_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cashbox_shift (id INT AUTO_INCREMENT NOT NULL, cashbox_id INT NOT NULL, user_id INT NOT NULL, shift_number INT NOT NULL, closed_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_9062530061110C8F (cashbox_id), INDEX IDX_90625300A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) DEFAULT 1 NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_64C19C1727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE counter_part (id INT AUTO_INCREMENT NOT NULL, multi_store_id INT NOT NULL, address_id INT DEFAULT NULL, inn VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, discount NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_682A9A17B4D9FBF (multi_store_id), UNIQUE INDEX UNIQ_682A9A1F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, multi_store_id INT NOT NULL, currency_id INT NOT NULL, cape_amount NUMERIC(10, 2) NOT NULL, cape_type VARCHAR(255) NOT NULL, `convert` INT NOT NULL, currency_value NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forgive_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE move_detail (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, store_sender_id INT NOT NULL, store_receiver_id INT NOT NULL, user_sender_id INT NOT NULL, user_receiver_id INT NOT NULL, total_qty NUMERIC(10, 2) NOT NULL, total_price NUMERIC(10, 2) NOT NULL, total_item INT NOT NULL, comment VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE move_global (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, move_detail_id INT NOT NULL, nomenclature_id INT NOT NULL, qty NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE multi_store (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, owner_id INT NOT NULL, name VARCHAR(255) NOT NULL, profit VARCHAR(255) DEFAULT NULL, barcode_TTN BIGINT DEFAULT 5752022000000, nds INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_A869D5ABF5B7AF75 (address_id), INDEX IDX_A869D5AB7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE multi_store_user (multi_store_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_E71387307B4D9FBF (multi_store_id), INDEX IDX_E7138730A76ED395 (user_id), PRIMARY KEY(multi_store_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nomenclature (id INT AUTO_INCREMENT NOT NULL, provider_id INT DEFAULT NULL, multi_store_id INT NOT NULL, category_id INT NOT NULL, unit_id INT DEFAULT NULL, mxik VARCHAR(255) DEFAULT NULL, barcode BIGINT NOT NULL, brand VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, oldprice NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, price NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, oldprice_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, price_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, nds NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, discount NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, qr_code TINYINT(1) DEFAULT 0 NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_799A3652A53A8AA (provider_id), INDEX IDX_799A36527B4D9FBF (multi_store_id), INDEX IDX_799A365212469DE2 (category_id), INDEX IDX_799A3652F8BD700D (unit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nomenclature_history (id INT AUTO_INCREMENT NOT NULL, store_id INT NOT NULL, nomenclature_id INT NOT NULL, forgive_type_id INT DEFAULT NULL, owner_id INT NOT NULL, comment LONGTEXT DEFAULT NULL, qty NUMERIC(10, 2) DEFAULT NULL, oldprice NUMERIC(10, 2) DEFAULT NULL, price NUMERIC(10, 2) DEFAULT NULL, oldprice_course NUMERIC(10, 2) DEFAULT NULL, price_course NUMERIC(10, 2) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_C77D427EB092A811 (store_id), INDEX IDX_C77D427E90BFD4B8 (nomenclature_id), INDEX IDX_C77D427EF920CE6F (forgive_type_id), INDEX IDX_C77D427E7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE phone (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, store_id INT DEFAULT NULL, multi_store_id INT DEFAULT NULL, counter_part_id INT DEFAULT NULL, phone VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_444F97DD7E3C61F9 (owner_id), INDEX IDX_444F97DDB092A811 (store_id), INDEX IDX_444F97DD7B4D9FBF (multi_store_id), INDEX IDX_444F97DDC28817CD (counter_part_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provider_list (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE refresh_tokens (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL, UNIQUE INDEX UNIQ_9BACE7E1C74F2195 (refresh_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE store (id INT AUTO_INCREMENT NOT NULL, multi_store_id INT NOT NULL, address_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, is_active TINYINT(1) DEFAULT 1 NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_FF5758777B4D9FBF (multi_store_id), UNIQUE INDEX UNIQ_FF575877F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE store_user (store_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_6F2A7887B092A811 (store_id), INDEX IDX_6F2A7887A76ED395 (user_id), PRIMARY KEY(store_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE store_nomenclature (id INT AUTO_INCREMENT NOT NULL, store_id INT NOT NULL, nomenclature_id INT NOT NULL, qty NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_6EF31D66B092A811 (store_id), INDEX IDX_6EF31D6690BFD4B8 (nomenclature_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unit (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code INT NOT NULL, icon VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, username VARCHAR(255) NOT NULL, qr_code VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F5B7AF75 (address_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), UNIQUE INDEX UNIQ_IDENTIFIER_NAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_credential (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, type VARCHAR(255) NOT NULL, value LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_A218DBA77E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE web_credential (id INT AUTO_INCREMENT NOT NULL, multi_store_id INT NOT NULL, category VARCHAR(255) NOT NULL, article BIGINT DEFAULT 5952022000000, secrets VARCHAR(255) DEFAULT NULL, social VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_841FA7477B4D9FBF (multi_store_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE web_nomenclature (id INT AUTO_INCREMENT NOT NULL, nomenclature_id INT NOT NULL, article VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, document VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) DEFAULT 1 NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_FE9BA2AC90BFD4B8 (nomenclature_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cashbox ADD CONSTRAINT FK_53928122B092A811 FOREIGN KEY (store_id) REFERENCES store (id)');
        $this->addSql('ALTER TABLE cashbox_detail ADD CONSTRAINT FK_2885A3E4D8D003BB FOREIGN KEY (detail_id) REFERENCES cashbox_detail (id)');
        $this->addSql('ALTER TABLE cashbox_detail ADD CONSTRAINT FK_2885A3E4A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE cashbox_detail ADD CONSTRAINT FK_2885A3E461110C8F FOREIGN KEY (cashbox_id) REFERENCES cashbox (id)');
        $this->addSql('ALTER TABLE cashbox_detail ADD CONSTRAINT FK_2885A3E4C28817CD FOREIGN KEY (counter_part_id) REFERENCES counter_part (id)');
        $this->addSql('ALTER TABLE cashbox_global ADD CONSTRAINT FK_EE8657F4D05225E1 FOREIGN KEY (cashbox_detail_id) REFERENCES cashbox_detail (id)');
        $this->addSql('ALTER TABLE cashbox_global ADD CONSTRAINT FK_EE8657F490BFD4B8 FOREIGN KEY (nomenclature_id) REFERENCES nomenclature (id)');
        $this->addSql('ALTER TABLE cashbox_payment ADD CONSTRAINT FK_A34FE34ED05225E1 FOREIGN KEY (cashbox_detail_id) REFERENCES cashbox_detail (id)');
        $this->addSql('ALTER TABLE cashbox_payment ADD CONSTRAINT FK_A34FE34EDC058279 FOREIGN KEY (payment_type_id) REFERENCES payment_type (id)');
        $this->addSql('ALTER TABLE cashbox_shift ADD CONSTRAINT FK_9062530061110C8F FOREIGN KEY (cashbox_id) REFERENCES cashbox (id)');
        $this->addSql('ALTER TABLE cashbox_shift ADD CONSTRAINT FK_90625300A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE counter_part ADD CONSTRAINT FK_682A9A17B4D9FBF FOREIGN KEY (multi_store_id) REFERENCES multi_store (id)');
        $this->addSql('ALTER TABLE counter_part ADD CONSTRAINT FK_682A9A1F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE multi_store ADD CONSTRAINT FK_A869D5ABF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE multi_store ADD CONSTRAINT FK_A869D5AB7E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE multi_store_user ADD CONSTRAINT FK_E71387307B4D9FBF FOREIGN KEY (multi_store_id) REFERENCES multi_store (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE multi_store_user ADD CONSTRAINT FK_E7138730A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nomenclature ADD CONSTRAINT FK_799A3652A53A8AA FOREIGN KEY (provider_id) REFERENCES provider_list (id)');
        $this->addSql('ALTER TABLE nomenclature ADD CONSTRAINT FK_799A36527B4D9FBF FOREIGN KEY (multi_store_id) REFERENCES multi_store (id)');
        $this->addSql('ALTER TABLE nomenclature ADD CONSTRAINT FK_799A365212469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE nomenclature ADD CONSTRAINT FK_799A3652F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('ALTER TABLE nomenclature_history ADD CONSTRAINT FK_C77D427EB092A811 FOREIGN KEY (store_id) REFERENCES store (id)');
        $this->addSql('ALTER TABLE nomenclature_history ADD CONSTRAINT FK_C77D427E90BFD4B8 FOREIGN KEY (nomenclature_id) REFERENCES nomenclature (id)');
        $this->addSql('ALTER TABLE nomenclature_history ADD CONSTRAINT FK_C77D427EF920CE6F FOREIGN KEY (forgive_type_id) REFERENCES forgive_type (id)');
        $this->addSql('ALTER TABLE nomenclature_history ADD CONSTRAINT FK_C77D427E7E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DD7E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DDB092A811 FOREIGN KEY (store_id) REFERENCES store (id)');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DD7B4D9FBF FOREIGN KEY (multi_store_id) REFERENCES multi_store (id)');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DDC28817CD FOREIGN KEY (counter_part_id) REFERENCES counter_part (id)');
        $this->addSql('ALTER TABLE store ADD CONSTRAINT FK_FF5758777B4D9FBF FOREIGN KEY (multi_store_id) REFERENCES multi_store (id)');
        $this->addSql('ALTER TABLE store ADD CONSTRAINT FK_FF575877F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE store_user ADD CONSTRAINT FK_6F2A7887B092A811 FOREIGN KEY (store_id) REFERENCES store (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE store_user ADD CONSTRAINT FK_6F2A7887A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE store_nomenclature ADD CONSTRAINT FK_6EF31D66B092A811 FOREIGN KEY (store_id) REFERENCES store (id)');
        $this->addSql('ALTER TABLE store_nomenclature ADD CONSTRAINT FK_6EF31D6690BFD4B8 FOREIGN KEY (nomenclature_id) REFERENCES nomenclature (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE user_credential ADD CONSTRAINT FK_A218DBA77E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE web_credential ADD CONSTRAINT FK_841FA7477B4D9FBF FOREIGN KEY (multi_store_id) REFERENCES multi_store (id)');
        $this->addSql('ALTER TABLE web_nomenclature ADD CONSTRAINT FK_FE9BA2AC90BFD4B8 FOREIGN KEY (nomenclature_id) REFERENCES nomenclature (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cashbox DROP FOREIGN KEY FK_53928122B092A811');
        $this->addSql('ALTER TABLE cashbox_detail DROP FOREIGN KEY FK_2885A3E4D8D003BB');
        $this->addSql('ALTER TABLE cashbox_detail DROP FOREIGN KEY FK_2885A3E4A76ED395');
        $this->addSql('ALTER TABLE cashbox_detail DROP FOREIGN KEY FK_2885A3E461110C8F');
        $this->addSql('ALTER TABLE cashbox_detail DROP FOREIGN KEY FK_2885A3E4C28817CD');
        $this->addSql('ALTER TABLE cashbox_global DROP FOREIGN KEY FK_EE8657F4D05225E1');
        $this->addSql('ALTER TABLE cashbox_global DROP FOREIGN KEY FK_EE8657F490BFD4B8');
        $this->addSql('ALTER TABLE cashbox_payment DROP FOREIGN KEY FK_A34FE34ED05225E1');
        $this->addSql('ALTER TABLE cashbox_payment DROP FOREIGN KEY FK_A34FE34EDC058279');
        $this->addSql('ALTER TABLE cashbox_shift DROP FOREIGN KEY FK_9062530061110C8F');
        $this->addSql('ALTER TABLE cashbox_shift DROP FOREIGN KEY FK_90625300A76ED395');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE counter_part DROP FOREIGN KEY FK_682A9A17B4D9FBF');
        $this->addSql('ALTER TABLE counter_part DROP FOREIGN KEY FK_682A9A1F5B7AF75');
        $this->addSql('ALTER TABLE multi_store DROP FOREIGN KEY FK_A869D5ABF5B7AF75');
        $this->addSql('ALTER TABLE multi_store DROP FOREIGN KEY FK_A869D5AB7E3C61F9');
        $this->addSql('ALTER TABLE multi_store_user DROP FOREIGN KEY FK_E71387307B4D9FBF');
        $this->addSql('ALTER TABLE multi_store_user DROP FOREIGN KEY FK_E7138730A76ED395');
        $this->addSql('ALTER TABLE nomenclature DROP FOREIGN KEY FK_799A3652A53A8AA');
        $this->addSql('ALTER TABLE nomenclature DROP FOREIGN KEY FK_799A36527B4D9FBF');
        $this->addSql('ALTER TABLE nomenclature DROP FOREIGN KEY FK_799A365212469DE2');
        $this->addSql('ALTER TABLE nomenclature DROP FOREIGN KEY FK_799A3652F8BD700D');
        $this->addSql('ALTER TABLE nomenclature_history DROP FOREIGN KEY FK_C77D427EB092A811');
        $this->addSql('ALTER TABLE nomenclature_history DROP FOREIGN KEY FK_C77D427E90BFD4B8');
        $this->addSql('ALTER TABLE nomenclature_history DROP FOREIGN KEY FK_C77D427EF920CE6F');
        $this->addSql('ALTER TABLE nomenclature_history DROP FOREIGN KEY FK_C77D427E7E3C61F9');
        $this->addSql('ALTER TABLE phone DROP FOREIGN KEY FK_444F97DD7E3C61F9');
        $this->addSql('ALTER TABLE phone DROP FOREIGN KEY FK_444F97DDB092A811');
        $this->addSql('ALTER TABLE phone DROP FOREIGN KEY FK_444F97DD7B4D9FBF');
        $this->addSql('ALTER TABLE phone DROP FOREIGN KEY FK_444F97DDC28817CD');
        $this->addSql('ALTER TABLE store DROP FOREIGN KEY FK_FF5758777B4D9FBF');
        $this->addSql('ALTER TABLE store DROP FOREIGN KEY FK_FF575877F5B7AF75');
        $this->addSql('ALTER TABLE store_user DROP FOREIGN KEY FK_6F2A7887B092A811');
        $this->addSql('ALTER TABLE store_user DROP FOREIGN KEY FK_6F2A7887A76ED395');
        $this->addSql('ALTER TABLE store_nomenclature DROP FOREIGN KEY FK_6EF31D66B092A811');
        $this->addSql('ALTER TABLE store_nomenclature DROP FOREIGN KEY FK_6EF31D6690BFD4B8');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649F5B7AF75');
        $this->addSql('ALTER TABLE user_credential DROP FOREIGN KEY FK_A218DBA77E3C61F9');
        $this->addSql('ALTER TABLE web_credential DROP FOREIGN KEY FK_841FA7477B4D9FBF');
        $this->addSql('ALTER TABLE web_nomenclature DROP FOREIGN KEY FK_FE9BA2AC90BFD4B8');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE cashbox');
        $this->addSql('DROP TABLE cashbox_detail');
        $this->addSql('DROP TABLE cashbox_global');
        $this->addSql('DROP TABLE cashbox_payment');
        $this->addSql('DROP TABLE cashbox_shift');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE counter_part');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE forgive_type');
        $this->addSql('DROP TABLE move_detail');
        $this->addSql('DROP TABLE move_global');
        $this->addSql('DROP TABLE multi_store');
        $this->addSql('DROP TABLE multi_store_user');
        $this->addSql('DROP TABLE nomenclature');
        $this->addSql('DROP TABLE nomenclature_history');
        $this->addSql('DROP TABLE payment_type');
        $this->addSql('DROP TABLE phone');
        $this->addSql('DROP TABLE provider_list');
        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('DROP TABLE store');
        $this->addSql('DROP TABLE store_user');
        $this->addSql('DROP TABLE store_nomenclature');
        $this->addSql('DROP TABLE unit');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_credential');
        $this->addSql('DROP TABLE web_credential');
        $this->addSql('DROP TABLE web_nomenclature');
    }
}
