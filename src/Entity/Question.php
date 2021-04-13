<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
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
     * @ORM\OneToMany(targetEntity=Answer::class, mappedBy="question")
     */
    private $answers;

    /**
     * @ORM\OneToMany(targetEntity=QuizzQuestion::class, mappedBy="question")
     */
    private $quizzQuestions;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $img;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->quizzs = new ArrayCollection();
        $this->quizzQuestions = new ArrayCollection();
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

    /**
     * @return Collection|Answer[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestion() === $this) {
                $answer->setQuestion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|QuizzQuestion[]
     */
    public function getQuizzQuestions(): Collection
    {
        return $this->quizzQuestions;
    }

    public function addQuizzQuestion(QuizzQuestion $quizzQuestion): self
    {
        if (!$this->quizzQuestions->contains($quizzQuestion)) {
            $this->quizzQuestions[] = $quizzQuestion;
            $quizzQuestion->setQuestion($this);
        }

        return $this;
    }

    public function removeQuizzQuestion(QuizzQuestion $quizzQuestion): self
    {
        if ($this->quizzQuestions->removeElement($quizzQuestion)) {
            // set the owning side to null (unless already changed)
            if ($quizzQuestion->getQuestion() === $this) {
                $quizzQuestion->setQuestion(null);
            }
        }

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {
        $this->img = $img;

        return $this;
    }
}
