<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190113182437 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE real_estate DROP FOREIGN KEY FK_DE4E97A8913AEA17');
        $this->addSql('DROP INDEX UNIQ_DE4E97A8913AEA17 ON real_estate');
        $this->addSql('ALTER TABLE real_estate DROP announcement_id');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486913AEA17');
        $this->addSql('DROP INDEX UNIQ_1B80E486913AEA17 ON vehicle');
        $this->addSql('ALTER TABLE vehicle DROP announcement_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE real_estate ADD announcement_id INT NOT NULL');
        $this->addSql('ALTER TABLE real_estate ADD CONSTRAINT FK_DE4E97A8913AEA17 FOREIGN KEY (announcement_id) REFERENCES announcement (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DE4E97A8913AEA17 ON real_estate (announcement_id)');
        $this->addSql('ALTER TABLE vehicle ADD announcement_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486913AEA17 FOREIGN KEY (announcement_id) REFERENCES announcement (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1B80E486913AEA17 ON vehicle (announcement_id)');
    }
}
