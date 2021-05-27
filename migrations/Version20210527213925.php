<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210527213925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE produit_serie');
        $this->addSql('ALTER TABLE produit ADD serie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27D94388BD ON produit (serie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produit_serie (produit_id INT NOT NULL, serie_id INT NOT NULL, INDEX IDX_9AA6F4A0F347EFB (produit_id), INDEX IDX_9AA6F4A0D94388BD (serie_id), PRIMARY KEY(produit_id, serie_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE produit_serie ADD CONSTRAINT FK_9AA6F4A0D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_serie ADD CONSTRAINT FK_9AA6F4A0F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27D94388BD');
        $this->addSql('DROP INDEX IDX_29A5EC27D94388BD ON produit');
        $this->addSql('ALTER TABLE produit DROP serie_id');
    }
}
