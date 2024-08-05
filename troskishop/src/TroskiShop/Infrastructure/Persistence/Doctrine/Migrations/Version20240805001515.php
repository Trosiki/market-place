<?php

declare(strict_types=1);

namespace TroskiShop\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240805001515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `ORDER` ADD country VARCHAR(255) NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD location VARCHAR(255) NOT NULL, ADD street VARCHAR(255) NOT NULL, ADD number VARCHAR(255) NOT NULL, ADD stair VARCHAR(255) NOT NULL, ADD floor_number VARCHAR(255) NOT NULL, ADD door VARCHAR(255) NOT NULL, ADD postal_code VARCHAR(255) NOT NULL, ADD phone_contact VARCHAR(255) NOT NULL, DROP address_country, DROP address_city, DROP address_location, DROP address_street, DROP address_number, DROP address_stair, DROP address_floor_number, DROP address_door, DROP address_postal_code, DROP address_phone_contact');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `ORDER` ADD address_country VARCHAR(255) NOT NULL, ADD address_city VARCHAR(255) NOT NULL, ADD address_location VARCHAR(255) NOT NULL, ADD address_street VARCHAR(255) NOT NULL, ADD address_number VARCHAR(255) NOT NULL, ADD address_stair VARCHAR(255) NOT NULL, ADD address_floor_number VARCHAR(255) NOT NULL, ADD address_door VARCHAR(255) NOT NULL, ADD address_postal_code VARCHAR(255) NOT NULL, ADD address_phone_contact VARCHAR(255) NOT NULL, DROP country, DROP city, DROP location, DROP street, DROP number, DROP stair, DROP floor_number, DROP door, DROP postal_code, DROP phone_contact');
    }
}
