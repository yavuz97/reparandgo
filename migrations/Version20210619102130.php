<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210619102130 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit ADD prix_intervention_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC274ECFA2F8 FOREIGN KEY (prix_intervention_id) REFERENCES intervention (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_29A5EC274ECFA2F8 ON produit (prix_intervention_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC274ECFA2F8');
        $this->addSql('DROP INDEX UNIQ_29A5EC274ECFA2F8 ON produit');
        $this->addSql('ALTER TABLE produit DROP prix_intervention_id');
    }
}
