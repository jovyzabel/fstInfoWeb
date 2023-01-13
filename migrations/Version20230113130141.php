<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230113130141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_option ADD course_leader_id INT DEFAULT NULL, DROP label');
        $this->addSql('ALTER TABLE app_option ADD CONSTRAINT FK_BF856D30F1B40E78 FOREIGN KEY (course_leader_id) REFERENCES teacher (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BF856D30F1B40E78 ON app_option (course_leader_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_option DROP FOREIGN KEY FK_BF856D30F1B40E78');
        $this->addSql('DROP INDEX UNIQ_BF856D30F1B40E78 ON app_option');
        $this->addSql('ALTER TABLE app_option ADD label VARCHAR(255) DEFAULT NULL, DROP course_leader_id');
    }
}
