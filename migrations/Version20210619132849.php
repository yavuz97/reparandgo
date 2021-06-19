<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210619132849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prix_inter (id INT AUTO_INCREMENT NOT NULL, intervention_id INT NOT NULL, produit_id INT NOT NULL, prix DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX UNIQ_9CCF43318EAE3863 (intervention_id), UNIQUE INDEX UNIQ_9CCF4331F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prix_inter ADD CONSTRAINT FK_9CCF43318EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id)');
        $this->addSql('ALTER TABLE prix_inter ADD CONSTRAINT FK_9CCF4331F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE prix_inter');
    }
}
