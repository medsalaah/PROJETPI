<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210708193551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lignecommande (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, materiels_id INT DEFAULT NULL, quantite INT NOT NULL, INDEX IDX_853B793982EA2E54 (commande_id), INDEX IDX_853B7939A10E8B56 (materiels_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lignelocation (id INT AUTO_INCREMENT NOT NULL, location_id INT DEFAULT NULL, materiels_id INT DEFAULT NULL, quantite INT NOT NULL, INDEX IDX_B54F568F64D218E (location_id), INDEX IDX_B54F568FA10E8B56 (materiels_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lignecommande ADD CONSTRAINT FK_853B793982EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE lignecommande ADD CONSTRAINT FK_853B7939A10E8B56 FOREIGN KEY (materiels_id) REFERENCES materiels (id)');
        $this->addSql('ALTER TABLE lignelocation ADD CONSTRAINT FK_B54F568F64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE lignelocation ADD CONSTRAINT FK_B54F568FA10E8B56 FOREIGN KEY (materiels_id) REFERENCES materiels (id)');
        $this->addSql('DROP TABLE commande_materiels');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_materiels (commande_id INT NOT NULL, materiels_id INT NOT NULL, INDEX IDX_8C12E42B82EA2E54 (commande_id), INDEX IDX_8C12E42BA10E8B56 (materiels_id), PRIMARY KEY(commande_id, materiels_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commande_materiels ADD CONSTRAINT FK_8C12E42B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_materiels ADD CONSTRAINT FK_8C12E42BA10E8B56 FOREIGN KEY (materiels_id) REFERENCES materiels (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE lignecommande');
        $this->addSql('DROP TABLE lignelocation');
    }
}
