<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnswerRepository::class)
 */
class Answer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $question_id;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="answers")
     */
    private $question;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $correct;

    /**
     * @ORM\OneToMany(targetEntity=AnswerQuizzQuestion::class, mappedBy="answer_id")
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getCorrect(): ?bool
    {
        return $this->correct;
    }

    public function setCorrect(?bool $correct): self
    {
        $this->correct = $correct;

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
            $answersQuizzQuestion->setAnswerId($this);
        }

        return $this;
    }

    public function removeAnswersQuizzQuestion(AnswerQuizzQuestion $answersQuizzQuestion): self
    {
        if ($this->answersQuizzQuestion->removeElement($answersQuizzQuestion)) {
            // set the owning side to null (unless already changed)
            if ($answersQuizzQuestion->getAnswerId() === $this) {
                $answersQuizzQuestion->setAnswerId(null);
            }
        }

        return $this;
    }
}
