<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623123550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prix_inter ADD produit_id INT NOT NULL, ADD intervention_id INT NOT NULL, ADD duree TIME DEFAULT NULL');
        $this->addSql('ALTER TABLE prix_inter ADD CONSTRAINT FK_9CCF4331F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE prix_inter ADD CONSTRAINT FK_9CCF43318EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id)');
        $this->addSql('CREATE INDEX IDX_9CCF4331F347EFB ON prix_inter (produit_id)');
        $this->addSql('CREATE INDEX IDX_9CCF43318EAE3863 ON prix_inter (intervention_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prix_inter DROP FOREIGN KEY FK_9CCF4331F347EFB');
        $this->addSql('ALTER TABLE prix_inter DROP FOREIGN KEY FK_9CCF43318EAE3863');
        $this->addSql('DROP INDEX IDX_9CCF4331F347EFB ON prix_inter');
        $this->addSql('DROP INDEX IDX_9CCF43318EAE3863 ON prix_inter');
        $this->addSql('ALTER TABLE prix_inter DROP produit_id, DROP intervention_id, DROP duree');
    }
}
