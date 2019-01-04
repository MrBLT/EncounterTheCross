<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190104225921 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event_attendee CHANGE phone phone VARCHAR(31) NOT NULL, CHANGE state state VARCHAR(31) NOT NULL');
        $this->addSql('ALTER TABLE event_server CHANGE phone phone VARCHAR(31) NOT NULL, CHANGE state state VARCHAR(31) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event_attendee CHANGE phone phone VARCHAR(15) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE state state VARCHAR(2) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE event_server CHANGE phone phone VARCHAR(15) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE state state VARCHAR(2) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
