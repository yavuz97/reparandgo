<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210621134319 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prix_inter_produit (prix_inter_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_9521572D936789EC (prix_inter_id), INDEX IDX_9521572DF347EFB (produit_id), PRIMARY KEY(prix_inter_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prix_inter_intervention (prix_inter_id INT NOT NULL, intervention_id INT NOT NULL, INDEX IDX_FF979779936789EC (prix_inter_id), INDEX IDX_FF9797798EAE3863 (intervention_id), PRIMARY KEY(prix_inter_id, intervention_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prix_inter_produit ADD CONSTRAINT FK_9521572D936789EC FOREIGN KEY (prix_inter_id) REFERENCES prix_inter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prix_inter_produit ADD CONSTRAINT FK_9521572DF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prix_inter_intervention ADD CONSTRAINT FK_FF979779936789EC FOREIGN KEY (prix_inter_id) REFERENCES prix_inter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prix_inter_intervention ADD CONSTRAINT FK_FF9797798EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE prix_inter_produit');
        $this->addSql('DROP TABLE prix_inter_intervention');
    }
}
