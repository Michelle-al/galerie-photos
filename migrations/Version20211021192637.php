<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211021192637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tag_repertoire (tag_id INT NOT NULL, repertoire_id INT NOT NULL, INDEX IDX_992DFA27BAD26311 (tag_id), INDEX IDX_992DFA271E61B789 (repertoire_id), PRIMARY KEY(tag_id, repertoire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tag_repertoire ADD CONSTRAINT FK_992DFA27BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_repertoire ADD CONSTRAINT FK_992DFA271E61B789 FOREIGN KEY (repertoire_id) REFERENCES repertoire (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE repertoire_tag');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418FB88E14F');
        $this->addSql('DROP INDEX IDX_14B78418FB88E14F ON photo');
        $this->addSql('ALTER TABLE photo DROP utilisateur_id, DROP date_upload');
        $this->addSql('ALTER TABLE repertoire ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD image VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE repertoire_tag (repertoire_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_FC2785231E61B789 (repertoire_id), INDEX IDX_FC278523BAD26311 (tag_id), PRIMARY KEY(repertoire_id, tag_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE repertoire_tag ADD CONSTRAINT FK_FC2785231E61B789 FOREIGN KEY (repertoire_id) REFERENCES repertoire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE repertoire_tag ADD CONSTRAINT FK_FC278523BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE tag_repertoire');
        $this->addSql('ALTER TABLE photo ADD utilisateur_id INT NOT NULL, ADD date_upload DATETIME NOT NULL');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_14B78418FB88E14F ON photo (utilisateur_id)');
        $this->addSql('ALTER TABLE repertoire DROP created_at, DROP updated_at, DROP image');
    }
}
