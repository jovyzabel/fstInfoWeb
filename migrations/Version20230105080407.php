<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230105080407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_option ADD is_pre_enroll_period TINYINT(1) NOT NULL, ADD display_ciscoon_carousel TINYINT(1) NOT NULL, DROP label, DROP name, DROP value, DROP type');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_option ADD label VARCHAR(255) DEFAULT NULL, ADD name VARCHAR(255) NOT NULL, ADD value VARCHAR(255) DEFAULT NULL, ADD type VARCHAR(255) NOT NULL, DROP is_pre_enroll_period, DROP display_ciscoon_carousel');
    }
}
