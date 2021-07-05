<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210704223442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lignelocation (id INT AUTO_INCREMENT NOT NULL, location_id INT DEFAULT NULL, materiels_id INT DEFAULT NULL, quantite INT NOT NULL, INDEX IDX_B54F568F64D218E (location_id), INDEX IDX_B54F568FA10E8B56 (materiels_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lignelocation ADD CONSTRAINT FK_B54F568F64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE lignelocation ADD CONSTRAINT FK_B54F568FA10E8B56 FOREIGN KEY (materiels_id) REFERENCES materiels (id)');
        $this->addSql('ALTER TABLE lignecommande ADD materiels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lignecommande ADD CONSTRAINT FK_853B7939A10E8B56 FOREIGN KEY (materiels_id) REFERENCES materiels (id)');
        $this->addSql('CREATE INDEX IDX_853B7939A10E8B56 ON lignecommande (materiels_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE lignelocation');
        $this->addSql('ALTER TABLE lignecommande DROP FOREIGN KEY FK_853B7939A10E8B56');
        $this->addSql('DROP INDEX IDX_853B7939A10E8B56 ON lignecommande');
        $this->addSql('ALTER TABLE lignecommande DROP materiels_id');
    }
}
