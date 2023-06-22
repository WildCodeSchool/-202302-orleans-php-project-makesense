<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230622095306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE approve (user_id INT NOT NULL, decision_id INT NOT NULL, INDEX IDX_845DDA8CA76ED395 (user_id), INDEX IDX_845DDA8CBDEE7539 (decision_id), PRIMARY KEY(user_id, decision_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE approve ADD CONSTRAINT FK_845DDA8CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE approve ADD CONSTRAINT FK_845DDA8CBDEE7539 FOREIGN KEY (decision_id) REFERENCES decision (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE approve DROP FOREIGN KEY FK_845DDA8CA76ED395');
        $this->addSql('ALTER TABLE approve DROP FOREIGN KEY FK_845DDA8CBDEE7539');
        $this->addSql('DROP TABLE approve');
    }
}
