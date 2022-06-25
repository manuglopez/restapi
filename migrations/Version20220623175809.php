<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220623175809 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('DROP INDEX IDX_1AD95364B8D8B70');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product_listing AS SELECT id, tipo_de_iva_id, name, description, price_without_iva, price_with_iva FROM product_listing');
        $this->addSql('DROP TABLE product_listing');
        $this->addSql('CREATE TABLE product_listing (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, tipo_de_iva_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price_without_iva INTEGER NOT NULL, price_with_iva INTEGER DEFAULT NULL, CONSTRAINT FK_1AD95364B8D8B70 FOREIGN KEY (tipo_de_iva_id) REFERENCES tipo_de_iva (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO product_listing (id, tipo_de_iva_id, name, description, price_without_iva, price_with_iva) SELECT id, tipo_de_iva_id, name, description, price_without_iva, price_with_iva FROM __temp__product_listing');
        $this->addSql('DROP TABLE __temp__product_listing');
        $this->addSql('CREATE INDEX IDX_1AD95364B8D8B70 ON product_listing (tipo_de_iva_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_1AD95364B8D8B70');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product_listing AS SELECT id, tipo_de_iva_id, name, description, price_without_iva, price_with_iva FROM product_listing');
        $this->addSql('DROP TABLE product_listing');
        $this->addSql('CREATE TABLE product_listing (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, tipo_de_iva_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price_without_iva INTEGER NOT NULL, price_with_iva INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO product_listing (id, tipo_de_iva_id, name, description, price_without_iva, price_with_iva) SELECT id, tipo_de_iva_id, name, description, price_without_iva, price_with_iva FROM __temp__product_listing');
        $this->addSql('DROP TABLE __temp__product_listing');
        $this->addSql('CREATE INDEX IDX_1AD95364B8D8B70 ON product_listing (tipo_de_iva_id)');
    }
}
