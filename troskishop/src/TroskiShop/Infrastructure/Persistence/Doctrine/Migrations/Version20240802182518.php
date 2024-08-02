<?php

declare(strict_types=1);

namespace TroskiShop\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240802182518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE SHOPPING_CART DROP FOREIGN KEY FK_9527F917B1092722');
        $this->addSql('DROP TABLE CART_STATUS');
        $this->addSql('DROP INDEX IDX_9527F917B1092722 ON SHOPPING_CART');
        $this->addSql('ALTER TABLE SHOPPING_CART ADD cartStatus VARCHAR(50) NOT NULL, DROP cart_status_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE CART_STATUS (id INT AUTO_INCREMENT NOT NULL, statusName VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE SHOPPING_CART ADD cart_status_id INT NOT NULL, DROP cartStatus');
        $this->addSql('ALTER TABLE SHOPPING_CART ADD CONSTRAINT FK_9527F917B1092722 FOREIGN KEY (cart_status_id) REFERENCES CART_STATUS (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9527F917B1092722 ON SHOPPING_CART (cart_status_id)');
    }
}
