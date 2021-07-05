<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210704222519 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D9AF8E3A3');
        $this->addSql('DROP INDEX IDX_6EEAA67D9AF8E3A3 ON commande');
        $this->addSql('ALTER TABLE commande DROP id_commande_id');
        $this->addSql('ALTER TABLE lignecommande ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lignecommande ADD CONSTRAINT FK_853B793982EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_853B793982EA2E54 ON lignecommande (commande_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD id_commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D9AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES lignecommande (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D9AF8E3A3 ON commande (id_commande_id)');
        $this->addSql('ALTER TABLE lignecommande DROP FOREIGN KEY FK_853B793982EA2E54');
        $this->addSql('DROP INDEX IDX_853B793982EA2E54 ON lignecommande');
        $this->addSql('ALTER TABLE lignecommande DROP commande_id');
    }
}
