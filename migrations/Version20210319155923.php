<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210319155923 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quizz CHANGE user_id player_id INT NOT NULL');
        $this->addSql('ALTER TABLE quizz ADD CONSTRAINT FK_7C77973D99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('CREATE INDEX IDX_7C77973D99E6F5DF ON quizz (player_id)');
        $this->addSql('ALTER TABLE quizz_question DROP FOREIGN KEY FK_3723B55C1E27F6BF');
        $this->addSql('ALTER TABLE quizz_question DROP FOREIGN KEY FK_3723B55CBA934BCD');
        $this->addSql('ALTER TABLE quizz_question ADD id INT AUTO_INCREMENT NOT NULL, ADD number INT DEFAULT NULL, ADD result TINYINT(1) DEFAULT NULL, CHANGE question_id question_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE quizz_question ADD CONSTRAINT FK_3723B55C1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE quizz_question ADD CONSTRAINT FK_3723B55CBA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quizz DROP FOREIGN KEY FK_7C77973D99E6F5DF');
        $this->addSql('DROP INDEX IDX_7C77973D99E6F5DF ON quizz');
        $this->addSql('ALTER TABLE quizz CHANGE player_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE quizz_question MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE quizz_question DROP FOREIGN KEY FK_3723B55C1E27F6BF');
        $this->addSql('ALTER TABLE quizz_question DROP FOREIGN KEY FK_3723B55CBA934BCD');
        $this->addSql('ALTER TABLE quizz_question DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE quizz_question DROP id, DROP number, DROP result, CHANGE question_id question_id INT NOT NULL');
        $this->addSql('ALTER TABLE quizz_question ADD CONSTRAINT FK_3723B55C1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quizz_question ADD CONSTRAINT FK_3723B55CBA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quizz_question ADD PRIMARY KEY (quizz_id, question_id)');
    }
}
