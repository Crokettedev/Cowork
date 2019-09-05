<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190905090107 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');


        $this->addSql('ALTER TABLE reservation_space ADD name_cart VARCHAR(255) NOT NULL, ADD num_cart VARCHAR(255) NOT NULL, ADD num_exp VARCHAR(255) NOT NULL, ADD num_cvv VARCHAR(255) NOT NULL, ADD price_total INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A0D119D3826374D ON reservation_space (begin_at)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A0D119D37D3107C ON reservation_space (end_at)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A0D119D9CA37481 ON reservation_space (time_begin_at)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A0D119D6E255F8A ON reservation_space (time_end_at)');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reservation_space DROP name_cart, DROP num_cart, DROP num_exp, DROP num_cvv, DROP price_total');

    }
}
