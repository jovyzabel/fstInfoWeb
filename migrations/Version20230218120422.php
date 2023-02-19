<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230218120422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE FULLTEXT INDEX search_index ON formation_cycle (label, description)');
        $this->addSql('CREATE FULLTEXT INDEX search_index ON speciality (label, description)');
        $this->addSql('CREATE FULLTEXT INDEX search_index ON teacher (name, first_name)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX search_index ON teacher');
        $this->addSql('DROP INDEX search_index ON formation_cycle');
        $this->addSql('DROP INDEX search_index ON speciality');
    }
}
