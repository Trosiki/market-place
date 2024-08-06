<?php

declare(strict_types=1);

namespace TroskiShop\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240804235848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `ORDER` CHANGE sending_date sending_date DATETIME DEFAULT NULL, CHANGE delivery_date delivery_date DATETIME DEFAULT NULL, CHANGE delivered_date delivered_date DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `ORDER` CHANGE sending_date sending_date DATETIME NOT NULL, CHANGE delivery_date delivery_date DATETIME NOT NULL, CHANGE delivered_date delivered_date DATETIME NOT NULL');
    }
}
