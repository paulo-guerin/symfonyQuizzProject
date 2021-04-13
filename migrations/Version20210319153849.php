<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210319153849 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quizz (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, score INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz_question (quizz_id INT NOT NULL, question_id INT NOT NULL, INDEX IDX_3723B55CBA934BCD (quizz_id), INDEX IDX_3723B55C1E27F6BF (question_id), PRIMARY KEY(quizz_id, question_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quizz_question ADD CONSTRAINT FK_3723B55CBA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quizz_question ADD CONSTRAINT FK_3723B55C1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quizz_question DROP FOREIGN KEY FK_3723B55CBA934BCD');
        $this->addSql('DROP TABLE quizz');
        $this->addSql('DROP TABLE quizz_question');
    }
}
