<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuizzRepository::class)
 */
class Quizz
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $player_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="quizzs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\OneToMany(targetEntity=QuizzQuestion::class, mappedBy="quizz")
     */
    private $quizzQuestions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->quizzQuestions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayerId(): ?int
    {
        return $this->player_id;
    }

    public function setPlayerId(int $player_id): self
    {
        $this->player_id = $player_id;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

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
            $quizzQuestion->setQuizz($this);
        }

        return $this;
    }

    public function removeQuizzQuestion(QuizzQuestion $quizzQuestion): self
    {
        if ($this->quizzQuestions->removeElement($quizzQuestion)) {
            // set the owning side to null (unless already changed)
            if ($quizzQuestion->getQuizz() === $this) {
                $quizzQuestion->setQuizz(null);
            }
        }

        return $this;
    }
}
