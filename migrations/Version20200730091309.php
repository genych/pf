<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200730091309 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_1F1B251E4887F3F8');
        $this->addSql('CREATE TEMPORARY TABLE __temp__item AS SELECT id, shipping_id, sku, price FROM item');
        $this->addSql('DROP TABLE item');
        $this->addSql('CREATE TABLE item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, shipping_id INTEGER DEFAULT NULL, sku CHAR(36) NOT NULL COLLATE BINARY --(DC2Type:guid)
        , price INTEGER NOT NULL, title VARCHAR(255) NOT NULL, CONSTRAINT FK_1F1B251E4887F3F8 FOREIGN KEY (shipping_id) REFERENCES shipping_price (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO item (id, shipping_id, sku, price) SELECT id, shipping_id, sku, price FROM __temp__item');
        $this->addSql('DROP TABLE __temp__item');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F1B251E4887F3F8 ON item (shipping_id)');
        $this->addSql('DROP INDEX IDX_F52993989395C3F3');
        $this->addSql('DROP INDEX UNIQ_F5299398BBC3C73C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__order AS SELECT id, shipping_info_id, customer_id, price FROM "order"');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('CREATE TABLE "order" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, shipping_info_id INTEGER NOT NULL, customer_id INTEGER NOT NULL, price INTEGER NOT NULL, CONSTRAINT FK_F5299398BBC3C73C FOREIGN KEY (shipping_info_id) REFERENCES shipping_info (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F52993989395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO "order" (id, shipping_info_id, customer_id, price) SELECT id, shipping_info_id, customer_id, price FROM __temp__order');
        $this->addSql('DROP TABLE __temp__order');
        $this->addSql('CREATE INDEX IDX_F52993989395C3F3 ON "order" (customer_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F5299398BBC3C73C ON "order" (shipping_info_id)');
        $this->addSql('DROP INDEX IDX_2812CEDEF44CABFF');
        $this->addSql('DROP INDEX IDX_2812CEDE8D9F6D38');
        $this->addSql('CREATE TEMPORARY TABLE __temp__order_package AS SELECT order_id, package_id FROM order_package');
        $this->addSql('DROP TABLE order_package');
        $this->addSql('CREATE TABLE order_package (order_id INTEGER NOT NULL, package_id INTEGER NOT NULL, PRIMARY KEY(order_id, package_id), CONSTRAINT FK_2812CEDE8D9F6D38 FOREIGN KEY (order_id) REFERENCES "order" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2812CEDEF44CABFF FOREIGN KEY (package_id) REFERENCES package (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO order_package (order_id, package_id) SELECT order_id, package_id FROM __temp__order_package');
        $this->addSql('DROP TABLE __temp__order_package');
        $this->addSql('CREATE INDEX IDX_2812CEDEF44CABFF ON order_package (package_id)');
        $this->addSql('CREATE INDEX IDX_2812CEDE8D9F6D38 ON order_package (order_id)');
        $this->addSql('DROP INDEX UNIQ_DE686795126F525E');
        $this->addSql('CREATE TEMPORARY TABLE __temp__package AS SELECT id, item_id, quantity FROM package');
        $this->addSql('DROP TABLE package');
        $this->addSql('CREATE TABLE package (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, item_id INTEGER NOT NULL, quantity INTEGER NOT NULL, CONSTRAINT FK_DE686795126F525E FOREIGN KEY (item_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO package (id, item_id, quantity) SELECT id, item_id, quantity FROM __temp__package');
        $this->addSql('DROP TABLE __temp__package');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DE686795126F525E ON package (item_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_1F1B251E4887F3F8');
        $this->addSql('CREATE TEMPORARY TABLE __temp__item AS SELECT id, shipping_id, sku, price FROM item');
        $this->addSql('DROP TABLE item');
        $this->addSql('CREATE TABLE item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, shipping_id INTEGER DEFAULT NULL, sku CHAR(36) NOT NULL --(DC2Type:guid)
        , price INTEGER NOT NULL)');
        $this->addSql('INSERT INTO item (id, shipping_id, sku, price) SELECT id, shipping_id, sku, price FROM __temp__item');
        $this->addSql('DROP TABLE __temp__item');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F1B251E4887F3F8 ON item (shipping_id)');
        $this->addSql('DROP INDEX UNIQ_F5299398BBC3C73C');
        $this->addSql('DROP INDEX IDX_F52993989395C3F3');
        $this->addSql('CREATE TEMPORARY TABLE __temp__order AS SELECT id, shipping_info_id, customer_id, price FROM "order"');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('CREATE TABLE "order" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, shipping_info_id INTEGER NOT NULL, customer_id INTEGER NOT NULL, price INTEGER NOT NULL)');
        $this->addSql('INSERT INTO "order" (id, shipping_info_id, customer_id, price) SELECT id, shipping_info_id, customer_id, price FROM __temp__order');
        $this->addSql('DROP TABLE __temp__order');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F5299398BBC3C73C ON "order" (shipping_info_id)');
        $this->addSql('CREATE INDEX IDX_F52993989395C3F3 ON "order" (customer_id)');
        $this->addSql('DROP INDEX IDX_2812CEDE8D9F6D38');
        $this->addSql('DROP INDEX IDX_2812CEDEF44CABFF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__order_package AS SELECT order_id, package_id FROM order_package');
        $this->addSql('DROP TABLE order_package');
        $this->addSql('CREATE TABLE order_package (order_id INTEGER NOT NULL, package_id INTEGER NOT NULL, PRIMARY KEY(order_id, package_id))');
        $this->addSql('INSERT INTO order_package (order_id, package_id) SELECT order_id, package_id FROM __temp__order_package');
        $this->addSql('DROP TABLE __temp__order_package');
        $this->addSql('CREATE INDEX IDX_2812CEDE8D9F6D38 ON order_package (order_id)');
        $this->addSql('CREATE INDEX IDX_2812CEDEF44CABFF ON order_package (package_id)');
        $this->addSql('DROP INDEX UNIQ_DE686795126F525E');
        $this->addSql('CREATE TEMPORARY TABLE __temp__package AS SELECT id, item_id, quantity FROM package');
        $this->addSql('DROP TABLE package');
        $this->addSql('CREATE TABLE package (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, item_id INTEGER NOT NULL, quantity INTEGER NOT NULL)');
        $this->addSql('INSERT INTO package (id, item_id, quantity) SELECT id, item_id, quantity FROM __temp__package');
        $this->addSql('DROP TABLE __temp__package');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DE686795126F525E ON package (item_id)');
    }
}
