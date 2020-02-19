<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="CommentRepository")
 * @ORM\Table(indexes={
 *     @ORM\Index(name="football_match_idx", columns={"football_match_id"})
 * })
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=false, name="football_match_id")
     *
     * @var integer
     */
    private $footballMatchId;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    public function __construct(int $footballMatchId, string $content, \DateTime $date)
    {
        $this->footballMatchId = $footballMatchId;
        $this->date = $date;
        $this->content = $content;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFootballMatchId(): ?FootballMatch
    {
        return $this->footballMatchId;
    }

    public function setFootballMatchId(?FootballMatch $footballMatchId): self
    {
        $this->footballMatchId = $footballMatchId;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
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
}
