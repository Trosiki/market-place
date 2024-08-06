<?php

declare(strict_types=1);

namespace TroskiShop\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240805002727 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE SHOP_ORDER (id INT AUTO_INCREMENT NOT NULL, shopping_cart_id INT DEFAULT NULL, delivery_id INT DEFAULT NULL, created_at DATETIME NOT NULL, sending_date DATETIME DEFAULT NULL, delivery_date DATETIME DEFAULT NULL, delivered_date DATETIME DEFAULT NULL, paymentId INT DEFAULT NULL, orderStatus VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, number VARCHAR(255) NOT NULL, stair VARCHAR(255) NOT NULL, floor_number VARCHAR(255) NOT NULL, door VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, phone_contact VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3E0CD1C345F80CD (shopping_cart_id), UNIQUE INDEX UNIQ_3E0CD1C312136921 (delivery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE SHOP_ORDER ADD CONSTRAINT FK_3E0CD1C345F80CD FOREIGN KEY (shopping_cart_id) REFERENCES SHOPPING_CART (id)');
        $this->addSql('ALTER TABLE SHOP_ORDER ADD CONSTRAINT FK_3E0CD1C312136921 FOREIGN KEY (delivery_id) REFERENCES DELIVERY (id)');
        $this->addSql('ALTER TABLE `ORDER` DROP FOREIGN KEY FK_27D512812136921');
        $this->addSql('ALTER TABLE `ORDER` DROP FOREIGN KEY FK_27D512845F80CD');
        $this->addSql('DROP TABLE `ORDER`');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `ORDER` (id INT AUTO_INCREMENT NOT NULL, shopping_cart_id INT DEFAULT NULL, delivery_id INT DEFAULT NULL, created_at DATETIME NOT NULL, sending_date DATETIME DEFAULT NULL, delivery_date DATETIME DEFAULT NULL, delivered_date DATETIME DEFAULT NULL, paymentId INT DEFAULT NULL, country VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, city VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, location VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, street VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, number VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, stair VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, floor_number VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, door VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, postal_code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, phone_contact VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, orderStatus VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_27D512812136921 (delivery_id), UNIQUE INDEX UNIQ_27D512845F80CD (shopping_cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `ORDER` ADD CONSTRAINT FK_27D512812136921 FOREIGN KEY (delivery_id) REFERENCES DELIVERY (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE `ORDER` ADD CONSTRAINT FK_27D512845F80CD FOREIGN KEY (shopping_cart_id) REFERENCES SHOPPING_CART (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE SHOP_ORDER DROP FOREIGN KEY FK_3E0CD1C345F80CD');
        $this->addSql('ALTER TABLE SHOP_ORDER DROP FOREIGN KEY FK_3E0CD1C312136921');
        $this->addSql('DROP TABLE SHOP_ORDER');
    }
}
