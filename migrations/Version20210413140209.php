<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210413140209 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer_quizz_question DROP FOREIGN KEY FK_9BD1EA39C5B4CEE6');
        $this->addSql('ALTER TABLE answer_quizz_question DROP FOREIGN KEY FK_9BD1EA39E47E7704');
        $this->addSql('DROP INDEX IDX_9BD1EA39E47E7704 ON answer_quizz_question');
        $this->addSql('DROP INDEX IDX_9BD1EA39C5B4CEE6 ON answer_quizz_question');
        $this->addSql('ALTER TABLE answer_quizz_question ADD quizz_question_id INT NOT NULL, ADD answer_id INT NOT NULL, DROP quizz_question_id_id, DROP answer_id_id');
        $this->addSql('ALTER TABLE answer_quizz_question ADD CONSTRAINT FK_9BD1EA393832395C FOREIGN KEY (quizz_question_id) REFERENCES quizz_question (id)');
        $this->addSql('ALTER TABLE answer_quizz_question ADD CONSTRAINT FK_9BD1EA39AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id)');
        $this->addSql('CREATE INDEX IDX_9BD1EA393832395C ON answer_quizz_question (quizz_question_id)');
        $this->addSql('CREATE INDEX IDX_9BD1EA39AA334807 ON answer_quizz_question (answer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer_quizz_question DROP FOREIGN KEY FK_9BD1EA393832395C');
        $this->addSql('ALTER TABLE answer_quizz_question DROP FOREIGN KEY FK_9BD1EA39AA334807');
        $this->addSql('DROP INDEX IDX_9BD1EA393832395C ON answer_quizz_question');
        $this->addSql('DROP INDEX IDX_9BD1EA39AA334807 ON answer_quizz_question');
        $this->addSql('ALTER TABLE answer_quizz_question ADD quizz_question_id_id INT NOT NULL, ADD answer_id_id INT NOT NULL, DROP quizz_question_id, DROP answer_id');
        $this->addSql('ALTER TABLE answer_quizz_question ADD CONSTRAINT FK_9BD1EA39C5B4CEE6 FOREIGN KEY (quizz_question_id_id) REFERENCES quizz_question (id)');
        $this->addSql('ALTER TABLE answer_quizz_question ADD CONSTRAINT FK_9BD1EA39E47E7704 FOREIGN KEY (answer_id_id) REFERENCES answer (id)');
        $this->addSql('CREATE INDEX IDX_9BD1EA39E47E7704 ON answer_quizz_question (answer_id_id)');
        $this->addSql('CREATE INDEX IDX_9BD1EA39C5B4CEE6 ON answer_quizz_question (quizz_question_id_id)');
    }
}
