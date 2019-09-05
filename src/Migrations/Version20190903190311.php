<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190903190311 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE command_bis (id INT AUTO_INCREMENT NOT NULL, supply_food_id INT DEFAULT NULL, supply_office_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_B21CC595639DB69 (supply_food_id), INDEX IDX_B21CC59586D4A1E8 (supply_office_id), INDEX IDX_B21CC5959395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE command_bis ADD CONSTRAINT FK_B21CC595639DB69 FOREIGN KEY (supply_food_id) REFERENCES supply_food (id)');
        $this->addSql('ALTER TABLE command_bis ADD CONSTRAINT FK_B21CC59586D4A1E8 FOREIGN KEY (supply_office_id) REFERENCES supply_office (id)');
        $this->addSql('ALTER TABLE command_bis ADD CONSTRAINT FK_B21CC5959395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE command_bis');
    }
}
