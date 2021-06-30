<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210624010802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_materiels (commande_id INT NOT NULL, materiels_id INT NOT NULL, INDEX IDX_8C12E42B82EA2E54 (commande_id), INDEX IDX_8C12E42BA10E8B56 (materiels_id), PRIMARY KEY(commande_id, materiels_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_materiels ADD CONSTRAINT FK_8C12E42B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_materiels ADD CONSTRAINT FK_8C12E42BA10E8B56 FOREIGN KEY (materiels_id) REFERENCES materiels (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66FB88E14F ON article (utilisateur_id)');
        $this->addSql('ALTER TABLE commande ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DFB88E14F ON commande (utilisateur_id)');
        $this->addSql('ALTER TABLE expriences ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE expriences ADD CONSTRAINT FK_765F7A9FFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_765F7A9FFB88E14F ON expriences (utilisateur_id)');
        $this->addSql('ALTER TABLE location ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_5E9E89CBFB88E14F ON location (utilisateur_id)');
        $this->addSql('ALTER TABLE reservation ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_42C84955FB88E14F ON reservation (utilisateur_id)');
        $this->addSql('ALTER TABLE utilisateur ADD abonnement_id INT DEFAULT NULL, ADD password VARCHAR(255) NOT NULL, DROP adresse, DROP mdp, DROP statut');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3F1D74413 FOREIGN KEY (abonnement_id) REFERENCES abonnement (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3F1D74413 ON utilisateur (abonnement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande_materiels');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66FB88E14F');
        $this->addSql('DROP INDEX IDX_23A0E66FB88E14F ON article');
        $this->addSql('ALTER TABLE article DROP utilisateur_id');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DFB88E14F');
        $this->addSql('DROP INDEX IDX_6EEAA67DFB88E14F ON commande');
        $this->addSql('ALTER TABLE commande DROP utilisateur_id');
        $this->addSql('ALTER TABLE expriences DROP FOREIGN KEY FK_765F7A9FFB88E14F');
        $this->addSql('DROP INDEX IDX_765F7A9FFB88E14F ON expriences');
        $this->addSql('ALTER TABLE expriences DROP utilisateur_id');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBFB88E14F');
        $this->addSql('DROP INDEX IDX_5E9E89CBFB88E14F ON location');
        $this->addSql('ALTER TABLE location DROP utilisateur_id');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955FB88E14F');
        $this->addSql('DROP INDEX IDX_42C84955FB88E14F ON reservation');
        $this->addSql('ALTER TABLE reservation DROP utilisateur_id');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3F1D74413');
        $this->addSql('DROP INDEX IDX_1D1C63B3F1D74413 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur ADD mdp VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD statut VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP abonnement_id, CHANGE password adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
