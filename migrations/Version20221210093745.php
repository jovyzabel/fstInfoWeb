<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221210093745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE semester ADD speciality_id INT DEFAULT NULL, DROP label');
        $this->addSql('ALTER TABLE semester ADD CONSTRAINT FK_F7388EED3B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id)');
        $this->addSql('CREATE INDEX IDX_F7388EED3B5A08D7 ON semester (speciality_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE semester DROP FOREIGN KEY FK_F7388EED3B5A08D7');
        $this->addSql('DROP INDEX IDX_F7388EED3B5A08D7 ON semester');
        $this->addSql('ALTER TABLE semester ADD label VARCHAR(255) NOT NULL, DROP speciality_id');
    }
}
