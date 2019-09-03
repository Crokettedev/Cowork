<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190902224041 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE23575340');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE9395C3F3');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEDA6A219');
        $this->addSql('ALTER TABLE booking CHANGE title title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE23575340 FOREIGN KEY (space_id) REFERENCES space_private (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEDA6A219 FOREIGN KEY (place_id) REFERENCES place_public (id)');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7A76ED395');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7BA8E87C4');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7FFA0C224');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7BA8E87C4 FOREIGN KEY (food_id) REFERENCES supply_food (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7FFA0C224 FOREIGN KEY (office_id) REFERENCES supply_office (id)');
        $this->addSql('ALTER TABLE supply_food CHANGE created_at created_at DATETIME NOT NULL, CHANGE filename filename VARCHAR(255) NOT NULL, CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE space_public CHANGE created_at created_at DATETIME NOT NULL, CHANGE image image VARCHAR(255) NOT NULL, CHANGE update_at update_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE job_posts DROP FOREIGN KEY FK_8901078A9395C3F3');
        $this->addSql('ALTER TABLE job_posts CHANGE author author VARCHAR(255) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE job_posts ADD CONSTRAINT FK_8901078A9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A0D119D3826374D ON reservation_space (begin_at)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A0D119D37D3107C ON reservation_space (end_at)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A0D119D9CA37481 ON reservation_space (time_begin_at)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A0D119D6E255F8A ON reservation_space (time_end_at)');
        $this->addSql('ALTER TABLE customer CHANGE society society VARCHAR(255) NOT NULL, CHANGE points points INT DEFAULT 10 NOT NULL, CHANGE filename filename VARCHAR(255) NOT NULL, CHANGE update_at update_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE message_job DROP FOREIGN KEY FK_D2ED6A1435EE28F1');
        $this->addSql('ALTER TABLE message_job DROP FOREIGN KEY FK_D2ED6A14537A1329');
        $this->addSql('ALTER TABLE message_job DROP FOREIGN KEY FK_D2ED6A145754A792');
        $this->addSql('ALTER TABLE message_job ADD CONSTRAINT FK_D2ED6A1435EE28F1 FOREIGN KEY (customer_msg_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE message_job ADD CONSTRAINT FK_D2ED6A14537A1329 FOREIGN KEY (message_id) REFERENCES job_posts (id)');
        $this->addSql('ALTER TABLE message_job ADD CONSTRAINT FK_D2ED6A145754A792 FOREIGN KEY (customer_post_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE place_public ADD customer_id INT DEFAULT NULL, ADD begin_at DATETIME NOT NULL, ADD end_at DATETIME NOT NULL, ADD disponible TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE place_public ADD CONSTRAINT FK_997A29749395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_997A29749395C3F3 ON place_public (customer_id)');
        $this->addSql('ALTER TABLE command CHANGE num_cart num_cart INT NOT NULL');
        $this->addSql('ALTER TABLE supply_office CHANGE created_at created_at DATETIME NOT NULL, CHANGE update_at update_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE register_post DROP FOREIGN KEY FK_8EED7C2D4B89032C');
        $this->addSql('ALTER TABLE register_post DROP FOREIGN KEY FK_8EED7C2DA76ED395');
        $this->addSql('ALTER TABLE register_post CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE register_post ADD CONSTRAINT FK_8EED7C2D4B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE register_post ADD CONSTRAINT FK_8EED7C2DA76ED395 FOREIGN KEY (user_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE posts CHANGE content content VARCHAR(255) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE update_at update_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEDA6A219');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE9395C3F3');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE23575340');
        $this->addSql('ALTER TABLE booking CHANGE title title VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEDA6A219 FOREIGN KEY (place_id) REFERENCES place_public (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE23575340 FOREIGN KEY (space_id) REFERENCES space_private (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7A76ED395');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7BA8E87C4');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7FFA0C224');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES customer (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7BA8E87C4 FOREIGN KEY (food_id) REFERENCES supply_food (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7FFA0C224 FOREIGN KEY (office_id) REFERENCES supply_office (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE command CHANGE num_cart num_cart VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE customer CHANGE filename filename VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE society society VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE points points INT DEFAULT 0, CHANGE update_at update_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE job_posts DROP FOREIGN KEY FK_8901078A9395C3F3');
        $this->addSql('ALTER TABLE job_posts CHANGE author author VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE job_posts ADD CONSTRAINT FK_8901078A9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_job DROP FOREIGN KEY FK_D2ED6A14537A1329');
        $this->addSql('ALTER TABLE message_job DROP FOREIGN KEY FK_D2ED6A1435EE28F1');
        $this->addSql('ALTER TABLE message_job DROP FOREIGN KEY FK_D2ED6A145754A792');
        $this->addSql('ALTER TABLE message_job ADD CONSTRAINT FK_D2ED6A14537A1329 FOREIGN KEY (message_id) REFERENCES job_posts (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_job ADD CONSTRAINT FK_D2ED6A1435EE28F1 FOREIGN KEY (customer_msg_id) REFERENCES customer (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_job ADD CONSTRAINT FK_D2ED6A145754A792 FOREIGN KEY (customer_post_id) REFERENCES customer (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE place_public DROP FOREIGN KEY FK_997A29749395C3F3');
        $this->addSql('DROP INDEX IDX_997A29749395C3F3 ON place_public');
        $this->addSql('ALTER TABLE place_public DROP customer_id, DROP begin_at, DROP end_at, DROP disponible');
        $this->addSql('ALTER TABLE posts CHANGE content content LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE update_at update_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE register_post DROP FOREIGN KEY FK_8EED7C2D4B89032C');
        $this->addSql('ALTER TABLE register_post DROP FOREIGN KEY FK_8EED7C2DA76ED395');
        $this->addSql('ALTER TABLE register_post CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE register_post ADD CONSTRAINT FK_8EED7C2D4B89032C FOREIGN KEY (post_id) REFERENCES posts (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE register_post ADD CONSTRAINT FK_8EED7C2DA76ED395 FOREIGN KEY (user_id) REFERENCES customer (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX UNIQ_6A0D119D3826374D ON reservation_space');
        $this->addSql('DROP INDEX UNIQ_6A0D119D37D3107C ON reservation_space');
        $this->addSql('DROP INDEX UNIQ_6A0D119D9CA37481 ON reservation_space');
        $this->addSql('DROP INDEX UNIQ_6A0D119D6E255F8A ON reservation_space');
        $this->addSql('ALTER TABLE space_public CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE update_at update_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE supply_food CHANGE filename filename VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE supply_office CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE update_at update_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
    }
}
