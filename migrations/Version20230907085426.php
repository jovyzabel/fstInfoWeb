<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230907085426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE baccalaureat_diploma (id INT AUTO_INCREMENT NOT NULL, serie VARCHAR(255) NOT NULL, titled VARCHAR(255) NOT NULL, year VARCHAR(255) NOT NULL, place_of_acquisition VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_person (id INT AUTO_INCREMENT NOT NULL, address_id INT NOT NULL, name VARCHAR(255) NOT NULL, job VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) NOT NULL, relation_link VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_A44EE6F7F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE identification_document (id INT AUTO_INCREMENT NOT NULL, type_of_document VARCHAR(255) DEFAULT NULL, identification_number VARCHAR(255) DEFAULT NULL, date_of_issue DATE DEFAULT NULL, place_of_issue VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE last_curriculum (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, semester_one_validation_year VARCHAR(255) NOT NULL, semester_one_average DOUBLE PRECISION NOT NULL, school VARCHAR(255) NOT NULL, semester_one_validation_session VARCHAR(255) NOT NULL, semester_two_validation_session VARCHAR(255) NOT NULL, semester_two_average DOUBLE PRECISION NOT NULL, semester_two_validation_year VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact_person ADD CONSTRAINT FK_A44EE6F7F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE account CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE pre_registration ADD baccalaureat_diploma_id INT NOT NULL, ADD last_curriculum_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pre_registration ADD CONSTRAINT FK_A2FEF1B9B08185A8 FOREIGN KEY (baccalaureat_diploma_id) REFERENCES baccalaureat_diploma (id)');
        $this->addSql('ALTER TABLE pre_registration ADD CONSTRAINT FK_A2FEF1B936E527BF FOREIGN KEY (last_curriculum_id) REFERENCES last_curriculum (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A2FEF1B9B08185A8 ON pre_registration (baccalaureat_diploma_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A2FEF1B936E527BF ON pre_registration (last_curriculum_id)');
        $this->addSql('ALTER TABLE student ADD identification_document_id INT DEFAULT NULL, ADD contact_person_id INT NOT NULL, ADD married_name VARCHAR(255) DEFAULT NULL, ADD last_school VARCHAR(255) NOT NULL, ADD last_diploma VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF3326C8341 FOREIGN KEY (identification_document_id) REFERENCES identification_document (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF334F8A983C FOREIGN KEY (contact_person_id) REFERENCES contact_person (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF3326C8341 ON student (identification_document_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF334F8A983C ON student (contact_person_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pre_registration DROP FOREIGN KEY FK_A2FEF1B9B08185A8');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF334F8A983C');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF3326C8341');
        $this->addSql('ALTER TABLE pre_registration DROP FOREIGN KEY FK_A2FEF1B936E527BF');
        $this->addSql('ALTER TABLE contact_person DROP FOREIGN KEY FK_A44EE6F7F5B7AF75');
        $this->addSql('DROP TABLE baccalaureat_diploma');
        $this->addSql('DROP TABLE contact_person');
        $this->addSql('DROP TABLE identification_document');
        $this->addSql('DROP TABLE last_curriculum');
        $this->addSql('ALTER TABLE account CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('DROP INDEX UNIQ_B723AF3326C8341 ON student');
        $this->addSql('DROP INDEX UNIQ_B723AF334F8A983C ON student');
        $this->addSql('ALTER TABLE student DROP identification_document_id, DROP contact_person_id, DROP married_name, DROP last_school, DROP last_diploma');
        $this->addSql('DROP INDEX UNIQ_A2FEF1B9B08185A8 ON pre_registration');
        $this->addSql('DROP INDEX UNIQ_A2FEF1B936E527BF ON pre_registration');
        $this->addSql('ALTER TABLE pre_registration DROP baccalaureat_diploma_id, DROP last_curriculum_id');
    }
}
