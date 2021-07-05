<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210704215152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D20D3031');
        $this->addSql('ALTER TABLE materiels DROP FOREIGN KEY FK_9C1EBE6920D3031');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB86AA3FEB');
        $this->addSql('ALTER TABLE materiels DROP FOREIGN KEY FK_9C1EBE6986AA3FEB');
        $this->addSql('CREATE TABLE commande_materiels (commande_id INT NOT NULL, materiels_id INT NOT NULL, INDEX IDX_8C12E42B82EA2E54 (commande_id), INDEX IDX_8C12E42BA10E8B56 (materiels_id), PRIMARY KEY(commande_id, materiels_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_materiels ADD CONSTRAINT FK_8C12E42B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_materiels ADD CONSTRAINT FK_8C12E42BA10E8B56 FOREIGN KEY (materiels_id) REFERENCES materiels (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE lignecommande');
        $this->addSql('DROP TABLE lignelocation');
        $this->addSql('DROP INDEX IDX_6EEAA67D20D3031 ON commande');
        $this->addSql('ALTER TABLE commande DROP lignecommande_id');
        $this->addSql('DROP INDEX IDX_5E9E89CB86AA3FEB ON location');
        $this->addSql('ALTER TABLE location DROP lignelocation_id');
        $this->addSql('DROP INDEX IDX_9C1EBE6920D3031 ON materiels');
        $this->addSql('DROP INDEX IDX_9C1EBE6986AA3FEB ON materiels');
        $this->addSql('ALTER TABLE materiels DROP lignecommande_id, DROP lignelocation_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lignecommande (id INT AUTO_INCREMENT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE lignelocation (id INT AUTO_INCREMENT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE commande_materiels');
        $this->addSql('ALTER TABLE commande ADD lignecommande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D20D3031 FOREIGN KEY (lignecommande_id) REFERENCES lignecommande (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D20D3031 ON commande (lignecommande_id)');
        $this->addSql('ALTER TABLE location ADD lignelocation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB86AA3FEB FOREIGN KEY (lignelocation_id) REFERENCES lignelocation (id)');
        $this->addSql('CREATE INDEX IDX_5E9E89CB86AA3FEB ON location (lignelocation_id)');
        $this->addSql('ALTER TABLE materiels ADD lignecommande_id INT DEFAULT NULL, ADD lignelocation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE materiels ADD CONSTRAINT FK_9C1EBE6920D3031 FOREIGN KEY (lignecommande_id) REFERENCES lignecommande (id)');
        $this->addSql('ALTER TABLE materiels ADD CONSTRAINT FK_9C1EBE6986AA3FEB FOREIGN KEY (lignelocation_id) REFERENCES lignelocation (id)');
        $this->addSql('CREATE INDEX IDX_9C1EBE6920D3031 ON materiels (lignecommande_id)');
        $this->addSql('CREATE INDEX IDX_9C1EBE6986AA3FEB ON materiels (lignelocation_id)');
    }
}
