<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190122125132 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adherent CHANGE datenaiss datenaiss DATE DEFAULT NULL, CHANGE date_creation date_creation DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE cotisation CHANGE id_adherent id_adherent INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE informationsup CHANGE date_creation date_creation DATETIME NOT NULL');
        $this->addSql('ALTER TABLE paiement CHANGE type_paiement type_paiement INT AUTO_INCREMENT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE adherent CHANGE datenaiss datenaiss VARCHAR(1000) DEFAULT NULL COLLATE utf8_general_ci, CHANGE date_creation date_creation DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE cotisation CHANGE id_adherent id_adherent INT NOT NULL');
        $this->addSql('ALTER TABLE informationsup CHANGE date_creation date_creation DATE NOT NULL');
        $this->addSql('ALTER TABLE paiement CHANGE type_paiement type_paiement INT NOT NULL');
    }
}
