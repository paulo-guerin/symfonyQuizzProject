<?php

namespace App\Entity;

use App\Repository\AnswerQuizzQuestionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnswerQuizzQuestionRepository::class)
 */
class AnswerQuizzQuestion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $player_answer;

    /**
     * @ORM\ManyToOne(targetEntity=QuizzQuestion::class, inversedBy="answersQuizzQuestion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $quizzQuestion;

    /**
     * @ORM\ManyToOne(targetEntity=Answer::class, inversedBy="answersQuizzQuestion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $answer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayerAnswer(): ?bool
    {
        return $this->player_answer;
    }

    public function setPlayerAnswer(bool $player_answer): self
    {
        $this->player_answer = $player_answer;

        return $this;
    }

    public function getQuizzQuestionId(): ?QuizzQuestion
    {
        return $this->quizz_question_id;
    }

    public function setQuizzQuestion(?QuizzQuestion $quizzQuestion): self
    {
        $this->quizzQuestion = $quizzQuestion;

        return $this;
    }

    public function getAnswerId(): ?Answer
    {
        return $this->answer_id;
    }

    public function setAnswer(?Answer $answer): self
    {
        $this->answer = $answer;

        return $this;
    }
}
