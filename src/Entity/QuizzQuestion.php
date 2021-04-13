<?php

namespace App\Entity;

use App\Repository\QuizzQuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuizzQuestionRepository::class)
 */
class QuizzQuestion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $result;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="quizzQuestions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $question_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quizz_id;

    /**
     * @ORM\ManyToOne(targetEntity=Quizz::class, inversedBy="quizzQuestions")
     */
    private $quizz;

    /**
     * @ORM\OneToMany(targetEntity=AnswerQuizzQuestion::class, mappedBy="quizz_question_id", orphanRemoval=true)
     */
    private $answersQuizzQuestion;

    public function __construct()
    {
        $this->answersQuizzQuestion = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getResult(): ?bool
    {
        return $this->result;
    }

    public function setResult(?bool $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getQuestionId(): ?int
    {
        return $this->question_id;
    }

    public function setQuestionId(?int $question_id): self
    {
        $this->question_id = $question_id;

        return $this;
    }

    public function getQuizzId(): ?int
    {
        return $this->quizz_id;
    }

    public function setQuizzId(int $quizz_id): self
    {
        $this->quizz_id = $quizz_id;

        return $this;
    }

    public function getQuizz(): ?Quizz
    {
        return $this->quizz;
    }

    public function setQuizz(?Quizz $quizz): self
    {
        $this->quizz = $quizz;

        return $this;
    }

    /**
     * @return Collection|AnswerQuizzQuestion[]
     */
    public function getAnswersQuizzQuestion(): Collection
    {
        return $this->answersQuizzQuestion;
    }

    public function addAnswersQuizzQuestion(AnswerQuizzQuestion $answersQuizzQuestion): self
    {
        if (!$this->answersQuizzQuestion->contains($answersQuizzQuestion)) {
            $this->answersQuizzQuestion[] = $answersQuizzQuestion;
            $answersQuizzQuestion->setQuizzQuestionId($this);
        }

        return $this;
    }

    public function removeAnswersQuizzQuestion(AnswerQuizzQuestion $answersQuizzQuestion): self
    {
        if ($this->answersQuizzQuestion->removeElement($answersQuizzQuestion)) {
            // set the owning side to null (unless already changed)
            if ($answersQuizzQuestion->getQuizzQuestionId() === $this) {
                $answersQuizzQuestion->setQuizzQuestionId(null);
            }
        }

        return $this;
    }
}
