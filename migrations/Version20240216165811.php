<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240216165811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_newsletter ADD cat_user_new_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_newsletter ADD CONSTRAINT FK_D9E243241233882F FOREIGN KEY (cat_user_new_id) REFERENCES nesletter_categorie (id)');
        $this->addSql('CREATE INDEX IDX_D9E243241233882F ON user_newsletter (cat_user_new_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_newsletter DROP FOREIGN KEY FK_D9E243241233882F');
        $this->addSql('DROP INDEX IDX_D9E243241233882F ON user_newsletter');
        $this->addSql('ALTER TABLE user_newsletter DROP cat_user_new_id');
    }
}
