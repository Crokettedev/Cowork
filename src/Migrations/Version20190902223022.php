<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190902223022 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE reservation_space (id INT AUTO_INCREMENT NOT NULL, space_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, begin_at VARCHAR(255) NOT NULL, end_at VARCHAR(255) NOT NULL, time_begin_at VARCHAR(255) NOT NULL, time_end_at VARCHAR(255) NOT NULL, INDEX IDX_6A0D119D23575340 (space_id), INDEX IDX_6A0D119D9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation_space ADD CONSTRAINT FK_6A0D119D23575340 FOREIGN KEY (space_id) REFERENCES space_private (id)');
        $this->addSql('ALTER TABLE reservation_space ADD CONSTRAINT FK_6A0D119D9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE reservation_space');

    }
}
