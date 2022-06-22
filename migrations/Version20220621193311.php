<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220621193311 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tipo_de_iva (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, value INTEGER NOT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product_listing AS SELECT id, name, description, price, tipo_de_iva FROM product_listing');
        $this->addSql('DROP TABLE product_listing');
        $this->addSql('CREATE TABLE product_listing (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, tipo_de_iva_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price INTEGER NOT NULL, CONSTRAINT FK_1AD95364B8D8B70 FOREIGN KEY (tipo_de_iva_id) REFERENCES tipo_de_iva (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO product_listing (id, name, description, price, tipo_de_iva_id) SELECT id, name, description, price, tipo_de_iva FROM __temp__product_listing');
        $this->addSql('DROP TABLE __temp__product_listing');
        $this->addSql('CREATE INDEX IDX_1AD95364B8D8B70 ON product_listing (tipo_de_iva_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tipo_de_iva');
        $this->addSql('DROP INDEX IDX_1AD95364B8D8B70');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product_listing AS SELECT id, tipo_de_iva_id, name, description, price FROM product_listing');
        $this->addSql('DROP TABLE product_listing');
        $this->addSql('CREATE TABLE product_listing (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, tipo_de_iva INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price INTEGER NOT NULL, CONSTRAINT FK_1AD95364B8D8B70 FOREIGN KEY (tipo_de_iva) REFERENCES tipo_de_iva (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO product_listing (id, tipo_de_iva, name, description, price) SELECT id, tipo_de_iva_id, name, description, price FROM __temp__product_listing');
        $this->addSql('DROP TABLE __temp__product_listing');
    }
}
