<?php

declare(strict_types=1);

namespace TroskiShop\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240805001254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `ORDER` ADD address_country VARCHAR(255) NOT NULL, ADD address_city VARCHAR(255) NOT NULL, ADD address_location VARCHAR(255) NOT NULL, ADD address_street VARCHAR(255) NOT NULL, ADD address_number VARCHAR(255) NOT NULL, ADD address_stair VARCHAR(255) NOT NULL, ADD address_floor_number VARCHAR(255) NOT NULL, ADD address_door VARCHAR(255) NOT NULL, ADD address_postal_code VARCHAR(255) NOT NULL, ADD address_phone_contact VARCHAR(255) NOT NULL, DROP address_address_country, DROP address_address_city, DROP address_address_location, DROP address_address_street, DROP address_address_number, DROP address_address_stair, DROP address_address_floor_number, DROP address_address_door, DROP address_address_postal_code, DROP address_address_phone_contact, CHANGE shopping_cart_id shopping_cart_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `ORDER` ADD address_address_country VARCHAR(255) NOT NULL, ADD address_address_city VARCHAR(255) NOT NULL, ADD address_address_location VARCHAR(255) NOT NULL, ADD address_address_street VARCHAR(255) NOT NULL, ADD address_address_number VARCHAR(255) NOT NULL, ADD address_address_stair VARCHAR(255) NOT NULL, ADD address_address_floor_number VARCHAR(255) NOT NULL, ADD address_address_door VARCHAR(255) NOT NULL, ADD address_address_postal_code VARCHAR(255) NOT NULL, ADD address_address_phone_contact VARCHAR(255) NOT NULL, DROP address_country, DROP address_city, DROP address_location, DROP address_street, DROP address_number, DROP address_stair, DROP address_floor_number, DROP address_door, DROP address_postal_code, DROP address_phone_contact, CHANGE shopping_cart_id shopping_cart_id INT NOT NULL');
    }
}
