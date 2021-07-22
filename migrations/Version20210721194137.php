<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721194137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment_gym (comment_id INT NOT NULL, gym_id INT NOT NULL, INDEX IDX_90B59BDDF8697D13 (comment_id), INDEX IDX_90B59BDDBD2F03 (gym_id), PRIMARY KEY(comment_id, gym_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment_gym ADD CONSTRAINT FK_90B59BDDF8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment_gym ADD CONSTRAINT FK_90B59BDDBD2F03 FOREIGN KEY (gym_id) REFERENCES gym (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE comment_gym');
    }
}
