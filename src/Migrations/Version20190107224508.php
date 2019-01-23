<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190107224508 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE admin_user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', location_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', start DATETIME NOT NULL, end DATETIME NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_3BAE0AA764D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_attendee (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', event_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', launch_point_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', contact_person VARCHAR(255) NOT NULL, contact_person_relationship VARCHAR(255) NOT NULL, contact_person_phone VARCHAR(255) NOT NULL, church VARCHAR(255) NOT NULL, invitedby VARCHAR(255) NOT NULL, questions_or_comments LONGTEXT DEFAULT NULL, concerns LONGTEXT DEFAULT NULL, checked_in TINYINT(1) NOT NULL, phone VARCHAR(31) NOT NULL, address VARCHAR(255) NOT NULL, address2 VARCHAR(255) DEFAULT NULL, city VARCHAR(255) NOT NULL, state VARCHAR(31) NOT NULL, zipcode VARCHAR(10) NOT NULL, email VARCHAR(180) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, INDEX IDX_57BC3CB771F7E88B (event_id), INDEX IDX_57BC3CB7A495DAEF (launch_point_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_location (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, address2 VARCHAR(255) DEFAULT NULL, city VARCHAR(255) NOT NULL, state VARCHAR(2) NOT NULL, zipcode VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_server (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', event_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', launch_point_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', contact_person VARCHAR(255) NOT NULL, church VARCHAR(255) NOT NULL, invitedby VARCHAR(255) NOT NULL, duties_performed LONGTEXT DEFAULT NULL, concerns LONGTEXT DEFAULT NULL, phone VARCHAR(31) NOT NULL, address VARCHAR(255) NOT NULL, address2 VARCHAR(255) DEFAULT NULL, city VARCHAR(255) NOT NULL, state VARCHAR(31) NOT NULL, zipcode VARCHAR(10) NOT NULL, email VARCHAR(180) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, INDEX IDX_68F4A2A471F7E88B (event_id), INDEX IDX_68F4A2A4A495DAEF (launch_point_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE launch_point (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, address2 VARCHAR(255) DEFAULT NULL, city VARCHAR(255) NOT NULL, state VARCHAR(2) NOT NULL, zipcode VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testimonial (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', testimony VARCHAR(511) NOT NULL, full_name VARCHAR(255) DEFAULT NULL, allowed_to_publish TINYINT(1) NOT NULL, is_published TINYINT(1) NOT NULL, record_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA764D218E FOREIGN KEY (location_id) REFERENCES event_location (id)');
        $this->addSql('ALTER TABLE event_attendee ADD CONSTRAINT FK_57BC3CB771F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE event_attendee ADD CONSTRAINT FK_57BC3CB7A495DAEF FOREIGN KEY (launch_point_id) REFERENCES launch_point (id)');
        $this->addSql('ALTER TABLE event_server ADD CONSTRAINT FK_68F4A2A471F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE event_server ADD CONSTRAINT FK_68F4A2A4A495DAEF FOREIGN KEY (launch_point_id) REFERENCES launch_point (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event_attendee DROP FOREIGN KEY FK_57BC3CB771F7E88B');
        $this->addSql('ALTER TABLE event_server DROP FOREIGN KEY FK_68F4A2A471F7E88B');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA764D218E');
        $this->addSql('ALTER TABLE event_attendee DROP FOREIGN KEY FK_57BC3CB7A495DAEF');
        $this->addSql('ALTER TABLE event_server DROP FOREIGN KEY FK_68F4A2A4A495DAEF');
        $this->addSql('DROP TABLE admin_user');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_attendee');
        $this->addSql('DROP TABLE event_location');
        $this->addSql('DROP TABLE event_server');
        $this->addSql('DROP TABLE launch_point');
        $this->addSql('DROP TABLE testimonial');
    }
}
