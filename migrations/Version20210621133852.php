<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210621133852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prix_inter DROP FOREIGN KEY FK_9CCF43318EAE3863');
        $this->addSql('ALTER TABLE prix_inter DROP FOREIGN KEY FK_9CCF4331F347EFB');
        $this->addSql('DROP INDEX UNIQ_9CCF4331F347EFB ON prix_inter');
        $this->addSql('DROP INDEX UNIQ_9CCF43318EAE3863 ON prix_inter');
        $this->addSql('ALTER TABLE prix_inter DROP intervention_id, DROP produit_id');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC274ECFA2F8');
        $this->addSql('DROP INDEX UNIQ_29A5EC274ECFA2F8 ON produit');
        $this->addSql('ALTER TABLE produit DROP prix_intervention_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prix_inter ADD intervention_id INT NOT NULL, ADD produit_id INT NOT NULL');
        $this->addSql('ALTER TABLE prix_inter ADD CONSTRAINT FK_9CCF43318EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id)');
        $this->addSql('ALTER TABLE prix_inter ADD CONSTRAINT FK_9CCF4331F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9CCF4331F347EFB ON prix_inter (produit_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9CCF43318EAE3863 ON prix_inter (intervention_id)');
        $this->addSql('ALTER TABLE produit ADD prix_intervention_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC274ECFA2F8 FOREIGN KEY (prix_intervention_id) REFERENCES intervention (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_29A5EC274ECFA2F8 ON produit (prix_intervention_id)');
    }
}
