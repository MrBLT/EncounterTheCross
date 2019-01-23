<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190108222704 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE markdown (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(31) NOT NULL, markdown LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_attendee DROP church, DROP invitedby');
        $this->addSql('ALTER TABLE event_server ADD contact_person_relationship VARCHAR(255) NOT NULL, ADD contact_person_phone VARCHAR(255) NOT NULL, DROP church, DROP invitedby');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE markdown');
        $this->addSql('ALTER TABLE event_attendee ADD church VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD invitedby VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE event_server ADD church VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD invitedby VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP contact_person_relationship, DROP contact_person_phone');
    }
}
