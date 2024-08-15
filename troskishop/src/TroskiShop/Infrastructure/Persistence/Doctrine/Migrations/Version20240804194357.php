<?php

declare(strict_types=1);

namespace TroskiShop\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240804194357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `ORDER` CHANGE shopping_cart_id shopping_cart_id INT DEFAULT NULL, CHANGE delivery_id delivery_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `ORDER` ADD CONSTRAINT FK_27D512845F80CD FOREIGN KEY (shopping_cart_id) REFERENCES SHOPPING_CART (id)');
        $this->addSql('ALTER TABLE `ORDER` ADD CONSTRAINT FK_27D512812136921 FOREIGN KEY (delivery_id) REFERENCES DELIVERY (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_27D512845F80CD ON `ORDER` (shopping_cart_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_27D512812136921 ON `ORDER` (delivery_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `ORDER` DROP FOREIGN KEY FK_27D512845F80CD');
        $this->addSql('ALTER TABLE `ORDER` DROP FOREIGN KEY FK_27D512812136921');
        $this->addSql('DROP INDEX UNIQ_27D512845F80CD ON `ORDER`');
        $this->addSql('DROP INDEX UNIQ_27D512812136921 ON `ORDER`');
        $this->addSql('ALTER TABLE `ORDER` CHANGE shopping_cart_id shopping_cart_id INT NOT NULL, CHANGE delivery_id delivery_id INT NOT NULL');
    }
}
