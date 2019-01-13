<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190113140411 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE announcement ADD vehicle_id INT DEFAULT NULL, ADD real_estate_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91C545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91C1E4EB97C FOREIGN KEY (real_estate_id) REFERENCES real_estate (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4DB9D91C545317D1 ON announcement (vehicle_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4DB9D91C1E4EB97C ON announcement (real_estate_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE announcement DROP FOREIGN KEY FK_4DB9D91C545317D1');
        $this->addSql('ALTER TABLE announcement DROP FOREIGN KEY FK_4DB9D91C1E4EB97C');
        $this->addSql('DROP INDEX UNIQ_4DB9D91C545317D1 ON announcement');
        $this->addSql('DROP INDEX UNIQ_4DB9D91C1E4EB97C ON announcement');
        $this->addSql('ALTER TABLE announcement DROP vehicle_id, DROP real_estate_id');
    }
}
