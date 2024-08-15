<?php

declare(strict_types=1);

namespace TroskiShop\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240721163138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE CART_STATUS (id INT AUTO_INCREMENT NOT NULL, statusName VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE DELIVERY (id INT AUTO_INCREMENT NOT NULL, company_name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `ORDER` (id VARCHAR(255) NOT NULL, shopping_cart_id INT NOT NULL, delivery_id INT NOT NULL, created_at DATETIME NOT NULL, sending_date DATETIME NOT NULL, delivery_date DATETIME NOT NULL, delivered_date DATETIME NOT NULL, address_address_country VARCHAR(255) NOT NULL, address_address_city VARCHAR(255) NOT NULL, address_address_location VARCHAR(255) NOT NULL, address_address_street VARCHAR(255) NOT NULL, address_address_number VARCHAR(255) NOT NULL, address_address_stair VARCHAR(255) NOT NULL, address_address_floor_number VARCHAR(255) NOT NULL, address_address_door VARCHAR(255) NOT NULL, address_address_postal_code VARCHAR(255) NOT NULL, address_address_phone_contact VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE PRODUCT (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, image VARCHAR(255) NOT NULL, specification LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE SHOPPING_CART (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, cart_status_id INT NOT NULL, INDEX IDX_9527F917A76ED395 (user_id), INDEX IDX_9527F917B1092722 (cart_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE SHOPPING_CART_PRODUCT (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, shopping_cart_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_1C90C11C4584665A (product_id), INDEX IDX_1C90C11C45F80CD (shopping_cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE USER (id INT AUTO_INCREMENT NOT NULL, nif VARCHAR(50) NOT NULL, name VARCHAR(100) NOT NULL, surname VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, telephone VARCHAR(20) NOT NULL, role VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE SHOPPING_CART ADD CONSTRAINT FK_9527F917A76ED395 FOREIGN KEY (user_id) REFERENCES USER (id)');
        $this->addSql('ALTER TABLE SHOPPING_CART ADD CONSTRAINT FK_9527F917B1092722 FOREIGN KEY (cart_status_id) REFERENCES CART_STATUS (id)');
        $this->addSql('ALTER TABLE SHOPPING_CART_PRODUCT ADD CONSTRAINT FK_1C90C11C4584665A FOREIGN KEY (product_id) REFERENCES PRODUCT (id)');
        $this->addSql('ALTER TABLE SHOPPING_CART_PRODUCT ADD CONSTRAINT FK_1C90C11C45F80CD FOREIGN KEY (shopping_cart_id) REFERENCES SHOPPING_CART (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE SHOPPING_CART DROP FOREIGN KEY FK_9527F917A76ED395');
        $this->addSql('ALTER TABLE SHOPPING_CART DROP FOREIGN KEY FK_9527F917B1092722');
        $this->addSql('ALTER TABLE SHOPPING_CART_PRODUCT DROP FOREIGN KEY FK_1C90C11C4584665A');
        $this->addSql('ALTER TABLE SHOPPING_CART_PRODUCT DROP FOREIGN KEY FK_1C90C11C45F80CD');
        $this->addSql('DROP TABLE CART_STATUS');
        $this->addSql('DROP TABLE DELIVERY');
        $this->addSql('DROP TABLE `ORDER`');
        $this->addSql('DROP TABLE PRODUCT');
        $this->addSql('DROP TABLE SHOPPING_CART');
        $this->addSql('DROP TABLE SHOPPING_CART_PRODUCT');
        $this->addSql('DROP TABLE USER');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
