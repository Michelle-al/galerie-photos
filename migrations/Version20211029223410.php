<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211029223410 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE repertoire ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE repertoire ADD CONSTRAINT FK_3C367876FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_3C367876FB88E14F ON repertoire (utilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE repertoire DROP FOREIGN KEY FK_3C367876FB88E14F');
        $this->addSql('DROP INDEX IDX_3C367876FB88E14F ON repertoire');
        $this->addSql('ALTER TABLE repertoire DROP utilisateur_id');
    }
}
