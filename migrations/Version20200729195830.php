<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200729195830 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, shipping_id INTEGER DEFAULT NULL, sku CHAR(36) NOT NULL --(DC2Type:guid)
        , price INTEGER NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F1B251E4887F3F8 ON item (shipping_id)');
        $this->addSql('CREATE TABLE "order" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, shipping_info_id INTEGER NOT NULL, customer_id INTEGER NOT NULL, price INTEGER NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F5299398BBC3C73C ON "order" (shipping_info_id)');
        $this->addSql('CREATE INDEX IDX_F52993989395C3F3 ON "order" (customer_id)');
        $this->addSql('CREATE TABLE order_package (order_id INTEGER NOT NULL, package_id INTEGER NOT NULL, PRIMARY KEY(order_id, package_id))');
        $this->addSql('CREATE INDEX IDX_2812CEDE8D9F6D38 ON order_package (order_id)');
        $this->addSql('CREATE INDEX IDX_2812CEDEF44CABFF ON order_package (package_id)');
        $this->addSql('CREATE TABLE package (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, item_id INTEGER NOT NULL, quantity INTEGER NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DE686795126F525E ON package (item_id)');
        $this->addSql('CREATE TABLE shipping_info (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, region VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, zip VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE shipping_price (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_domestic INTEGER DEFAULT NULL, first_worldwide INTEGER DEFAULT NULL, rest_domestic INTEGER DEFAULT NULL, rest_world_wide INTEGER DEFAULT NULL, express_domestic INTEGER DEFAULT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('DROP TABLE order_package');
        $this->addSql('DROP TABLE package');
        $this->addSql('DROP TABLE shipping_info');
        $this->addSql('DROP TABLE shipping_price');
    }
}
