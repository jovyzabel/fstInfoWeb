<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230113084955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7D3656A4E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, street_name VARCHAR(255) DEFAULT NULL, street_number INT DEFAULT NULL, quater_name VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alumni (id INT AUTO_INCREMENT NOT NULL, promotion_id INT DEFAULT NULL, account_id INT DEFAULT NULL, picture_name VARCHAR(255) NOT NULL, civility VARCHAR(40) NOT NULL, description LONGTEXT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, nationality VARCHAR(255) DEFAULT NULL, profil VARCHAR(255) NOT NULL, testimonial LONGTEXT DEFAULT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_FD567018139DF194 (promotion_id), UNIQUE INDEX UNIQ_FD5670189B6B5FBA (account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_option (id INT AUTO_INCREMENT NOT NULL, is_pre_enroll_period TINYINT(1) NOT NULL, display_ciscoon_carousel TINYINT(1) NOT NULL, label VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, account_id INT NOT NULL, featured_image_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', slug VARCHAR(255) NOT NULL, is_on_carousel TINYINT(1) DEFAULT NULL, INDEX IDX_23A0E669B6B5FBA (account_id), INDEX IDX_23A0E663569D950 (featured_image_id), FULLTEXT INDEX search_index (title, content), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_category (article_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_53A4EDAA7294869C (article_id), INDEX IDX_53A4EDAA12469DE2 (category_id), PRIMARY KEY(article_id, category_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, folder_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, document_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL, INDEX IDX_D8698A76162CB942 (folder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE folder (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_cycle (id INT AUTO_INCREMENT NOT NULL, featured_image_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C60D4FE63569D950 (featured_image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, filename VARCHAR(255) NOT NULL, alt_text VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, logo_name VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pre_registration (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, folder_id INT DEFAULT NULL, speciality_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_A2FEF1B9CB944F1A (student_id), UNIQUE INDEX UNIQ_A2FEF1B9162CB942 (folder_id), INDEX IDX_A2FEF1B93B5A08D7 (speciality_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semester (id INT AUTO_INCREMENT NOT NULL, semester_type_id INT DEFAULT NULL, speciality_id INT DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_F7388EED63C5C57C (semester_type_id), INDEX IDX_F7388EED3B5A08D7 (speciality_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semester_type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE speciality (id INT AUTO_INCREMENT NOT NULL, formation_cycle_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, goals LONGTEXT DEFAULT NULL, targeted_skills LONGTEXT DEFAULT NULL, careers LONGTEXT DEFAULT NULL, INDEX IDX_F3D7A08EC27E4693 (formation_cycle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, account_id INT DEFAULT NULL, picture_name VARCHAR(255) NOT NULL, civility VARCHAR(40) NOT NULL, description LONGTEXT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, nationality VARCHAR(255) DEFAULT NULL, birth_day DATE NOT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_B723AF33F5B7AF75 (address_id), UNIQUE INDEX UNIQ_B723AF339B6B5FBA (account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id INT AUTO_INCREMENT NOT NULL, ue_id INT DEFAULT NULL, teacher_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, credits DOUBLE PRECISION DEFAULT NULL, INDEX IDX_FBCE3E7A62E883B1 (ue_id), INDEX IDX_FBCE3E7A41807E1D (teacher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_article (tag_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_300B23CCBAD26311 (tag_id), INDEX IDX_300B23CC7294869C (article_id), PRIMARY KEY(tag_id, article_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher (id INT AUTO_INCREMENT NOT NULL, account_id INT DEFAULT NULL, picture_name VARCHAR(255) NOT NULL, civility VARCHAR(40) NOT NULL, description LONGTEXT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, nationality VARCHAR(255) DEFAULT NULL, diploma VARCHAR(255) NOT NULL, place_of_acquisition VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_B0F6A6D59B6B5FBA (account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ue (id INT AUTO_INCREMENT NOT NULL, semester_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, code VARCHAR(255) DEFAULT NULL, credits DOUBLE PRECISION DEFAULT NULL, INDEX IDX_2E490A9B4A798B6F (semester_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alumni ADD CONSTRAINT FK_FD567018139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id)');
        $this->addSql('ALTER TABLE alumni ADD CONSTRAINT FK_FD5670189B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E669B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E663569D950 FOREIGN KEY (featured_image_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE article_category ADD CONSTRAINT FK_53A4EDAA7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_category ADD CONSTRAINT FK_53A4EDAA12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76162CB942 FOREIGN KEY (folder_id) REFERENCES folder (id)');
        $this->addSql('ALTER TABLE formation_cycle ADD CONSTRAINT FK_C60D4FE63569D950 FOREIGN KEY (featured_image_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE pre_registration ADD CONSTRAINT FK_A2FEF1B9CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE pre_registration ADD CONSTRAINT FK_A2FEF1B9162CB942 FOREIGN KEY (folder_id) REFERENCES folder (id)');
        $this->addSql('ALTER TABLE pre_registration ADD CONSTRAINT FK_A2FEF1B93B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id)');
        $this->addSql('ALTER TABLE semester ADD CONSTRAINT FK_F7388EED63C5C57C FOREIGN KEY (semester_type_id) REFERENCES semester_type (id)');
        $this->addSql('ALTER TABLE semester ADD CONSTRAINT FK_F7388EED3B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id)');
        $this->addSql('ALTER TABLE speciality ADD CONSTRAINT FK_F3D7A08EC27E4693 FOREIGN KEY (formation_cycle_id) REFERENCES formation_cycle (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF339B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7A62E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id)');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7A41807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id)');
        $this->addSql('ALTER TABLE tag_article ADD CONSTRAINT FK_300B23CCBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_article ADD CONSTRAINT FK_300B23CC7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teacher ADD CONSTRAINT FK_B0F6A6D59B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE ue ADD CONSTRAINT FK_2E490A9B4A798B6F FOREIGN KEY (semester_id) REFERENCES semester (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alumni DROP FOREIGN KEY FK_FD567018139DF194');
        $this->addSql('ALTER TABLE alumni DROP FOREIGN KEY FK_FD5670189B6B5FBA');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E669B6B5FBA');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E663569D950');
        $this->addSql('ALTER TABLE article_category DROP FOREIGN KEY FK_53A4EDAA7294869C');
        $this->addSql('ALTER TABLE article_category DROP FOREIGN KEY FK_53A4EDAA12469DE2');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76162CB942');
        $this->addSql('ALTER TABLE formation_cycle DROP FOREIGN KEY FK_C60D4FE63569D950');
        $this->addSql('ALTER TABLE pre_registration DROP FOREIGN KEY FK_A2FEF1B9CB944F1A');
        $this->addSql('ALTER TABLE pre_registration DROP FOREIGN KEY FK_A2FEF1B9162CB942');
        $this->addSql('ALTER TABLE pre_registration DROP FOREIGN KEY FK_A2FEF1B93B5A08D7');
        $this->addSql('ALTER TABLE semester DROP FOREIGN KEY FK_F7388EED63C5C57C');
        $this->addSql('ALTER TABLE semester DROP FOREIGN KEY FK_F7388EED3B5A08D7');
        $this->addSql('ALTER TABLE speciality DROP FOREIGN KEY FK_F3D7A08EC27E4693');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33F5B7AF75');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF339B6B5FBA');
        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7A62E883B1');
        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7A41807E1D');
        $this->addSql('ALTER TABLE tag_article DROP FOREIGN KEY FK_300B23CCBAD26311');
        $this->addSql('ALTER TABLE tag_article DROP FOREIGN KEY FK_300B23CC7294869C');
        $this->addSql('ALTER TABLE teacher DROP FOREIGN KEY FK_B0F6A6D59B6B5FBA');
        $this->addSql('ALTER TABLE ue DROP FOREIGN KEY FK_2E490A9B4A798B6F');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE alumni');
        $this->addSql('DROP TABLE app_option');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_category');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE folder');
        $this->addSql('DROP TABLE formation_cycle');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE pre_registration');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP TABLE semester');
        $this->addSql('DROP TABLE semester_type');
        $this->addSql('DROP TABLE speciality');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_article');
        $this->addSql('DROP TABLE teacher');
        $this->addSql('DROP TABLE ue');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
