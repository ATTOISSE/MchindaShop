<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231216233309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_details (id INT AUTO_INCREMENT NOT NULL, orders_id INT DEFAULT NULL, products_id INT DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_845CA2C1CFFE9AD6 (orders_id), INDEX IDX_845CA2C16C8A81A9 (products_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_details ADD CONSTRAINT FK_845CA2C1CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_details ADD CONSTRAINT FK_845CA2C16C8A81A9 FOREIGN KEY (products_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE `order` ADD users_id INT NOT NULL, ADD reference VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939867B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F5299398AEA34913 ON `order` (reference)');
        $this->addSql('CREATE INDEX IDX_F529939867B3B43D ON `order` (users_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_details DROP FOREIGN KEY FK_845CA2C1CFFE9AD6');
        $this->addSql('ALTER TABLE order_details DROP FOREIGN KEY FK_845CA2C16C8A81A9');
        $this->addSql('DROP TABLE order_details');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939867B3B43D');
        $this->addSql('DROP INDEX UNIQ_F5299398AEA34913 ON `order`');
        $this->addSql('DROP INDEX IDX_F529939867B3B43D ON `order`');
        $this->addSql('ALTER TABLE `order` DROP users_id, DROP reference');
    }
}
