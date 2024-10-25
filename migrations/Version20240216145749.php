<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240216145749 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_newsletter ADD cate_news_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_newsletter ADD CONSTRAINT FK_D9E24324F8DBB7D2 FOREIGN KEY (cate_news_id) REFERENCES nesletter_categorie (id)');
        $this->addSql('CREATE INDEX IDX_D9E24324F8DBB7D2 ON user_newsletter (cate_news_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_newsletter DROP FOREIGN KEY FK_D9E24324F8DBB7D2');
        $this->addSql('DROP INDEX IDX_D9E24324F8DBB7D2 ON user_newsletter');
        $this->addSql('ALTER TABLE user_newsletter DROP cate_news_id');
    }
}
