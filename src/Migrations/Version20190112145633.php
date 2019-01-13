<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190112145633 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE announcement (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, job_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_4DB9D91CA76ED395 (user_id), UNIQUE INDEX UNIQ_4DB9D91CBE04EA9 (job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, salary INT NOT NULL, contract VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE real_estate (id INT AUTO_INCREMENT NOT NULL, announcement_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, area INT NOT NULL, UNIQUE INDEX UNIQ_DE4E97A8913AEA17 (announcement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, announcement_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, fuel_type LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_1B80E486913AEA17 (announcement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91CBE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE real_estate ADD CONSTRAINT FK_DE4E97A8913AEA17 FOREIGN KEY (announcement_id) REFERENCES announcement (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486913AEA17 FOREIGN KEY (announcement_id) REFERENCES announcement (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE real_estate DROP FOREIGN KEY FK_DE4E97A8913AEA17');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486913AEA17');
        $this->addSql('ALTER TABLE announcement DROP FOREIGN KEY FK_4DB9D91CBE04EA9');
        $this->addSql('ALTER TABLE announcement DROP FOREIGN KEY FK_4DB9D91CA76ED395');
        $this->addSql('DROP TABLE announcement');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE real_estate');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vehicle');
    }
}
