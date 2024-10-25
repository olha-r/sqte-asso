<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240216160858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE newsletter ADD cat_news_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE newsletter ADD CONSTRAINT FK_7E8585C89515DBF6 FOREIGN KEY (cat_news_id) REFERENCES nesletter_categorie (id)');
        $this->addSql('CREATE INDEX IDX_7E8585C89515DBF6 ON newsletter (cat_news_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE newsletter DROP FOREIGN KEY FK_7E8585C89515DBF6');
        $this->addSql('DROP INDEX IDX_7E8585C89515DBF6 ON newsletter');
        $this->addSql('ALTER TABLE newsletter DROP cat_news_id');
    }
}
