<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221206222943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alumni ADD promotion_id INT DEFAULT NULL, ADD account_id INT DEFAULT NULL, ADD avatar_name VARCHAR(255) NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD name VARCHAR(255) NOT NULL, ADD first_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE alumni ADD CONSTRAINT FK_FD567018139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id)');
        $this->addSql('ALTER TABLE alumni ADD CONSTRAINT FK_FD5670189B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FD567018139DF194 ON alumni (promotion_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FD5670189B6B5FBA ON alumni (account_id)');
        $this->addSql('ALTER TABLE promotion DROP FOREIGN KEY FK_C11D7DD185F6AD5D');
        $this->addSql('DROP INDEX IDX_C11D7DD185F6AD5D ON promotion');
        $this->addSql('ALTER TABLE promotion DROP alumnies_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alumni DROP FOREIGN KEY FK_FD567018139DF194');
        $this->addSql('ALTER TABLE alumni DROP FOREIGN KEY FK_FD5670189B6B5FBA');
        $this->addSql('DROP INDEX UNIQ_FD567018139DF194 ON alumni');
        $this->addSql('DROP INDEX UNIQ_FD5670189B6B5FBA ON alumni');
        $this->addSql('ALTER TABLE alumni DROP promotion_id, DROP account_id, DROP avatar_name, DROP created_at, DROP updated_at, DROP name, DROP first_name');
        $this->addSql('ALTER TABLE promotion ADD alumnies_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD185F6AD5D FOREIGN KEY (alumnies_id) REFERENCES alumni (id)');
        $this->addSql('CREATE INDEX IDX_C11D7DD185F6AD5D ON promotion (alumnies_id)');
    }
}
