<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211007181250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, repertoire_id INT NOT NULL, utilisateur_id INT NOT NULL, image VARCHAR(255) NOT NULL, date_upload DATETIME NOT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_14B784181E61B789 (repertoire_id), INDEX IDX_14B78418FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repertoire (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, annee DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repertoire_tag (repertoire_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_FC2785231E61B789 (repertoire_id), INDEX IDX_FC278523BAD26311 (tag_id), PRIMARY KEY(repertoire_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, admin TINYINT(1) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, civilite TINYINT(1) DEFAULT NULL, pseudo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784181E61B789 FOREIGN KEY (repertoire_id) REFERENCES repertoire (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE repertoire_tag ADD CONSTRAINT FK_FC2785231E61B789 FOREIGN KEY (repertoire_id) REFERENCES repertoire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE repertoire_tag ADD CONSTRAINT FK_FC278523BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784181E61B789');
        $this->addSql('ALTER TABLE repertoire_tag DROP FOREIGN KEY FK_FC2785231E61B789');
        $this->addSql('ALTER TABLE repertoire_tag DROP FOREIGN KEY FK_FC278523BAD26311');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418FB88E14F');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE repertoire');
        $this->addSql('DROP TABLE repertoire_tag');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE utilisateur');
    }
}
