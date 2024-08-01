<?php

declare(strict_types=1);

namespace TroskiShop\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240801170904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE PRODUCT ADD brand VARCHAR(255) NOT NULL, ADD model VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EC0FFAB7841CB121 ON PRODUCT (uri)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_EC0FFAB7841CB121 ON PRODUCT');
        $this->addSql('ALTER TABLE PRODUCT DROP brand, DROP model');
    }
}
