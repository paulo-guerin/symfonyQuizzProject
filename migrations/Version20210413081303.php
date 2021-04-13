<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210413081303 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer_quizz_question (id INT AUTO_INCREMENT NOT NULL, quizz_question_id_id INT NOT NULL, answer_id_id INT NOT NULL, player_answer TINYINT(1) NOT NULL, INDEX IDX_9BD1EA39C5B4CEE6 (quizz_question_id_id), INDEX IDX_9BD1EA39E47E7704 (answer_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer_quizz_question ADD CONSTRAINT FK_9BD1EA39C5B4CEE6 FOREIGN KEY (quizz_question_id_id) REFERENCES quizz_question (id)');
        $this->addSql('ALTER TABLE answer_quizz_question ADD CONSTRAINT FK_9BD1EA39E47E7704 FOREIGN KEY (answer_id_id) REFERENCES answer (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE answer_quizz_question');
    }
}
