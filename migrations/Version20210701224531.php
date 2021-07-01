<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210701224531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement ADD date_fin_even DATE NOT NULL, ADD prix_even DOUBLE PRECISION NOT NULL, ADD lieu_even VARCHAR(255) NOT NULL, ADD image_eve VARCHAR(255) NOT NULL, ADD nbr_eve INT NOT NULL, ADD nbr_participant INT NOT NULL, CHANGE date_deb_even date_deb_even DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement DROP date_fin_even, DROP prix_even, DROP lieu_even, DROP image_eve, DROP nbr_eve, DROP nbr_participant, CHANGE date_deb_even date_deb_even VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
